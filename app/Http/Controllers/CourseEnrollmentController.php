<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\StudentProgress;
use App\Models\CourseEnrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseEnrollmentController extends Controller
{
    public function enrollStudentsPage()
    {
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.enrollStudents', compact('navProfile'));
    }

    public function enrollStudents(Request $request)
    {
        $data = $this->getEnrollmentData($request);
        $this->validateEnrollmentData($request);
        CourseEnrollment::create($data);

        $progress = StudentProgress::updateOrCreate(
            ['user_id' => $data['user_id'],
                'course_id' => $data['course_id']],
            ['completion_percentage' => 0,
                'course_status' => 'in-progress']
        );

        

        return redirect()->route('enrollStudentsPage');
    }

    public function enrolledCoursesPage($user_id)
    {
        $courses = CourseEnrollment::where('user_id', $user_id)->get()->toArray();
        foreach ($courses as &$course) {
            $course_id = $course['course_id'];
            $course['courseName'] = Course::select('name')->where('id', $course_id)->value('name');
        }
        $navProfile = User::select('profile_picture')->where('role', 'student')->where('id', Auth::user()->id)->value('profile_picture');

        return view('student.enrolledCourses', compact('courses', 'navProfile'));
    }

    public function modulesDisplayPage($course_id)
    {
        $modules = Module::where('course_id', $course_id)->get();
        $courseName = Course::select('name')->where('id', $course_id)->value('name');
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');

        return view('student.modulesDisplay', compact('modules', 'courseName', 'course_id', 'navProfile'));
    }

    public function lessonsDisplayPage($module_id)
    {
        $course_id = Module::select('course_id')->where('id', $module_id)->value('course_id');
        $lessons = Lesson::where('module_id', $module_id)->get();
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');

        return view('student.lessonsDisplay', compact('lessons', 'course_id', 'module_id', 'navProfile'));
    }

    public function individualLessonPage($lesson_id)
    {
        $module_id = Lesson::select('module_id')->where('id', $lesson_id)->value('module_id');
        $lesson = Lesson::where('id', $lesson_id)->first();
        $course_id = Module::select('course_id')->where('id', $module_id)->value('course_id');
        $previousLesson = Lesson::where('id', '<', $lesson['id'])->where('module_id', $module_id)->first();
        $nextLesson = Lesson::where('id', '>', $lesson['id'])->where('module_id', $module_id)->first();
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');

        return view('student.individualLessonDisplay', compact('lesson', 'previousLesson', 'nextLesson', 'course_id', 'navProfile'));
    }

    private function getEnrollmentData($request)
    {
        return [
            'user_id' => User::select('id')->where('username', $request->studentName)->value('id'),
            'course_id' => Course::select('id')->where('name', $request->courseName)->value('id'),
        ];
    }

    private function validateEnrollmentData($request)
    {
        Validator::make($request->all(), [
            'studentName' => 'required|exists:users,username',
            'courseName' => 'required|exists:courses,name|unique_enrollment',
        ], [
            'studentName.required' => 'Student Name is Required',
            'studentName.exists' => 'Student with the Provided Name is not in the System',
            'courseName.required' => 'Course Name is Required',
            'courseName.exists' => 'Provided Course does not exist in the System',
            'courseName.unique_enrollment' => 'The Student has already been Enrolled to this Course',
        ])->validate();
    }
}

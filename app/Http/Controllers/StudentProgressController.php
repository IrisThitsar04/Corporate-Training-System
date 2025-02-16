<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Module;
use App\Models\StudentProgress;
use App\Models\CourseEnrollment;
use Illuminate\Support\Facades\Auth;

class StudentProgressController extends Controller
{
    public function moduleDone($id, $moduleId){
        $courseId = Module::select('course_id')->where('id', $moduleId)->value('course_id');

        $studentProgress = StudentProgress::where('user_id', Auth::user()->id)
                            ->where('course_id', $courseId)
                            ->first();

        if (!$studentProgress || !$this->isModuleCompleted($moduleId)) {
            if (!$studentProgress) {
                $studentProgress = StudentProgress::create([
                    'user_id' => Auth::user()->id,
                    'course_id' => $courseId,
                    'completion_percentage' => 0,
                    'completed_modules' => 0,
                    'course_status' => 'in-progress'
                ]);
            }

            $studentProgress->increment('completed_modules');
            $completedModules = $studentProgress->completed_modules;

            // $numModules = Course::select('num_modules')->where('id', $courseId)->value('num_modules');
            $numModules=Module::where('course_id', $courseId)->count();
            $completionPercentage = ($completedModules / $numModules) * 100;
            $studentProgress->update([
                'completion_percentage' => $completionPercentage,
                'course_status' => ($completedModules == $numModules) ? 'completed' : 'in-progress'
            ]);

            $this->markModuleCompleted($moduleId);
        }

        return redirect()->route('lessonsDisplayPage', $moduleId);
    }

    public function studentCompletedCourses($courseId)
    {
        $data = StudentProgress::where('course_id', $courseId)->paginate(10);
        foreach($data as &$studentdata){
            $studentdata['studentName'] = User::select('userName')->where('id', $studentdata['user_id'])->value('userName');
            $studentdata['courseName'] = Course::select('name')->where('id', $studentdata['course_id'])->value('name');
        }
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.studentCompletedCourses', compact('data', 'courseId', 'navProfile'));
    }

    public function chooseCourseforProgress()
    {
        $courses = Course::paginate(12);
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.chooseCourse_Progress', compact('courses', 'navProfile'));
    }

    public function chooseCourseforStudentProgress()
    {
        $courses = CourseEnrollment::where('user_id', Auth::user()->id)->paginate(12);
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('student.chooseCourseforStudentProgress', compact('courses', 'navProfile'));
    }

    public function trackStudentCompletedCourses($courseId)
    {
        $data = StudentProgress::where('course_id', $courseId)->where('user_id', Auth::user()->id)->paginate(10);
        foreach($data as &$studentdata){
            $studentdata['studentName'] = User::select('userName')->where('id', $studentdata['user_id'])->value('userName');
            $studentdata['courseName'] = Course::select('name')->where('id', $studentdata['course_id'])->value('name');
        }
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('student.trackStudentCompletedCourses', compact('data', 'courseId', 'navProfile'));
    }

    public function chooseCourseforProgressPage()
    {
        $courses = Course::paginate(12);
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.chooseCourseforProgressPage', compact('courses', 'navProfile'));
    }

    public function courseCompletionPercentage($courseId)
    {
        $data = StudentProgress::where('course_id', $courseId)->paginate(10);
        foreach($data as &$studentdata){
            $studentdata['studentName'] = User::select('userName')->where('id', $studentdata['user_id'])->value('userName');
            $studentdata['courseName'] = Course::select('name')->where('id', $studentdata['course_id'])->value('name');
        }
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.courseCompletionPercentage', compact('data', 'courseId', 'navProfile'));
    }

    private function isModuleCompleted($moduleId){
        return session()->has('completed_modules.' . $moduleId);
    }

    private function markModuleCompleted($moduleId){
        session()->put('completed_modules.' . $moduleId, true);
    }
}

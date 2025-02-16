<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\CourseEnrollment;
use Illuminate\Support\Facades\Auth;

class instructorController extends Controller
{
    //
    public function assignedCourses(){
        $instructor_id=Auth::id();
        $courses = Course::orderBy('id', 'asc')->where('instructor_id',$instructor_id)->paginate(3);
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.assignedCourseListPage', compact('courses', 'navProfile'));
    }

    public function assignedCourseDetails($id){
        $course= Course::where('id', $id)->first();
        $course['instructor_name']=User::select('username')->where('id', $course['instructor_id'])->value('username');
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.courseDetailsPage', compact('course','id', 'navProfile'));
    }

    public function instructorList(){
        $listData = User::select('users.*', 'courses.name as course_name')
                        ->join('courses', 'courses.instructor_id', '=', 'users.id')
                        ->where('users.role', 'instructor')
                        ->paginate(10);
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.instructorList', compact('listData', 'navProfile'));

    }

    public function instructorsRelatedPage(){
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.instructorsRelatedPage', compact('navProfile'));
    }

    public function enrolledStudentListPage(){
        $listData = CourseEnrollment::select('course_enrollments.*', 'courses.name as course_name', 'users.username', 'users.email', 'users.created_at')
                                    ->join('courses', 'courses.id', '=', 'course_enrollments.course_id')
                                    ->join('users', 'users.id', '=', 'course_enrollments.user_id')
                                    ->paginate(10);
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.enrolledStudentList', compact('listData', 'navProfile'));
    }
}

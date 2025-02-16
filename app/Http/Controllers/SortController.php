<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StudentProgress;
use App\Models\CourseEnrollment;

class SortController extends Controller
{
    public function sortStudentData(Request $request, $courseId)
    {

        logger($request->column);
        $column = $request->column;
        $order = $request->order;
        $studentData = StudentProgress::where('course_id', $courseId)->get()->toArray();
        $data = $this->sortData($column, $order, $studentData, $courseId);
        return $data;
    }

    private function sortData($column, $order, $studentData, $courseId)
    {
        switch ($column) {
            case 'name':
                $sortedData = StudentProgress::select('student_progress.*', 'users.userName as studentName', 'courses.name as courseName')
                    ->join('courses', 'student_progress.course_id', '=', 'courses.id')
                    ->join('users', 'student_progress.user_id', '=', 'users.id')->where('student_progress.course_id', $courseId)
                    ->orderBy('users.userName', $order)
                    ->get()->toArray();
                return $sortedData;

            case 'course':
                $sortedData = StudentProgress::select('student_progress.*', 'courses.name as courseName', 'users.userName as studentName')
                    ->join('users', 'student_progress.user_id', '=', 'users.id')
                    ->join('courses', 'student_progress.course_id', '=', 'courses.id')->where('student_progress.course_id', $courseId)
                    ->orderBy('courses.name', $order)
                    ->get()->toArray();
                return $sortedData;

            case 'status':
                $sortedData = StudentProgress::select('student_progress.*', 'courses.name as courseName', 'users.userName as studentName')
                    ->join('users', 'student_progress.user_id', '=', 'users.id')
                    ->join('courses', 'student_progress.course_id', '=', 'courses.id')->where('student_progress.course_id', $courseId)
                    ->orderBy('student_progress.course_status', $order)
                    ->get()->toArray();
                return $sortedData;

            case 'percentage':
                $sortedData = StudentProgress::select('student_progress.*', 'courses.name as courseName', 'users.userName as studentName')
                    ->join('users', 'student_progress.user_id', '=', 'users.id')
                    ->join('courses', 'student_progress.course_id', '=', 'courses.id')->where('student_progress.course_id', $courseId)
                    ->orderBy('student_progress.completion_percentage', $order)
                    ->get()->toArray();
                return $sortedData;

            default:
                $sortedData = StudentProgress::select('student_progress.*', 'users.userName as studentName', 'courses.name as courseName')
                    ->join('courses', 'student_progress.course_id', '=', 'courses.id')
                    ->join('users', 'student_progress.user_id', '=', 'users.id')->where('student_progress.course_id', $courseId)
                    ->orderBy('users.userName', $order)
                    ->get()->toArray();
                return $sortedData;

        }
    }

    public function sortInstructorList(Request $request)
    {
        logger($request->column);
        $column = $request->column;
        $order = $request->order;
        $role = 'instructor';
        $data = $this->sortList($column, $order, $role);
        return $data;
    }

    public function sortAdminList(Request $request)
    {
        logger($request->column);
        $column = $request->column;
        $order = $request->order;
        $role='admin';
        $data = $this->sortAdmin($column, $order, $role);
        return $data;
    }

    public function sortStudentList(Request $request)
    {
        logger($request->column);
        $column = $request->column;
        $order = $request->order;
        $data = $this->sortStudent($column, $order);
        return $data;
    }

    private function sortList($column, $order, $role)
    {
        switch ($column) {
            case 'name':
                $sortedData = User::select('users.*', 'courses.name as course_name')
                    ->join('courses', 'courses.instructor_id', '=', 'users.id')
                    ->where('users.role', $role)
                    ->orderBy('users.username', $order)
                    ->paginate(10);
                logger($sortedData);
                return $sortedData;

            case 'email':
                $sortedData = User::select('users.*', 'courses.name as course_name')
                    ->join('courses', 'courses.instructor_id', '=', 'users.id')
                    ->where('users.role', $role)
                    ->orderBy('users.email', $order)
                    ->paginate(10);
                return $sortedData;

            case 'course':
                $sortedData = User::select('users.*', 'courses.name as course_name')
                    ->join('courses', 'courses.instructor_id', '=', 'users.id')
                    ->where('users.role', $role)
                    ->orderBy('courses.name', $order)
                    ->paginate(10);
                logger($sortedData);

                return $sortedData;

            case 'registration':
                $sortedData = User::select('users.*', 'courses.name as course_name')
                    ->join('courses', 'courses.instructor_id', '=', 'users.id')
                    ->where('users.role', $role)
                    ->orderBy('users.created_at', $order)
                    ->paginate(10);
                logger($sortedData);
                return $sortedData;

            default:
                $sortedData = User::select('users.*', 'courses.name as course_name')
                    ->join('courses', 'courses.instructor_id', '=', 'users.id')
                    ->where('users.role', $role)
                    ->orderBy('users.username', $order)
                    ->paginate(10);
                return $sortedData;
        }
    }

    private function sortAdmin($column, $order, $role)
    {
        switch ($column) {
            case 'name':
                $sortedData = User::select('users.*')
                    ->where('users.role', 'admin')
                    ->orderBy('users.username', $order)
                    ->paginate(10);  logger($sortedData);
                return $sortedData;

            case 'firstname':
                $sortedData =User::select('users.*')
                    ->where('users.role', 'admin')
                    ->orderBy('users.first_name', $order)
                    ->paginate(10);  logger($sortedData);
                return $sortedData;

            case 'lastname':
                $sortedData = User::select('users.*')
                    ->where('users.role', 'admin')
                    ->orderBy('users.last_name', $order)
                    ->paginate(10);  logger($sortedData);
                return $sortedData;

            case 'email':
                $sortedData = User::select('users.*')
                    ->where('users.role', 'admin')
                    ->orderBy('users.email', $order)
                    ->paginate(10);  logger($sortedData);
                return $sortedData;

            case 'registeration':
                $sortedData = User::select('users.*')
                    ->where('users.role', 'admin')
                    ->orderBy('users.created_at', $order)
                    ->paginate(10);  logger($sortedData);
                return $sortedData;

            default:
               $sortedData = User::select('users.*')
                            ->where('users.role', 'admin')
                            ->orderBy('users.username', $order)
                            ->paginate(10);
                return $sortedData;
        }
    }

    private function sortStudent($column, $order)
    {
        switch ($column) {
            case 'name':
                $sortedData = CourseEnrollment::select('course_enrollments.*', 'courses.name as course_name', 'users.username', 'users.email', 'users.created_at')
                            ->join('courses', 'courses.id', '=', 'course_enrollments.course_id')
                            ->join('users', 'users.id','=', 'course_enrollments.user_id')
                            ->orderby('users.username', $order)
                            ->paginate(10);
                logger($sortedData);
                return $sortedData;

            case 'email':
                $sortedData = CourseEnrollment::select('course_enrollments.*', 'courses.name as course_name', 'users.username', 'users.email', 'users.created_at')
                            ->join('courses', 'courses.id', '=', 'course_enrollments.course_id')
                            ->join('users', 'users.id', '=', 'course_enrollments.user_id')
                            ->orderby('users.email', $order)
                            ->paginate(10);
                logger($sortedData);
                return $sortedData;

            case 'course':
                $sortedData =CourseEnrollment::select('course_enrollments.*', 'courses.name as course_name', 'users.username', 'users.email', 'users.created_at')
                                ->join('courses', 'courses.id', '=', 'course_enrollments.course_id')
                                ->join('users', 'users.id', '=', 'course_enrollments.user_id')
                                ->orderby('courses.name', $order)
                                ->paginate(10);
                logger($sortedData);
                return $sortedData;

            case 'registration':
               $sortedData = CourseEnrollment::select('course_enrollments.*', 'courses.name as course_name', 'users.username', 'users.email', 'users.created_at')
                                            ->join('courses', 'courses.id', '=', 'course_enrollments.course_id')
                                            ->join('users', 'users.id', '=', 'course_enrollments.user_id')
                                            ->orderby('users.created_at', $order)
                                            ->paginate(10);
                logger($sortedData);
                return $sortedData;

            default:
                $sortedData = CourseEnrollment::select('course_enrollments.*', 'courses.name as course_name', 'users.username', 'users.email', 'users.created_at')
                            ->join('courses', 'courses.id', '=', 'course_enrollments.course_id')
                            ->join('users', 'users.id','=', 'course_enrollments.user_id')
                            ->orderby('users.username', $order)
                            ->paginate(10);
                return $sortedData;
        }
    }

}

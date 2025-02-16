<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\StudentGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentGradeController extends Controller
{
   public function uploadGrade(Request $request, $id, $student_id, $submission_id) {
    $alreadyGraded = StudentGrade::where('assignment_id', $id)->where('user_id', $student_id)->exists();
    if ($alreadyGraded) {
        return redirect()->route('IndividualSubmissionsPage', $submission_id);
    }

    $data=$request->all();
    $data['assignment_id'] = $id;
    $data['user_id'] = $student_id;
    StudentGrade::create($data);
    return redirect()->route('IndividualSubmissionsPage', $submission_id)->with('success', 'Grade uploaded successfully.');
}

    public function editGrade($id){
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        $data= StudentGrade::where('id', $id)->first();
        $data['title']=Assignment::where('id', $data['assignment_id'])->value('title');
        return view('instructor.editGrade', compact('id', 'navProfile', 'data'));
    }

    public function updateGrade(Request $request, $id){
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        $data=$request->all();
        $data['assignment_id']=Assignment::where('title', $data['assignmentName'])->value('id');
        StudentGrade::where('id', $id)->update(['marks' => $data['marks']]);
        return redirect()->route('assignmentGradeList', $data['assignment_id'])->with(compact('id', 'navProfile'));
    }
    public function assignmentGradePage(){
        $grades=StudentGrade::where('user_id', Auth::user()->id)->paginate(12);
        foreach($grades as &$grade){
            $grade['assignment_name']=Assignment::where('id', $grade['assignment_id'])->value('title');
            $grade['course_id']=Assignment::where('id', $grade['assignment_id'])->value('course_id');
            $grade['course_name'] =Course::where('id', $grade['course_id'])->value('name');
        }
         $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view ('student.assignmentGradePage',compact('navProfile', 'grades'));
    }

    public function assignmentGradeList($id){
        $grades = StudentGrade::where('assignment_id', $id)->paginate(12);
        foreach ($grades as &$grade) {
            $grade['assignment_name'] = Assignment::where('id', $grade['assignment_id'])->value('title');
            $grade['course_id'] = Assignment::where('id', $grade['assignment_id'])->value('course_id');
            $grade['course_name'] = Course::where('id', $grade['course_id'])->value('name');
        }
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.assignmentGradeList', compact('navProfile', 'grades'));
    }
}

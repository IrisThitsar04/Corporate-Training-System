<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Module;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\CourseEnrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Events\InstructorUploadedAssignment;

class AssignmentController extends Controller
{
    public function uploadAssignmentPage(){
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.uploadAssignmentPage', compact('navProfile'));
    }

    public function uploadAssignment(Request $request){
        $this->validateAssignmentData($request);
        $data=$this->getAssignmentData($request);
        $fileName=uniqid().$request->assignmentFile->getClientOriginalName();
        $request->file('assignmentFile')->storeAs('public',$fileName);
        $data['assignment_file']=$fileName;

        $assignment=Assignment::create($data);
        event(new InstructorUploadedAssignment($assignment));
        return redirect()->route('uploadAssignmentPage');
    }

    public function chooseCourse_Assignment($id){
        $courses=Course::where('instructor_id', $id)->paginate(3);
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.chooseCourse_Assignment', compact('courses', 'navProfile'));
    }

    public function uploadedAssignmentsPage($id){
        $assignments=Assignment::where('course_id',$id)->paginate(6);
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.uploadedAssignmentsPage', compact('assignments', 'id', 'navProfile'));
    }

    public function editAssignmentPage($id){
        $assignment=Assignment::where('id',$id)->first()->toArray();
        $assignment['courseName']=Course::select('name')->where('id', $assignment['course_id'])->value('name');
        $course_id=Assignment::select('course_id')->where('id',$id)->value('course_id');
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.editAssignmentPage', compact('assignment', 'id', 'course_id', 'navProfile'));
    }

    public function updateAssignment(Request $request, $id){
        $this->validateAssignmentData($request);
        $assignment=$this->getAssignmentData($request);
        Assignment::where('id',$id)->update($assignment);
        return redirect()->route('uploadedAssignmentsPage', $assignment['course_id']);
    }

    public function deleteAssignment($id, $course_id){
        Assignment::where('id',$id)->delete();
        $assignments=Assignment::where('course_id', $course_id)->paginate(6);
        return redirect()->route('uploadedAssignmentsPage',$course_id)->with('assignments', $assignments);
    }

    public function individualAssignment($id){
        $data=Assignment::where('id', $id)->first()->toArray();
        $course_id=Assignment::select('course_id')->where('id', $id)->value('course_id');
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.individualAssignment', compact('data', 'id', 'course_id', 'navProfile'));
    }

    public function assignmentPage($id){
        $data=Assignment::select('course_enrollments.user_id', 'course_enrollments.course_id', 'assignments.*', 'users.username')
                                ->join('course_enrollments', 'course_enrollments.course_id', '=', 'assignments.course_id')
                                ->join('users', 'users.id', '=', 'course_enrollments.user_id')
                                ->where('users.id',Auth::user()->id)
                                ->paginate(6);
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('student.assignmentPage', compact('data', 'navProfile'));
    }

    public function detailedAssignmentPage($id){
        $data = Assignment::where('id', $id)->first();
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('student.detailedAssignmentPage', compact('data', 'navProfile'))->with('status', 'not submitted');

    }

    public function studentMailBoxPage(){
        Auth::user()->unreadNotifications->markAsRead();
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        $notifications = Auth::user()->notifications;
        return view('student.studentMailBoxPage', compact('navProfile', 'notifications'));
    }

    public function chooseAssignment($course_id){
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        $assignments=Assignment::where('course_id', $course_id)->paginate(12);
        return view('instructor.chooseAssignment', compact('assignments', 'navProfile'));
    }

    public function assignmentRelatedPage(){
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
         return view('student.assignmentRelatedPage', compact('navProfile'));
    }

    public function chooseAssignmentforGrades($course_id){
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        $assignments=Assignment::where('course_id', $course_id)->paginate(12);
        return view('instructor.chooseAssignmentforGrades', compact('assignments', 'navProfile'));
    }

    public function instructorAssignmentRelatedPage(){
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
         return view('instructor.assignmentRelatedPage', compact('navProfile'));
    }

    private function getAssignmentData($request){
        return[
            'title'=>$request->assignmentTitle,
            'notes'=>$request->notes,
            'course_id'=>Course::select('id')->where('name',$request->courseName)->value('id'),
            'due'=>$request->due,
            'max_score'=>$request->maxScore,
            'pass_score'=>$request->passScore,
        ];
    }
    private function validateAssignmentData($request){
       Validator::make($request->all(),
       [
            'assignmentTitle'=>'required|unique:assignments,title,'.$request->id,
            'notes'=>'required',
            'courseName'=>'required',
            'due'=>'required',
            'maxScore'=>'required|integer',
            'passScore'=>'required|integer',
            'assignmentFile' => 'required|file|mimes:png,jpg,jpeg,doc,docx,pdf,gif,txt,mp4,avi,wmv|max:40960'
       ],[
            'assignmentTitle.required'=>'Assignment Title is Reqired',
            'assignmentTitle.unique'=>'Assignment Title already Exists. Choose Another One',
            'notes.required'=>'Notes are Reqired',
            'courseName.required'=>'Course Name is Reqired',
            'due.required'=>'Due Date and Time is Reqired',
            'maxScore.required'=>'Max Score is Reqired',
            'passScore.required'=>'Pass Score is Reqired',
            'maxScore.integer'=>'Max Score must be an Integer',
            'passScore.integer'=>'Pass Score must be an Integer',
            'assignmentFile.required' => 'The assignment file is required.',
            'assignmentFile.file' => 'The assignment file must be a valid file.',
            'assignmentFile.mimes' => 'The assignment file must be of type: png, jpg, jpeg,gif, doc, docx, pdf, txt, mp4, avi,wmv',
            'assignmentFile.max' => 'The assignment file may not be greater than 40 GB.',
       ])->validate();
    }
}

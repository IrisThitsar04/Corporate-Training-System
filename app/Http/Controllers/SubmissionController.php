<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\StudentGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class SubmissionController extends Controller
{
    // public function submitAssignment(Request $request, $assignmentId){
    //     $data=[];
    //     $data['user_id']=Auth::user()->id;
    //     $data['assignment_id']=$assignmentId;
    //     $data['submitted_at'] = Carbon::now()->format('d-m-y');
    //     $fileName=uniqid().$request->submission->getClientOriginalName();
    //     $request->file('submission')->storeAs('public',$fileName);
    //     $data['submission_file']=$fileName;
    //     Submission::create($data);
    //     return redirect()->route('detailedAssignmentPage', ['id' => $assignmentId]);
    // }

    public function submitAssignment(Request $request, $assignmentId){
        $alreadySubmitted = Submission::where('assignment_id', $assignmentId)->where('user_id', Auth::user()->id)->exists();

        if ($alreadySubmitted) {
            return redirect()->route('detailedAssignmentPage', $assignmentId);
        }
        $this->validateSubmission($request);
    $data = [];
        $data['user_id'] = Auth::user()->id;
        $data['assignment_id'] = $assignmentId;
        $data['submitted_at'] = Carbon::now()->format('d-m-y');
        $fileName = uniqid() . $request->submission->getClientOriginalName();
        $request->file('submission')->storeAs('public', $fileName);
        $data['submission_file'] = $fileName;
        Submission::create($data);
        return redirect()->route('detailedAssignmentPage', ['id' => $assignmentId]);
    }

    public function viewSubmissionsPage($id){
        $submissions=Submission::where('assignment_id', $id)->get();
        foreach ($submissions as &$submission) {
            $submission['student_name'] = User::select('username')->where('id', $submission['user_id'])->value('username');
            $submission['due'] = Assignment::where('id', $id)->value('due');
            // $submission['marks']= StudentGrade::where('assignment_id', $id)->value('marks');
        }
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.viewSubmissions', ['id' =>  $id ])->with(compact('submissions', 'navProfile'));
    }

    public function IndividualSubmissionsPage($submission_id){
        $data=Submission::where('id', $submission_id)->first();
        $data['notes'] = Assignment::select('notes')->where('id', $data['assignment_id'])->value('notes');
        $data['title'] = Assignment::select('title')->where('id', $data['assignment_id'])->value('title');
        $data['student_name'] = User::select('username')->where('id', $data['user_id'])->value('username');
        $data['max_score'] = Assignment::select('max_score')->where('id', $data['assignment_id'])->value('max_score');
        $data['pass_score'] = Assignment::select('pass_score')->where('id', $data['assignment_id'])->value('pass_score');
        $data['due'] = Assignment::select('due')->where('id', $data['assignment_id'])->value('due');

        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.IndividualSubmissionsPage', compact('navProfile', 'data'));
    }

    public function submittedAssignmentPage(){
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        $submissions=Submission::where('user_id', Auth::user()->id)->paginate(10);
    foreach($submissions as &$submission){
        $submission['title']=Assignment::where('id', $submission['assignment_id'])->value('title');
    }
        return view('student.submittedAssignmentPage', compact('navProfile', 'submissions'));
    }

    public function undoTurnInPage($submission_id){
        $data=Submission::where('id', $submission_id)->first();
        $data['title']=Assignment::where('id', $data['assignment_id'])->value('title');
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('student.undoTurnInPage', compact('navProfile', 'data'));
    }

    public function assignmentTurnInAgain(Request $request, $id){
        $assignmentId = Assignment::where('title', $request->assignmentName)->value('id');

        $fileName = uniqid() . $request->submission->getClientOriginalName();
        $request->file('submission')->storeAs('public', $fileName);
        $data['submission_file'] = $fileName;
        Submission::where('id', $id)
                    ->update([
                    'submitted_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'submission_file' => $fileName,
                ]);

        return redirect()->route('detailedAssignmentPage', ['id' => $assignmentId]);
    }

    private function validateSubmission(Request $request){
       $request->validate([
        'submission' => 'required|file|mimes:png,jpg,jpeg,doc,docx,pdf,gif,txt,mp4,avi,wmv|max:40960'
    ], [
            'submission.required' => 'The assignment file is required.',
            'submission.file' => 'The assignment file must be a valid file.',
            'submission.mimes' => 'The assignment file must be of type: png, jpg, jpeg,gif, doc, docx, pdf, txt, mp4, avi,wmv',
            'submission.max' => 'The assignment file may not be greater than 40 GB.',
       ])->validate();
    }

}

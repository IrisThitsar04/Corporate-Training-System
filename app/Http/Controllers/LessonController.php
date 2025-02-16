<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    public function uploadLessonPage($id)
    {
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.uploadLesson', ['id' => $id], compact('navProfile'));
    }

    public function uploadLesson(Request $request)
    {
        $data = $this->getLessonData($request);
        $lesson_material = uniqid().$request->file('lesson_material')->getClientOriginalName();
        $request->file('lesson_material')->storeAs('public',$lesson_material);
        $this->validateLessonData($request);
        $data['lesson_materials']=$lesson_material;
        Lesson::create($data);
        return back();
    }

    public function uploadedLessonsPage($id){
        $module_id=Lesson::select('module_id')->where('id',$id)->value('module_id');
        $course_id=Module::select('course_id')->where('id',$id)->value('course_id');
        $lessons=Lesson::where('module_id',$id)->get();
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.uploadedLessonsPage', compact('lessons','id', 'course_id', 'module_id', 'navProfile'));
    }

    public function individualLesson($id){
        $lesson=Lesson::where('id',$id)->first();
        $module_id=Lesson::select('module_id')->where('id',$id)->value('module_id');
        $course_id = Module::select('course_id')->where('id', $module_id)->value('course_id');
        $previousLesson = Lesson::where('id', '<', $id)->where('module_id', $module_id)->orderBy('id', 'desc')->first();
        $nextLesson=Lesson::where('id', '>', $id)->where('module_id', $module_id)->orderBy('id', 'desc')->first();
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');

        return view('instructor.individualLesson', compact('lesson', 'module_id', 'course_id', 'previousLesson','nextLesson', 'navProfile'));
    }

    public function editLessonPage($id){
        $data=Lesson::where('id',$id)->first()->toArray();
        $data['moduleName']=Module::select('name')->where('id',$data['module_id'])->value('name');
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');

        return view('instructor.editLessonPage',compact('data','id', 'navProfile'));
    }

    public function updateLesson(Request $request,$id){
        $data = $this->getLessonData($request);
        if($request->hasFile('lesson_material')){
            $oldFile=Lesson::select('lesson_materials')->where('id',$id)->value('lesson_materials');
            if($oldFile!=null){
                Storage::delete('public/'.$oldFile);
            }
            $lesson_material=uniqid().$request->file('lesson_material')->getClientOriginalName();
            $request->file('lesson_material')->storeAs('public',$lesson_material);
            $data['lesson_materials']=$lesson_material;
        }
        $this->validateLessonData($request);
        Lesson::where('id',$id)->update($data);
        return redirect()->route('uploadedLessonsPage', $data['module_id']);
    }

    public function deleteLesson($id){
        Lesson::where('id',$id)->delete();
        return back();
    }

    private function getLessonData($request)
    {
        return [
            'name' => $request->lessonName,
            'module_id' => Module::select('id')->where('name', $request->moduleName)->value('id'),
            'notes'=> $request->notes,
        ];
    }
    private function validateLessonData($request)
    {
        Validator::make($request->all(),
            [
                'lessonName' => 'required|unique:lessons,name,' . $request->id,
                'moduleName' => 'required',
                'lesson_material' => 'required|file|mimes:jpg,jpeg,png,gif,mp4,avi,wmv,txt,pdf,doc,docx|max:40960',
                'notes' => 'required|min:30',
            ],
            [
                'lessonName.required'=>'Lesson Name is Required',
                'lessonName.unique'=>'The Lesson with the Provided Name has been already Created. Enter a Different Name',
                'moduleName.required'=>'Module Name is Required',
                'lesson_material.required'=>'Lesson Material is Required',
                'lesson_material.mimes'=>'The file must only be of the type jpg, jpeg, png, gif, mp4, avi, wmv, and txt',
                'lesson_material.max'=>'The Maximum file size is 40M',
                'notes.required'=>'Lesson Notes are Required',
                'notes.min:30'>'Lesson Notes must have at least 30 Characters',
            ])->validate();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{
     public function uploadModulePage($id){
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.uploadModule', ['id' => $id], compact('navProfile'));
    }

    public function uploadModule(Request $request)
    {
        $data = $this->validateModuleData($request);
        $data = $this->getModuleData($request);
        Module::create($data);
        return back();
    }

    public function uploadedModulesPage($id){
        $modules=Module::where('course_id',$id)->get();
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.uploadedModulesPage', compact('modules','id', 'navProfile'));
    }

    public function editModulePage($id){
        $data=Module::where('id',$id)->first()->toArray();
        $data['courseName']=Course::select('name')->where('id',$data['course_id'])->value('name');
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.editModulePage',compact('data', 'navProfile'));
    }

    public function updateModule(Request $request, $id){
        $data=$this->getModuleData($request);
        $this->validateModuleData($request);
        Module::where('id', $id)->update($data);
        return redirect()->route('uploadedModulesPage',$data['course_id']);
    }

    public function deleteModule($id){
        Module::where('id',$id)->delete();
        return back();
    }

    private function getModuleData($request)
    {
        return [
            'name' => $request->moduleName,
            'description' => $request->description,
            'course_id' => Course::select('id')->where('name', $request->courseName)->value('id'),
        ];
    }
    private function validateModuleData($request)
    {
        Validator::make($request->all(),
            [
                'moduleName' => 'required|unique:modules,name,' . $request->id,
                'description' => 'nullable|min:5',
                'courseName' => 'required',
            ], [
                'moduleName.required' => 'Module Name is Required',
                'moduleName.unique' => 'A module has already been created with a provided name.Please Try a Different Name',
                'description.min' => 'Description must have at least 5 characters',
                'courseName.required' => 'Course Name is Required',
            ])->validate();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\StudentProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
     public function createCourse(Request $request){
        $this->validateCourseData($request);
        $data = $this->getCourseData($request);

        if($request->hasFile('course_profile')){
            $img_name=uniqid().$request->file('course_profile')->getClientOriginalName();
            $request->file('course_profile')->storeAs('public',$img_name);
            $data['course_profile']=$img_name;
        }
       Course::create($data);
       return redirect()->route('create#coursePage');
    }

    public function displayCourses(){
        $courses=Course::orderBy('id','asc')->paginate(3);
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.courseListPage',compact('courses', 'navProfile'));
    }

    public function editCoursePage($id){
        $data=Course::where('id',$id)->first()->toArray();
        $data['instructor_name']=User::select('username')->where('id',$data['instructor_id'])->where('role','instructor')->value('username');
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.editCoursePage',compact('data', 'navProfile'));
    }

    public function updateCoursePage($id){
        $data = Course::where('id', $id)->first()->toArray();
        $data['instructor_name'] = User::select('username')->where('id', $data['instructor_id'])->where('role', 'instructor')->value('username');
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.updateCoursePage', compact('data', 'navProfile'));
    }

    public function updateCourse(Request $request, $id){
        $this->validateCourseData($request, $id);
        $data=$this->getCourseData($request);
        if($request->hasFile('course_profile')){
            $oldImg=Course::select('course_profile')->where('id', $id)->value('course_profile');
            if($oldImg!=null){
                Storage::delete('public/'.$oldImg);
            }
            $imgName=uniqid().$request->file('course_profile')->getClientOriginalName();
            $request->file('course_profile')->storeAs('public', $imgName);
            $data['course_profile']=$imgName;
        }
        Course::where('id', $id)->update($data);
        return redirect()->route('courseListPage');
    }

    public function deleteCourse($id){
        Course::where('id',$id)->delete();
        return redirect()->route('courseListPage');
    }

    public function courseRelatedPage(){
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.courseRelatedPage', compact('navProfile'));
    }

    public function chooseCourseforModule(){
        $courses = Course::paginate(12);
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.chooseCourseforModule', compact('courses', 'navProfile'));
    }

    public function chooseCourseforLesson(){
        $courses = Course::paginate(12);
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.chooseCourseforLesson', compact('courses', 'navProfile'));
    }

    public function chooseCourseforAssignment(){
        $courses = Course::paginate(12);
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.chooseCourseforAssignment', compact('courses', 'navProfile'));
    }

    public function chooseCourseforSubmissions(){
        $courses = Course::paginate(12);
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.chooseCourseforSubmissions', compact('courses', 'navProfile'));
    }

    public function completedCourseList(){
        $courses=StudentProgress::where('user_id', Auth::user()->id)->where('course_status', 'completed')->paginate(12);
        foreach($courses as &$course){
            $course['course_name']=Course::where('id', $course['course_id'])->value('name');
        }
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('student.completedCourseList', compact('courses', 'navProfile'));
    }

    public function chooseCourseforGrades(){
        $courses = Course::paginate(12);
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.chooseCourseforGrades', compact('courses', 'navProfile'));
    }

     public function instructorCourseRelatedPage(){
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.courseRelatedPage', compact('navProfile'));
    }

    private function validateCourseData($request){
        Validator::make($request->all(),
        [
            'courseName'=>'required|unique:courses,name,'.$request->id,
            'description'=>'required|min:5',
            'instructor_name'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'duration'=>'required',
            'course_profile'=>'nullable|mimes:jpg,jpeg,png',
        ],[
            'courseName.required'=>'Course Name is Required',
            'courseName.unique'=>'The course with the provided name has already been created',
            'description.required'=>'Description is Required',
            'description.min'=>'Description must have at least 5 characters',
            'instructor_name.required'=>'Instructor Name is Required',
            'start_date.required'=>'Start Date is Required',
            'end_date.required'=>'End Date is Required',
            'duration.required'=>'Course Duration is Required',
            'course_profile.mimes'=>'Profile must be of type jpg, jpeg and png',
        ])->validate();

    }

    private function getCourseData($request){

        return[
            'name'=>$request->courseName,
            'description'=>$request->description,
            'instructor_id'=>User::select('id')->where('username',$request->instructor_name)->where('role','instructor')->first()->id,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'duration'=>$request->duration,
            'course_profile'=>$request->course_profile,
        ];
    }
}

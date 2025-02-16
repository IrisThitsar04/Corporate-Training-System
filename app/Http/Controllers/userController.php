<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\StudentProgress;
use App\Models\CourseEnrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    //Register Function
    public function register(Request $request)
    {
        $this->validateData($request);
        $data = $this->getData($request);
        $data['password'] = Hash::make($data['password']);
        if ($request->hasFile('profile_picture')) {
            $img_name = uniqid() . $request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')->storeAs('public', $img_name);
            $data['profile_picture'] = $img_name;
        }

        User::Create($data);
        return redirect()->route('registerPage');
    }

//     public function userLogin(Request $request){
//     // Validate the login data
//     $this->validateLoginData($request);
//     // Get the login data
//     $data = $this->getLoginData($request);
//     // Find the user by email
//     $user = User::where('email', $data['email'])->first();
//     // If user does not exist or password does not match, return error
//     if (!$user || !password_verify($data['password'], $user->password)) {
//         return response()->json(['error' => 'Invalid credentials'], 401);
//     }
//     // Authenticate the user
//     Auth::login($user);
//     // Redirect to the dashboard route
//     return redirect()->route('user#dashboard');
// }

    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            $totalAdmins=User::where('role','admin')->count();
            $totalStudents = User::where('role', 'student')->count();
            $totalInstructors = User::where('role', 'instructor')->count();
            $totalCourses = Course::count();
            $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
            return view('admin.adminDashboard', compact('totalAdmins', 'totalStudents', 'totalInstructors', 'totalCourses', 'navProfile'));
        } elseif (Auth::user()->role == 'instructor') {
            $data = User::where('role', 'instructor')->where('id', Auth::user()->id)->first();
            $totalCourses = Course::count();
            $totalStudents = User::where('role', 'student')->count();
            $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
            return view('instructor.instructorDashboard', compact('data', 'navProfile', 'totalCourses', 'totalStudents'));
        } else {
            $navProfile = User::select('profile_picture')->where('role', 'student')->where('id', Auth::user()->id)->value('profile_picture');
            $totalCourses = CourseEnrollment::where('user_id', Auth::user()->id)->count();
            $completedCourses=StudentProgress::where('user_id', Auth::user()->id)->where('course_status', 'completed')->count();
            return view('student.studentDashboard', compact('navProfile', 'totalCourses', 'completedCourses'));
        }
    }

    public function manageProfilePage()
    {
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        $userData = User::where('id', Auth::user()->id)->first()->toArray();
        return view('admin.manageProfilePage', compact('userData', 'navProfile'));
    }

    public function adminEditProfilePage()
    {
        $data = User::where('id', Auth::user()->id)->first()->toArray();
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.editProfilePage', compact('data', 'navProfile'));
    }

    public function adminUpdateProfile(Request $request)
    {
        $this->validateProfileData($request);
        $data = $this->getProfileData($request);
        if ($request->hasFile('profile_picture')) {
            $oldImg = User::select('profile_picture')->where('id', Auth::user()->id)->value('profile_picture');
            if ($oldImg != null) {
                Storage::delete('public/' . $oldImg);
            }
            $imgName = uniqid() . $request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')->storeAs('public', $imgName);
            $data['profile_picture'] = $imgName;
        }

        User::where('id', Auth::user()->id)->update($data);
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return redirect()->route('manageProfilePage', compact('navProfile'));
    }

    public function adminChangePasswordPage()
    {
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.changePasswordPage', compact('navProfile'));
    }

    public function adminChangePassword(Request $request)
    {
        $this->validatePassword($request);
        $data = $this->getPassword($request);
        $dbPassword = User::select('password')->where('id', Auth::user()->id)->value('password');
        if (Hash::check($request->oldPwd, $dbPassword)) {
            $data = [
                'password' => Hash::make($request->newPwd),
            ];
            Auth::logoutOtherDevices($request->oldPwd);

            User::where('id', Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('user#dashboard');

        } else {
            return back()->with(['unMatch' => 'The Old Password is in Incorrect']);
        }
    }

    public function addAdminPage(){
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.addAdmin', compact('navProfile'));
    }

    public function addAdmin(Request $request){
        $name=$request->name;
        $this->validateAdminData($request);
        User::where('username', $name)->update(['role'=>'admin']);
        return back();
    }

    public function studentsRelatedPage(){
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.studentsRelatedPage', compact('navProfile'));
    }

    public function studentList(){
        $listData = CourseEnrollment::select('course_enrollments.*', 'courses.name as course_name', 'users.username', 'users.email', 'users.created_at')
                            ->join('courses', 'courses.id', '=', 'course_enrollments.course_id')
                            ->join('users', 'users.id','=', 'course_enrollments.user_id')
                            ->paginate(10);
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.studentList', compact('listData', 'navProfile'));

    }

    public function adminRelatedPage(){
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.adminRelatedPage', compact('navProfile'));
    }

    public function adminList(){
        $listData = User::select('users.*')
                    ->where('users.role', 'admin')
                    ->paginate(10);
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('admin.adminList', compact('listData', 'navProfile'));

    }

    public function instructorList(){
        $instructors = COurseEnrollment::select('course_id')->where('user_id', Auth::user()->id)->paginate(10);
        foreach($instructors as &$instructor){
            $instructor['course_name']=Course::where('id', $instructor['course_id'])->value('name');
            $instructor['instructor_id']=Course::where('id', $instructor['course_id'])->value('instructor_id');
            $instructor['instructor_name'] = User::where('id', $instructor['instructor_id'])->value('username');
        }
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('student.instructorList', compact('navProfile', 'instructors'));

    }

     public function studentManageProfilePage()
    {
        $navProfile = User::select('profile_picture')->where('role', 'student')->where('id', Auth::user()->id)->value('profile_picture');
        $userData = User::where('id', Auth::user()->id)->first()->toArray();
        return view('student.studentManageProfilePage', compact('userData', 'navProfile'));
    }

    public function studentEditProfilePage()
    {
        $data = User::where('id', Auth::user()->id)->first()->toArray();
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('student.studentEditProfilePage', compact('data', 'navProfile'));
    }

    public function studentUpdateProfile(Request $request)
    {
        $this->validateProfileData($request);
        $data = $this->getProfileData($request);
        if ($request->hasFile('profile_picture')) {
            $oldImg = User::select('profile_picture')->where('id', Auth::user()->id)->value('profile_picture');
            if ($oldImg != null) {
                Storage::delete('public/' . $oldImg);
            }
            $imgName = uniqid() . $request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')->storeAs('public', $imgName);
            $data['profile_picture'] = $imgName;
        }
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');

        User::where('id', Auth::user()->id)->update($data);
        return redirect()->route('studentManageProfilePage', compact('navProfile'));
    }

    public function studentChangePasswordPage()
    {
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('student.studentChangePasswordPage', compact('navProfile'));
    }

    public function studentChangePassword(Request $request)
    {
        $this->validatePassword($request);
        $data = $this->getPassword($request);
        $dbPassword = User::select('password')->where('id', Auth::user()->id)->value('password');
        if (Hash::check($request->oldPwd, $dbPassword)) {
            $data = [
                'password' => Hash::make($request->newPwd),
            ];
            Auth::logoutOtherDevices($request->oldPwd);

            User::where('id', Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('user#dashboard');

        } else {
            return back()->with(['unMatch' => 'The Old Password is in Incorrect']);
        }
    }

    public function instructorManageProfilePage()
    {
        $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
        $userData = User::where('id', Auth::user()->id)->first()->toArray();
        return view('instructor.instructorManageProfilePage', compact('userData', 'navProfile'));
    }

    public function instructorEditProfilePage()
    {
        $data = User::where('id', Auth::user()->id)->first()->toArray();
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.instructorEditProfilePage', compact('data', 'navProfile'));
    }

    public function instructorUpdateProfile(Request $request)
    {
        $this->validateProfileData($request);
        $data = $this->getProfileData($request);
        if ($request->hasFile('profile_picture')) {
            $oldImg = User::select('profile_picture')->where('id', Auth::user()->id)->value('profile_picture');
            if ($oldImg != null) {
                Storage::delete('public/' . $oldImg);
            }
            $imgName = uniqid() . $request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')->storeAs('public', $imgName);
            $data['profile_picture'] = $imgName;
        }

        User::where('id', Auth::user()->id)->update($data);
        return redirect()->route('instructorManageProfilePage', compact('navProfile'));
    }

    public function instructorChangePasswordPage()
    {
        $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
        return view('instructor.instructorChangePasswordPage', compact('navProfile'));
    }

    public function instructorChangePassword(Request $request)
    {
        $this->validatePassword($request);
        $data = $this->getPassword($request);
        $dbPassword = User::select('password')->where('id', Auth::user()->id)->value('password');
        if (Hash::check($request->oldPwd, $dbPassword)) {
            $data = [
                'password' => Hash::make($request->newPwd),
            ];
            Auth::logoutOtherDevices($request->oldPwd);

            User::where('id', Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('user#dashboard');

        } else {
            return back()->with(['unMatch' => 'The Old Password is in Incorrect']);
        }
    }

    //Validate Data from Registration Form
    private function validateData($request)
    {
        Validator::make($request->all(),
            [
                'fName' => 'required',
                'lName' => 'required',
                'email' => 'required|unique:users,email,' . Auth::user()->id,
                'username' => 'required|unique:users,username,' . Auth::user()->id,
                'password' => 'required|min:8|max:15',
                'role' => 'required',
                'profile_picture' => 'nullable|mimes:jpg,jpeg,png',
            ], [
                'fName.required' => 'First Name is Required to Fill',
                'lName.required' => 'Last Name is Required to Fill',
                'email.required' => 'Email is Required to Fill',
                'email.unique' => 'The Account has already been Created with the Provided Email',
                'username.required' => 'Username is Required to Fill',
                'username.unique' => 'Username has already been taken',
                'password.required' => 'Password is Required to Fill',
                'password.min' => 'Password must have at least 8 characters',
                'password.max' => 'Password can only have a maximum of 15 characters',
                'role.required' => 'Role is Required to Fill',
                'profile_picture.mimes' => 'Image must be of type jpg, jpeg and png',
            ])->validate();
    }

    //Get Data from Registration Form
    private function getData($request)
    {
        return [
            'first_name' => $request->fName,
            'last_name' => $request->lName,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
        ];
    }

//     private function validateLoginData($request)
// {
//     $validator = Validator::make($request->all(), [
//         'email' => 'required|email',
//         'password' => 'required|min:8|max:15',
//     ], [
//         'email.required' => 'Email is required',
//         'email.email' => 'Please provide a valid email address',
//         'password.required' => 'Password is required',
//         'password.min' => 'Password must have at least 8 characters',
//         'password.max' => 'Password can have a maximum of 15 characters',
//     ]);

//     if ($validator->fails()) {
//         return redirect()->back()->withErrors($validator)->withInput();
//     }
// }

// private function getLoginData($request)
// {
//     return [
//         'email' => $request->email,
//         'password' => $request->password,
//     ];
// }

    private function validateProfileData($request)
    {
        Validator::make($request->all(),
            [
                'fName' => 'required',
                'lName' => 'required',
                'email' => 'required|unique:users,email,' . Auth::user()->id,
                'username' => 'required|unique:users,username,' . Auth::user()->id,
                'role' => 'required',
                'profile_picture' => 'nullable|mimes:jpg,jpeg,png',
            ], [
                'fName.required' => 'First Name is Required to Fill',
                'lName.required' => 'Last Name is Required to Fill',
                'email.required' => 'Email is Required to Fill',
                'email.unique' => 'Email has already been Taken',
                'username.required' => 'Username is Required to Fill',
                'username.unique' => 'Username has already been taken',
                'role.required' => 'Role is Required to Fill',
                'profile_picture.mimes' => 'Image must be of type jpg, jpeg and png',
            ])->validate();
    }

    //Get Data from Registration Form
    private function getProfileData($request)
    {
        return [
            'first_name' => $request->fName,
            'last_name' => $request->lName,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
        ];
    }

    private function getPassword($request)
    {
        return [
            'oldPwd' => $request->oldPwd,
            'newPwd' => $request->newPwd,
            'confirmPwd' => $request->confirmPwd,
        ];
    }

    private function validatePassword($request)
    {
        Validator::make($request->all(), [
            'oldPwd' => 'required|min:8|max:15',
            'newPwd' => 'required|min:8|max:15',
            'confirmPwd' => 'required|min:8|max:15|same:newPwd',
        ], [
            'oldPwd.required' => 'Old Password is Required',
            'oldPwd.min' => 'Password must have at least 6 characters',
            'oldPwd.max' => 'Password must not have more than 15 characters',
            'newPwd.required' => 'New Password is Required',
            'newPwd.min' => 'Password must have at least 6 characters',
            'newPwd.max' => 'Password must not have more than 15 characters',
            'confirmPwd.required' => 'Confirm Password is Required',
            'confirmPwd.min' => 'Password must have at least 6 characters',
            'confirmPwd.max' => 'Password must not have more than 15 characters',
            'confirmPwd.same' => 'New Password and Confirm Password must Match',
        ])->validate();
    }

    private function validateAdminData($request){
        Validator::make($request->all(),[
            'name'=>'required|exists:users,username',
        ],[
            'name.required'=>'Name is Required',
            'name.exists'=>'The User is not Registered. Only the Registered Users can be Changed to Admin Role!',
        ])->validate();
    }
}

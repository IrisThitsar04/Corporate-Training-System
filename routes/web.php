<?php

use App\Models\User;
use App\Models\StudentGrade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SortController;
use App\Http\Controllers\userController;
use App\Http\Middleware\adminMiddleware;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Middleware\studentMiddleware;
use App\Http\Middleware\instructorMiddleware;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\instructorController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\StudentGradeController;
use App\Http\Controllers\StudentProgressController;
use App\Http\Controllers\CourseEnrollmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
Route::redirect('/', '/loginPage');

Route::get('/loginPage', function () {
    return view('admin.login');
})->name('loginPage');

// Route::post('/userlogin', [userController::class, 'userLogin'])->name('userLogin');

Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [userController::class, 'dashboard'])->name('user#dashboard');

//Admin Route Group
    Route::prefix('admin')->middleware(adminMiddleware::class)->group(function () {
        Route::get('/registerPage', function () {
            $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
            return view('admin.register', compact('navProfile'));
        })->name('registerPage');

        Route::post('/userRegister', [userController::class, 'register'])->name('user#register');

        Route::get('adminDashboard', function () {
            $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
            return view('admin.adminDashboard', compact('navProfile'));
        })->name('adminDashboard');

        Route::get('createCoursePage', function () {
            $navProfile = User::select('profile_picture')->where('role', 'admin')->where('id', Auth::user()->id)->value('profile_picture');
            return view('admin.createCoursePage', compact('navProfile'));
        })->name('create#coursePage');

        Route::post('createCourse', [CourseController::class, 'createCourse'])->name('create#course');

        Route::get('courseListPage', [CourseController::class, 'displayCourses'])->name('courseListPage');

        Route::get('editCoursePage/{id}', [CourseController::class, 'editCoursePage'])->name('editCoursePage');

        Route::get('updateCoursePage/{id}', [CourseController::class, 'updateCoursePage'])->name('updateCoursePage');

        Route::post('updateCourse/{id}', [CourseController::class, 'updateCourse'])->name('update#course');

        Route::post('deleteCourse/{id}', [CourseController::class, 'deleteCourse'])->name('delete#course');

        Route::get('enrollStudentsPage',[CourseEnrollmentController::class, 'enrollStudentsPage'])->name('enrollStudentsPage');

        Route::post('enrollStudent',[CourseEnrollmentController::class, 'enrollStudents'])->name('enroll#student');

        Route::get('chooseCourseforProgress', [StudentProgressController::class, 'chooseCourseforProgress'])->name('chooseCourseforProgress');

        Route::get('studentCompletedCourses/{id}', [StudentProgressController::class, 'studentCompletedCourses'])->name('studentCompletedCourses');

        Route::get('sortStudentData/{id}', [SortController::class, 'sortStudentData'])->name('sortStudentData');

        Route::get('manageProfilePage', [UserController::class, 'manageProfilePage'])->name('manageProfilePage');

        Route::get('adminEditProfilePage', [UserController::class, 'adminEditProfilePage'])->name('adminEditProfilePage');

        Route::post('adminUpdateProfile', [UserController::class, 'adminUpdateProfile'])->name('adminUpdateProfile');

        Route::get('adminChangePasswordPage', [UserController::class, 'adminChangePasswordPage'])->name('adminChangePasswordPage');

        Route::post('adminChangePassword', [UserController::class, 'adminChangePassword'])->name('adminChangePassword');

        Route::get('addAdminPage', [userController::class, 'addAdminPage'])->name('addAdminPage');

        Route::post('addAdmin', [userController::class, 'addAdmin'])->name('addAdmin');

        Route::get('courseRelatedPage', [courseController::class, 'courseRelatedPage'])->name('courseRelatedPage');

        Route::get('instructorsRelatedPage', [instructorController::class, 'instructorsRelatedPage'])->name('instructorsRelatedPage');

        Route::get('instructorList', [instructorController::class, 'instructorList'])->name('instructorList');

        Route::get('sortInstructorList', [SortController::class, 'sortInstructorList'])->name('sortInstructorList');

        Route::get('studentsRelatedPage', [userController::class, 'studentsRelatedPage'])->name('studentsRelatedPage');

        Route::get('adminRelatedPage', [userController::class, 'adminRelatedPage'])->name('adminRelatedPage');

        Route::get('adminList', [userController::class, 'adminList'])->name('adminList');

        Route::get('sortAdminList', [SortController::class, 'sortAdminList'])->name('sortAdminList');

        Route::get('studentList', [userController::class, 'studentList'])->name('studentList');

        Route::get('sortStudentList', [SortController::class, 'sortStudentList'])->name('sortStudentList');

    });

//Student Route Group
    Route::prefix('student')->middleware(studentMiddleware::class)->group(function () {
        Route::get('/studentDashboard', function () {
            $navProfile = User::select('profile_picture')->where('role', 'student')->where('id', Auth::user()->id)->value('profile_picture');
            return view('student.studentDashboard', compact('navProfile'));
        })->name('studentDashboard');

        Route::get('enrolledCoursesPage/{id}',[CourseEnrollmentController::class,'enrolledCoursesPage'])->name('enrolledCoursesPage');

        Route::get('modulesDisplayPage/{id}', [CourseEnrollmentController::class, 'modulesDisplayPage'])->name('modulesDisplayPage');

        Route::get('lessonsDisplayPage/{id}', [CourseEnrollmentController::class, 'lessonsDisplayPage'])->name('lessonsDisplayPage');

        Route::get('individualLessonPage/{id}',[CourseEnrollmentController::class, 'individualLessonPage'])->name('individualLessonPage');

        Route::post('moduleDone/{id}/{moduleId}', [StudentProgressController::class, 'moduleDone'])->name('moduleDone');

        Route::get('assignmentPage/{id}', [AssignmentController::class, 'assignmentPage'])->name('assignmentPage');

        Route::get('detailedAssignmentPage/{id}', [AssignmentController::class, 'detailedAssignmentPage'])->name('detailedAssignmentPage');

        Route::post('submitAssignment/{id}',[SubmissionController::class,'submitAssignment'])->name('submitAssignment');

        Route::get('studentMailBoxPage',[AssignmentController::class, 'studentMailBoxPage'])->name('studentMailBoxPage');

        Route::get('chooseCourseforStudentProgress', [StudentProgressController::class, 'chooseCourseforStudentProgress'])->name('chooseCourseforStudentProgress');

        Route::get('trackStudentCompletedCourses/{id}', [StudentProgressController::class, 'trackStudentCompletedCourses'])->name('trackStudentCompletedCourses');

        Route::get('completedCourseList', [CourseController::class, 'completedCourseList'])->name('completedCourseList');

        Route::get('InstructorList', [userController::class, 'InstructorList'])->name('InstructorList');

        Route::get('assignmentGradePage', [StudentGradeController::class, 'assignmentGradePage'])->name('assignmentGradePage');

        Route::get('assignmentRelatedPage', [AssignmentController::class, 'assignmentRelatedPage'])->name('assignmentRelatedPage');

        Route::get('studentManageProfilePage', [UserController::class, 'studentManageProfilePage'])->name('studentManageProfilePage');

        Route::get('studentEditProfilePage', [UserController::class, 'studentEditProfilePage'])->name('studentEditProfilePage');

        Route::post('studentUpdateProfile', [UserController::class, 'studentUpdateProfile'])->name('studentUpdateProfile');

        Route::get('studentChangePasswordPage', [UserController::class, 'studentChangePasswordPage'])->name('studentChangePasswordPage');

        Route::post('studentChangePassword', [UserController::class, 'studentChangePassword'])->name('studentChangePassword');

        Route::get('submittedAssignmentPage', [SubmissionController::class, 'submittedAssignmentPage'])->name('submittedAssignmentPage');

        Route::get('undoTurnInPage/{id}', [SubmissionController::class, 'undoTurnInPage'])->name('undoTurnInPage');

        Route::post('assignmentTurnInAgain/{id}', [SubmissionController::class, 'assignmentTurnInAgain'])->name('assignmentTurnInAgain');


    });

//Instructor Route Group
    Route::prefix('instructor')->middleware(instructorMiddleware::class)->group(function () {
        Route::get('/instructorDashboard', function () {
            $navProfile = User::select('profile_picture')->where('role', 'instructor')->where('id', Auth::user()->id)->value('profile_picture');
            return view('instructor.instructorDashboard', compact('navProfile'));
        })->name('instructorDashboard');

        Route::get('assignedCourseListPage', [instructorController::class, 'assignedCourses'])->name('assignedCourseListPage');

        Route::get('assignedCourseDetailsPage/{id}', [instructorController::class, 'assignedCourseDetails'])->name('assignedCourseDetailsPage');

        Route::get('enrolledStudentListPage', [instructorController::class, 'enrolledStudentListPage'])->name('enrolledStudentListPage');

        Route::get('chooseCourseforModule', [CourseController::class, 'chooseCourseforModule'])->name('chooseCourseforModule');

        Route::get('uploadModulePage/{id}', [ModuleController::class, 'uploadModulePage'])->name('uploadModulePage');

        Route::post('uploadModule', [ModuleController::class, 'uploadModule'])->name('upload#module');

        Route::get('uploadedModulesPage/{id}', [ModuleController::class, 'uploadedModulesPage'])->name('uploadedModulesPage');

        Route::get('editModulePage/{id}', [ModuleController::class, 'editModulePage'])->name('editModulePage');

        Route::post('updateModule/{id}', [ModuleController::class, 'updateModule'])->name('update#module');

        Route::delete('deleteModule/{id}', [ModuleController::class, 'deleteModule'])->name('delete#module');

        Route::get('chooseCourseforLesson', [CourseController::class, 'chooseCourseforLesson'])->name('chooseCourseforLesson');

        Route::get('uploadLessonPage/{id}', [LessonController::class, 'uploadLessonPage'])->name('uploadLessonPage');

        Route::post('uploadLesson', [LessonController::class, 'uploadLesson'])->name('upload#lesson');

        Route::get('uploadedLessonsPage/{id}', [LessonController::class, 'uploadedLessonsPage'])->name('uploadedLessonsPage');

        Route::get('individualLesson/{id}', [LessonController::class, 'individualLesson'])->name('individualLesson');

        Route::get('editLessonPage/{id}', [LessonController::class, 'editLessonPage'])->name('editLessonPage');

        Route::post('updateLesson/{id}', [LessonController::class, 'updateLesson'])->name('update#lesson');

        Route::delete('deleteLesson/{id}', [LessonController::class, 'deleteLesson'])->name('delete#lesson');

        Route::get('chooseCourseforAssignment', [CourseController::class, 'chooseCourseforAssignment'])->name('chooseCourseforAssignment');

        Route::get('uploadAssignmentPage',[AssignmentController::class, 'uploadAssignmentPage'])->name('uploadAssignmentPage');

        Route::post('uploadAssignment', [AssignmentController::class, 'uploadAssignment'])->name('uploadAssignment');

        Route::get('chooseCourse_Assignment/{id}', [AssignmentController::class, 'chooseCourse_Assignment'])->name('chooseCourse_Assignment');

        Route::get('uploadedAssignmentsPage/{id}', [AssignmentController::class, 'uploadedAssignmentsPage'])->name('uploadedAssignmentsPage');

        Route::get('editAssignmentPage/{id}', [AssignmentController::class, 'editAssignmentPage'])->name('editAssignmentPage');

        Route::post('updateAssignment/{id}', [AssignmentController::class, 'updateAssignment'])->name('updateAssignment');

        Route::delete('deleteAssignment/{id}/{course_id}', [AssignmentController::class, 'deleteAssignment'])->name('deleteAssignment');

        Route::get('individualAssignment/{id}', [AssignmentController::class, 'individualAssignment'])->name('individualAssignment');

        Route::get('chooseCourseforSubmissions', [CourseController::class, 'chooseCourseforSubmissions'])->name('chooseCourseforSubmissions');

        Route::get('chooseAssignment/{id}', [AssignmentController::class, 'chooseAssignment'])->name('chooseAssignment');

        Route::get('viewSubmissionsPage/{id}', [SubmissionController::class, 'viewSubmissionsPage'])->name('viewSubmissionsPage');

        Route::get('IndividualSubmissionsPage/{id}', [SubmissionController::class, 'IndividualSubmissionsPage'])->name('IndividualSubmissionsPage');

        Route::post('uploadGrade/{id}/{studentId}/{submission_id}', [StudentGradeController::class, 'uploadGrade'])->name('uploadGrade');

        Route::get('chooseCourseforGrades', [CourseController::class, 'chooseCourseforGrades'])->name('chooseCourseforGrades');

        Route::get('editGrade/{id}', [StudentGradeController::class, 'editGrade'])->name('editGrade');

        Route::post('updateGrade/{id}', [StudentGradeController::class, 'updateGrade'])->name('updateGrade');

        Route::get('chooseAssignmentforGrades/{id}', [AssignmentController::class, 'chooseAssignmentforGrades'])->name('chooseAssignmentforGrades');

        Route::get('assignmentGradeList/{id}', [StudentGradeController::class, 'assignmentGradeList'])->name('assignmentGradeList');

        Route::get('instructorCourseRelatedPage', [CourseController::class, 'instructorCourseRelatedPage'])->name('instructorCourseRelatedPage');

        Route::get('instructorAssignmentRelatedPage', [AssignmentController::class, 'instructorAssignmentRelatedPage'])->name('instructorAssignmentRelatedPage');

        Route::get('instructorManageProfilePage', [UserController::class, 'instructorManageProfilePage'])->name('instructorManageProfilePage');

        Route::get('instructorEditProfilePage', [UserController::class, 'instructorEditProfilePage'])->name('instructorEditProfilePage');

        Route::post('instructorUpdateProfile', [UserController::class, 'instructorUpdateProfile'])->name('instructorUpdateProfile');

        Route::get('instructorChangePasswordPage', [UserController::class, 'instructorChangePasswordPage'])->name('instructorChangePasswordPage');

        Route::post('instructorChangePassword', [UserController::class, 'instructorChangePassword'])->name('instructorChangePassword');

        Route::get('chooseCourseforProgressPage', [StudentProgressController::class, 'chooseCourseforProgressPage'])->name('chooseCourseforProgressPage');

        Route::get('courseCompletionPercentage/{id}', [StudentProgressController::class, 'courseCompletionPercentage'])->name('courseCompletionPercentage');

    });

});

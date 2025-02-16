<?php
// routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;

// Admin
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Home', route('adminDashboard'));
});

// Admin -> Courses
Breadcrumbs::for('admin.courses.list', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Courses', route('courseListPage'));
});

// Admin -> Courses -> Create
Breadcrumbs::for('admin.courses.create', function ($trail) {
    $trail->parent('admin.courses.list');
    $trail->push('Create Course', route('create#coursePage'));
});

// Admin -> Courses -> Edit
Breadcrumbs::for('admin.courses.edit', function ($trail, $courseId) {
    $trail->parent('admin.courses.list');
    $trail->push('Edit Course', route('editCoursePage', $courseId));
});

// Admin -> Courses -> Enroll Students
Breadcrumbs::for('admin.courses.enroll', function ($trail) {
    $trail->parent('admin.courses.list');
    $trail->push('Enroll Students', route('enrollStudentsPage'));
});

// Admin -> Choose Course for Progress
Breadcrumbs::for('admin.chooseCourse', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Choose Course', route('chooseCourseforProgress'));
});

// Admin -> Choose Course for Progress-> Student Progress
Breadcrumbs::for('admin.studentProgress', function ($trail, $courseId) {
    $trail->parent('admin.chooseCourse');
    $trail->push('Student Progress', route('studentCompletedCourses', $courseId));
});



// Student
Breadcrumbs::for('student.dashboard', function ($trail) {
    $trail->push('Home', route('studentDashboard'));
});

// Student -> Enrolled Courses
Breadcrumbs::for('student.enrolledCourses', function ($trail, $studentId) {
    $trail->parent('student.dashboard');
    $trail->push('Enrolled Courses', route('enrolledCoursesPage', $studentId));
});

// Student -> Enrolled Courses -> Modules
Breadcrumbs::for('student.modules', function ($trail, $courseId, $studentId) {
    $trail->parent('student.enrolledCourses', $studentId);
    $trail->push('Modules', route('modulesDisplayPage', $courseId));
});

// Student -> Enrolled Courses -> Modules-> Lessons
Breadcrumbs::for('student.lessons', function ($trail, $courseId, $studentId, $moduleId) {
    $trail->parent('student.modules', $courseId, $studentId);
    $trail->push('Lessons', route('lessonsDisplayPage', $moduleId));
});

// Student -> Enrolled Courses -> Modules-> Lessons -> Individual Lesson
Breadcrumbs::for('student.individualLesson', function ($trail, $courseId, $studentId, $moduleId, $lessonId) {
    $trail->parent('student.lessons', $courseId, $studentId, $moduleId);
    $trail->push('Individual Lesson', route('individualLessonPage', ['id'=>$lessonId, 'moduleId'=>$moduleId]));
});

// Instructor
Breadcrumbs::for('instructor.dashboard', function ($trail) {
    $trail->push('Home', route('instructorDashboard'));
});

// Instructor -> Assigned Courses
Breadcrumbs::for('instructor.assignedCourses', function ($trail) {
    $trail->parent('instructor.dashboard');
    $trail->push('Assigned Courses', route('assignedCourseListPage'));
});

// Instructor -> Assigned Courses -> Course Details
Breadcrumbs::for('instructor.assignedCourseDetails', function ($trail, $courseId) {
    $trail->parent('instructor.assignedCourses');
    $trail->push('Course Details', route('assignedCourseDetailsPage', $courseId));
});

// Instructor -> Assigned Courses -> Course Details->Modules
Breadcrumbs::for('instructor.modules.list', function ($trail, $courseId) {
    $trail->parent('instructor.assignedCourseDetails', $courseId);
    $trail->push('Modules', route('uploadedModulesPage', $courseId));
});

// Instructor -> Assigned Courses -> Course Details->Modules -> Upload Module
Breadcrumbs::for('instructor.modules.upload', function ($trail, $courseId) {
    $trail->parent('instructor.modules.list', $courseId);
    $trail->push('Upload Module', route('uploadModulePage', $courseId));
});

// Instructor -> Assigned Courses -> Course Details->Modules -> Edit Module
Breadcrumbs::for('instructor.modules.edit', function ($trail, $courseId, $moduleId) {
    $trail->parent('instructor.modules.list', $courseId);
    $trail->push('Edit Module', route('editModulePage', $moduleId));
});

// Instructor -> Assigned Courses -> Course Details->Modules -> Delete Module
Breadcrumbs::for('instructor.modules.delete', function ($trail, $courseId, $moduleId) {
    $trail->parent('instructor.modules.list', $courseId);
    $trail->push('Delete Module', route('delete#module', $moduleId));
});

// Instructor -> Assigned Courses -> Course Details->Modules -> Lessons
Breadcrumbs::for('instructor.lessons.list', function ($trail, $courseId, $moduleId) {
    $trail->parent('instructor.modules.list', $courseId);
    $trail->push('Lessons', route('uploadedLessonsPage', $courseId, $moduleId));
});

// Instructor -> Assigned Courses -> Course Details->Modules -> Lessons -> Upload Lesson
Breadcrumbs::for('instructor.lesson.upload', function ($trail, $moduleId) {
    $trail->parent('instructor.lessons.list', $moduleId);
    $trail->push('Upload Lesson', route('uploadLessonPage', $moduleId));
});

// Instructor -> Assigned Courses -> Course Details->Modules -> Lessons -> Edit Lesson
Breadcrumbs::for('instructor.lesson.edit', function ($trail, $moduleId) {
    $trail->parent('instructor.lessons.list', $moduleId);
    $trail->push('Edit Lesson', route('editLessonPage', $moduleId));
});

// Instructor -> Assigned Courses -> Course Details->Modules -> Lessons -> Delete Lesson
Breadcrumbs::for('instructor.lesson.delete', function ($trail, $moduleId) {
    $trail->parent('instructor.lessons.list', $moduleId);
    $trail->push('Delete Lesson', route('delete#lesson', $moduleId));
});

// Instructor -> Assigned Courses -> Course Details->Modules -> Lessons -> Delete Lesson
Breadcrumbs::for('instructor.lesson.individualLesson', function ($trail, $courseId, $moduleId) {
    $trail->parent('instructor.lessons.list', $courseId, $moduleId);
    $trail->push('Lesson', route('individualLesson', $moduleId));
});

// Instructor -> Upload Assignment
Breadcrumbs::for('instructor.uploadAssignment', function ($trail) {
    $trail->parent('instructor.dashboard');
    $trail->push('Upload  Assignment', route('uploadAssignmentPage'));
});

// Instructor -> Choose Course
Breadcrumbs::for('instructor.chooseCourse', function ($trail, $instructorId) {
    $trail->parent('instructor.dashboard');
    $trail->push('Choose Course', route('chooseCourse_Assignment', $instructorId));
});

// Instructor -> Choose Course-> Uploaded Assignments
Breadcrumbs::for('instructor.assignments.list', function ($trail, $instructorId, $courseId) {
    $trail->parent('instructor.chooseCourse', $instructorId);
    $trail->push('Uploaded Assignments', route('uploadedAssignmentsPage', $courseId));
});

// Instructor -> Choose Course-> Uploaded Assignments -> Edit Assignment
Breadcrumbs::for('instructor.assignment.edit', function ($trail, $instructorId, $courseId, $assignmentId) {
    $trail->parent('instructor.assignments.list', $instructorId, $courseId);
    $trail->push('Edit Assignment', route('editAssignmentPage', $assignmentId));
});

// Instructor -> Choose Course-> Uploaded Assignments -> Individual Assignment
Breadcrumbs::for('instructor.assignment.individual', function ($trail, $instructorId, $courseId, $assignmentId) {
    $trail->parent('instructor.assignments.list', $instructorId, $courseId);
    $trail->push('Assignment', route('individualAssignment', $assignmentId));
});

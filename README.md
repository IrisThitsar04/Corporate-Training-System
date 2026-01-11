# Corporate Training Platform

## Project Overview

This project presents the design and development of a web-based corporate training platform. The platform is designed to enhance employee learning through improved usability, mobile compatibility, structured content management, effective tracking mechanisms, and robust security considerations.

The system supports corporate learning through role-based interfaces for administrators, instructors, and students. Each user role is provided with access only to functionalities relevant to their responsibilities. The project follows a structured System Development Life Cycle (SDLC) using the Waterfall methodology, based on a clearly defined scope and stable requirements.

## Key Features

- Role-based interfaces (Admin, Instructor, Student)
- Course, module, and lesson management
- Assignment upload, submission, grading, and resubmission
- Course completion percentage tracking
- Assignment-related notifications
- Responsive layout for desktop, tablet, and mobile devices
- Authentication and role-based access control


## Technical Scope

- Development of a multi-role web application
- Implementation of role-based authentication and access control
- Relational database schema design and integration
- Backend development using Laravel
- Frontend development with HTML, CSS, Bootstrap, and JavaScript
- Assignment tracking and progress monitoring functionality
- Usability-focused interface design

  
## User Roles and Interfaces

The system contains three distinct interfaces, each designed for a specific user role.

### Admin Interface

Administrators are responsible for overall system management, including:

- User registration
- Course creation
- Student and instructor enrollment
- Admin account management

### Instructor Interface

The instructor interface supports instructional and assessment-related activities, including:

- Uploading, editing, and deleting modules, lessons, and assignments
- Viewing and grading student assignment submissions
- Tracking student progress and course completion
- Managing enrolled students within assigned courses

### Student Interface

The student interface provides access to learning and submission features, including:

- Accessing course materials (modules and lessons)
- Submitting and resubmitting assignments
- Viewing grades and course completion percentages
- Receiving notifications related to assignments
- Managing personal profile information

Users are restricted to accessing only the interface associated with their assigned role. Attempts to access unauthorized pages result in redirection to the login page.

## Development Approach

- System Development Life Cycle (SDLC)
- Waterfall methodology

The Waterfall approach was selected due to:

- Clearly defined project scope
- Stable requirements
- Predictable deliverables
- Emphasis on documentation and structured development

## Interface Design Considerations

The platform incorporates the following design elements to support usability and consistency:

- Visual hierarchy
- Global navigation
- Minimalistic layout
- Well-captioned interface components
- Responsive liquid layout
- Error prevention and recovery mechanisms

These design choices aim to support clarity, consistency, and ease of use across the system.

## Core System Functionality

The system provides the following core functionalities:

- Course creation and management
- Module and lesson navigation
- Assignment upload, submission, grading, and resubmission
- Course completion percentage calculation
- Assignment-related notifications
- Profile management and password updates
- Authentication and role-based authorization
- Tracking of assignment submissions and student grades
- Visual representation of progress using charts

These features support instructors and administrators in reviewing learner activity and progress.

## Database Design

The system uses a relational database consisting of ten interconnected tables to manage:

- User information
- Courses and enrollments
- Modules and lessons
- Assignments and submissions
- Student progress and grades

Foreign key relationships are used to maintain data integrity and support data retrieval across the system.

## Technology Stack

### Frontend

- HTML
- CSS
- Bootstrap
- JavaScript

### Backend

- Laravel

### Server & Database

- Apache Web Server
- PHPMyAdmin
- Relational database
  
### Visualization

- Chart.js

## Conclusion

This project documents the development of a corporate training platform designed using a structured SDLC approach and guided by usability and visual perception principles. By implementing role-based interfaces, structured navigation, and tracking features, the system supports core corporate training activities while maintaining a clear separation of responsibilities across user roles.

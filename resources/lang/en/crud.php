<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'schools' => [
        'name' => 'Schools',
        'index_title' => 'Schools List',
        'new_title' => 'New School',
        'create_title' => 'Create School',
        'edit_title' => 'Edit School',
        'show_title' => 'Show School',
        'inputs' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'address' => 'Address',
            'phone' => 'Phone',
            'url' => 'Url',
        ],
    ],

    'school_periods' => [
        'name' => 'School Periods',
        'index_title' => 'Periods List',
        'new_title' => 'New Period',
        'create_title' => 'Create Period',
        'edit_title' => 'Edit Period',
        'show_title' => 'Show Period',
        'inputs' => [
            'name' => 'Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'status' => 'Status',
        ],
    ],

    'careers' => [
        'name' => 'Careers',
        'index_title' => 'Careers List',
        'new_title' => 'New Career',
        'create_title' => 'Create Career',
        'edit_title' => 'Edit Career',
        'show_title' => 'Show Career',
        'inputs' => [
            'name' => 'Name',
            'description' => 'Description',
            'school_id' => 'School',
        ],
    ],

    'career_mallas' => [
        'name' => 'Career Mallas',
        'index_title' => 'Mallas List',
        'new_title' => 'New Malla',
        'create_title' => 'Create Malla',
        'edit_title' => 'Edit Malla',
        'show_title' => 'Show Malla',
        'inputs' => [
            'name' => 'Name',
            'year' => 'Year',
        ],
    ],

    'malla_levels' => [
        'name' => 'Malla Levels',
        'index_title' => 'Levels List',
        'new_title' => 'New Level',
        'create_title' => 'Create Level',
        'edit_title' => 'Edit Level',
        'show_title' => 'Show Level',
        'inputs' => [
            'number' => 'Number',
            'name' => 'Name',
        ],
    ],

    'level_matters' => [
        'name' => 'Level Matters',
        'index_title' => 'Matters List',
        'new_title' => 'New Matter',
        'create_title' => 'Create Matter',
        'edit_title' => 'Edit Matter',
        'show_title' => 'Show Matter',
        'inputs' => [
            'name' => 'Name',
            'credits' => 'Credits',
        ],
    ],

    'mallas' => [
        'name' => 'Mallas',
        'index_title' => 'Mallas List',
        'new_title' => 'New Malla',
        'create_title' => 'Create Malla',
        'edit_title' => 'Edit Malla',
        'show_title' => 'Show Malla',
        'inputs' => [
            'name' => 'Name',
            'year' => 'Year',
            'career_id' => 'Career',
        ],
    ],

    'matters' => [
        'name' => 'Matters',
        'index_title' => 'Matters List',
        'new_title' => 'New Matter',
        'create_title' => 'Create Matter',
        'edit_title' => 'Edit Matter',
        'show_title' => 'Show Matter',
        'inputs' => [
            'name' => 'Name',
            'credits' => 'Credits',
            'level_id' => 'Level',
        ],
    ],

    'malla_levels' => [
        'name' => 'Malla Levels',
        'index_title' => 'Levels List',
        'new_title' => 'New Level',
        'create_title' => 'Create Level',
        'edit_title' => 'Edit Level',
        'show_title' => 'Show Level',
        'inputs' => [
            'number' => 'Number',
            'name' => 'Name',
        ],
    ],

    'level_matters' => [
        'name' => 'Level Matters',
        'index_title' => 'Matters List',
        'new_title' => 'New Matter',
        'create_title' => 'Create Matter',
        'edit_title' => 'Edit Matter',
        'show_title' => 'Show Matter',
        'inputs' => [
            'name' => 'Name',
            'credits' => 'Credits',
        ],
    ],

    'matter_courses' => [
        'name' => 'Matter Courses',
        'index_title' => 'Courses List',
        'new_title' => 'New Course',
        'create_title' => 'Create Course',
        'edit_title' => 'Edit Course',
        'show_title' => 'Show Course',
        'inputs' => [
            'period_id' => 'Period',
            'name' => 'Name',
        ],
    ],

    'courses' => [
        'name' => 'Courses',
        'index_title' => 'Courses List',
        'new_title' => 'New Course',
        'create_title' => 'Create Course',
        'edit_title' => 'Edit Course',
        'show_title' => 'Show Course',
        'inputs' => [
            'name' => 'Name',
            'matter_id' => 'Matter',
            'period_id' => 'Period',
        ],
    ],

    'course_course_classes' => [
        'name' => 'Course Course Classes',
        'index_title' => 'CourseClasses List',
        'new_title' => 'New Course class',
        'create_title' => 'Create CourseClass',
        'edit_title' => 'Edit CourseClass',
        'show_title' => 'Show CourseClass',
        'inputs' => [
            'name' => 'Name',
            'description' => 'Description',
            'content' => 'Content',
        ],
    ],

    'course_class_course_class_tasks' => [
        'name' => 'CourseClass Course Class Tasks',
        'index_title' => 'CourseClassTasks List',
        'new_title' => 'New Course class task',
        'create_title' => 'Create CourseClassTask',
        'edit_title' => 'Edit CourseClassTask',
        'show_title' => 'Show CourseClassTask',
        'inputs' => [
            'name' => 'Name',
            'content' => 'Content',
            'file' => 'File',
            'score' => 'Score',
        ],
    ],

    'course_class_task_student_tasks' => [
        'name' => 'CourseClassTask Student Tasks',
        'index_title' => 'StudentTasks List',
        'new_title' => 'New Student task',
        'create_title' => 'Create StudentTask',
        'edit_title' => 'Edit StudentTask',
        'show_title' => 'Show StudentTask',
        'inputs' => [
            'name' => 'Name',
            'student_id' => 'Student',
        ],
    ],

    'admissions' => [
        'name' => 'Admissions',
        'index_title' => 'Admissions List',
        'new_title' => 'New Admission',
        'create_title' => 'Create Admission',
        'edit_title' => 'Edit Admission',
        'show_title' => 'Show Admission',
        'inputs' => [
            'requester_id' => 'Requester',
            'malla_id' => 'Malla',
            'status' => 'Status',
        ],
    ],

    'course_classes' => [
        'name' => 'Course Classes',
        'index_title' => 'CourseClasses List',
        'new_title' => 'New Course class',
        'create_title' => 'Create CourseClass',
        'edit_title' => 'Edit CourseClass',
        'show_title' => 'Show CourseClass',
        'inputs' => [
            'course_id' => 'Course',
            'name' => 'Name',
            'description' => 'Description',
            'content' => 'Content',
        ],
    ],

    'course_class_all_assistances' => [
        'name' => 'CourseClass All Assistances',
        'index_title' => 'AllAssistances List',
        'new_title' => 'New Assistances',
        'create_title' => 'Create Assistances',
        'edit_title' => 'Edit Assistances',
        'show_title' => 'Show Assistances',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'course_class_class_comments' => [
        'name' => 'CourseClass Class Comments',
        'index_title' => 'ClassComments List',
        'new_title' => 'New Class comment',
        'create_title' => 'Create ClassComment',
        'edit_title' => 'Edit ClassComment',
        'show_title' => 'Show ClassComment',
        'inputs' => [
            'name' => 'Name',
            'comment_id' => 'Comment',
        ],
    ],

    'course_class_course_class_tasks' => [
        'name' => 'CourseClass Course Class Tasks',
        'index_title' => 'CourseClassTasks List',
        'new_title' => 'New Course class task',
        'create_title' => 'Create CourseClassTask',
        'edit_title' => 'Edit CourseClassTask',
        'show_title' => 'Show CourseClassTask',
        'inputs' => [
            'name' => 'Name',
            'content' => 'Content',
            'file' => 'File',
            'score' => 'Score',
        ],
    ],

    'course_class_task_student_tasks' => [
        'name' => 'CourseClassTask Student Tasks',
        'index_title' => 'StudentTasks List',
        'new_title' => 'New Student task',
        'create_title' => 'Create StudentTask',
        'edit_title' => 'Edit StudentTask',
        'show_title' => 'Show StudentTask',
        'inputs' => [
            'name' => 'Name',
            'student_id' => 'Student',
        ],
    ],

    'student_task_student_task_attaches' => [
        'name' => 'StudentTask Student Task Attaches',
        'index_title' => 'StudentTaskAttaches List',
        'new_title' => 'New Student task attach',
        'create_title' => 'Create StudentTaskAttach',
        'edit_title' => 'Edit StudentTaskAttach',
        'show_title' => 'Show StudentTaskAttach',
        'inputs' => [
            'attach_id' => 'Attach',
        ],
    ],

    'comments' => [
        'name' => 'Comments',
        'index_title' => 'Comments List',
        'new_title' => 'New Comment',
        'create_title' => 'Create Comment',
        'edit_title' => 'Edit Comment',
        'show_title' => 'Show Comment',
        'inputs' => [
            'author_id' => 'Author',
            'name' => 'Name',
            'content' => 'Content',
            'file' => 'File',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'user_admissions' => [
        'name' => 'User Admissions',
        'index_title' => 'Admissions List',
        'new_title' => 'New Admission',
        'create_title' => 'Create Admission',
        'edit_title' => 'Edit Admission',
        'show_title' => 'Show Admission',
        'inputs' => [
            'malla_id' => 'Malla',
            'status' => 'Status',
        ],
    ],

    'admission_admission_ataches' => [
        'name' => 'Admission Admission Ataches',
        'index_title' => 'AdmissionAtaches List',
        'new_title' => 'New Admission atach',
        'create_title' => 'Create AdmissionAtach',
        'edit_title' => 'Edit AdmissionAtach',
        'show_title' => 'Show AdmissionAtach',
        'inputs' => [],
    ],

    'user_student_tasks' => [
        'name' => 'User Student Tasks',
        'index_title' => 'StudentTasks List',
        'new_title' => 'New Student task',
        'create_title' => 'Create StudentTask',
        'edit_title' => 'Edit StudentTask',
        'show_title' => 'Show StudentTask',
        'inputs' => [
            'task_id' => 'Task',
            'name' => 'Name',
        ],
    ],

    'student_task_student_task_attaches' => [
        'name' => 'StudentTask Student Task Attaches',
        'index_title' => 'StudentTaskAttaches List',
        'new_title' => 'New Student task attach',
        'create_title' => 'Create StudentTaskAttach',
        'edit_title' => 'Edit StudentTaskAttach',
        'show_title' => 'Show StudentTaskAttach',
        'inputs' => [
            'attach_id' => 'Attach',
        ],
    ],

    'user_enrollments' => [
        'name' => 'User Enrollments',
        'index_title' => 'Enrollments List',
        'new_title' => 'New Enrollment',
        'create_title' => 'Create Enrollment',
        'edit_title' => 'Edit Enrollment',
        'show_title' => 'Show Enrollment',
        'inputs' => [
            'course_id' => 'Course',
            'name' => 'Name',
        ],
    ],

    'user_courses' => [
        'name' => 'User Courses',
        'index_title' => 'Courses List',
        'new_title' => 'New Course',
        'create_title' => 'Create Course',
        'edit_title' => 'Edit Course',
        'show_title' => 'Show Course',
        'inputs' => [
            'period_id' => 'Period',
            'matter_id' => 'Matter',
            'name' => 'Name',
        ],
    ],

    'course_course_classes' => [
        'name' => 'Course Course Classes',
        'index_title' => 'CourseClasses List',
        'new_title' => 'New Course class',
        'create_title' => 'Create CourseClass',
        'edit_title' => 'Edit CourseClass',
        'show_title' => 'Show CourseClass',
        'inputs' => [
            'name' => 'Name',
            'description' => 'Description',
            'content' => 'Content',
        ],
    ],

    'course_class_course_class_tasks' => [
        'name' => 'CourseClass Course Class Tasks',
        'index_title' => 'CourseClassTasks List',
        'new_title' => 'New Course class task',
        'create_title' => 'Create CourseClassTask',
        'edit_title' => 'Edit CourseClassTask',
        'show_title' => 'Show CourseClassTask',
        'inputs' => [
            'name' => 'Name',
            'content' => 'Content',
            'file' => 'File',
            'score' => 'Score',
        ],
    ],

    'course_class_task_student_tasks' => [
        'name' => 'CourseClassTask Student Tasks',
        'index_title' => 'StudentTasks List',
        'new_title' => 'New Student task',
        'create_title' => 'Create StudentTask',
        'edit_title' => 'Edit StudentTask',
        'show_title' => 'Show StudentTask',
        'inputs' => [
            'name' => 'Name',
            'student_id' => 'Student',
        ],
    ],

    'student_task_student_task_attaches' => [
        'name' => 'StudentTask Student Task Attaches',
        'index_title' => 'StudentTaskAttaches List',
        'new_title' => 'New Student task attach',
        'create_title' => 'Create StudentTaskAttach',
        'edit_title' => 'Edit StudentTaskAttach',
        'show_title' => 'Show StudentTaskAttach',
        'inputs' => [
            'attach_id' => 'Attach',
        ],
    ],

    'course_enrollments' => [
        'name' => 'Course Enrollments',
        'index_title' => 'Enrollments List',
        'new_title' => 'New Enrollment',
        'create_title' => 'Create Enrollment',
        'edit_title' => 'Edit Enrollment',
        'show_title' => 'Show Enrollment',
        'inputs' => [
            'student_id' => 'Student',
            'name' => 'Name',
        ],
    ],

    'enrollments' => [
        'name' => 'Enrollments',
        'index_title' => 'Enrollments List',
        'new_title' => 'New Enrollment',
        'create_title' => 'Create Enrollment',
        'edit_title' => 'Edit Enrollment',
        'show_title' => 'Show Enrollment',
        'inputs' => [
            'name' => 'Name',
            'student_id' => 'Student',
            'course_id' => 'Course',
        ],
    ],

    'admission_admission_ataches' => [
        'name' => 'Admission Admission Ataches',
        'index_title' => 'AdmissionAtaches List',
        'new_title' => 'New Admission atach',
        'create_title' => 'Create AdmissionAtach',
        'edit_title' => 'Edit AdmissionAtach',
        'show_title' => 'Show AdmissionAtach',
        'inputs' => [
            'file' => 'File',
            'name' => 'Name',
            'description' => 'Description',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];

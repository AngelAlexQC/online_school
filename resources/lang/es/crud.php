<?php

return [
    'common' => [
        'actions' => 'Acciones',
        'create' => 'Crear',
        'edit' => 'Editar',
        'update' => 'Actualizar',
        'new' => 'Nuevo',
        'cancel' => 'Cancelar',
        'save' => 'Guardar',
        'delete' => 'Borrar',
        'delete_selected' => 'Borrar Seleccionados',
        'search' => 'Buscar...',
        'back' => 'Regresar a la lista',
        'are_you_sure' => 'Estás Seguro?',
        'no_items_found' => 'No se encontraron elementos',
        'created' => 'Creado exitosamente!',
        'saved' => 'Guardado Exitosamente!',
        'removed' => 'Removido Exitosamente!',
    ],

    'schools' => [
        'name' => 'Escuelas',
        'index_title' => 'Escuelas',
        'new_title' => 'Nueva Escuela',
        'create_title' => 'Crear Escuela',
        'edit_title' => 'Editar Escuela',
        'show_title' => 'Detalle de Escuela',
        'inputs' => [
            'name' => 'Nombre',
            'slug' => 'Ruta',
            'address' => 'Dirección',
            'phone' => 'Teléfono',
            'url' => 'url',
        ],
    ],

    'school_periods' => [
        'name' => 'Períodos Lectivos',
        'index_title' => 'Períodos Lectivos',
        'new_title' => 'Nuevo/a Período',
        'create_title' => 'Crear Período',
        'edit_title' => 'Editar Período',
        'show_title' => 'Detalle de Período',
        'inputs' => [
            'name' => 'Nombre',
            'start_date' => 'Fecha de Inicio',
            'end_date' => 'Fecha de Finalización',
            'status' => 'Estado',
        ],
    ],

    'careers' => [
        'name' => 'Carreras',
        'index_title' => 'Lista de Carreras',
        'new_title' => 'Nuevo/a Carrera',
        'create_title' => 'Crear Carrera',
        'edit_title' => 'Editar Carrera',
        'show_title' => 'Detalle de Carrera',
        'inputs' => [
            'name' => 'Nombre',
            'description' => 'Descripción',
            'school_id' => 'Escuela',
        ],
    ],

    'career_mallas' => [
        'name' => 'Carrera Mallas',
        'index_title' => 'Lista de Mallas',
        'new_title' => 'Nuevo/a Malla',
        'create_title' => 'Crear Malla',
        'edit_title' => 'Editar Malla',
        'show_title' => 'Detalle de Malla',
        'inputs' => [
            'name' => 'Nombre',
            'year' => 'Año',
        ],
    ],

    'malla_levels' => [
        'name' => 'Niveles',
        'index_title' => 'Niveles',
        'new_title' => 'Nuevo/a Nivel',
        'create_title' => 'Crear Nivel',
        'edit_title' => 'Editar Nivel',
        'show_title' => 'Detalle de Nivel',
        'inputs' => [
            'number' => 'Número',
            'name' => 'Nombre',
        ],
    ],

    'level_matters' => [
        'name' => 'Materias',
        'index_title' => 'Lista de Materias por Nivel',
        'new_title' => 'Nuevo/a Materia',
        'create_title' => 'Crear Materia',
        'edit_title' => 'Editar Materia',
        'show_title' => 'Detalle de Materia',
        'inputs' => [
            'name' => 'Nombre',
            'credits' => 'Créditos',
        ],
    ],

    'mallas' => [
        'name' => 'Mallas',
        'index_title' => 'Lista de Mallas',
        'new_title' => 'Nuevo/a Malla',
        'create_title' => 'Crear Malla',
        'edit_title' => 'Editar Malla',
        'show_title' => 'Detalle de Malla',
        'inputs' => [
            'name' => 'Nombre',
            'year' => 'Año',
            'career_id' => 'Carrera',
        ],
    ],

    'matters' => [
        'name' => 'Materias',
        'index_title' => 'Lista de Materias',
        'new_title' => 'Nuevo/a Materia',
        'create_title' => 'Crear Materia',
        'edit_title' => 'Editar Materia',
        'show_title' => 'Detalle de Materia',
        'inputs' => [
            'name' => 'Nombre',
            'credits' => 'Créditos',
            'level_id' => 'Nivel',
        ],
    ],

    'malla_levels' => [
        'name' => 'Malla Niveles',
        'index_title' => 'Lista de Niveles',
        'new_title' => 'Nuevo/a Nivel',
        'create_title' => 'Crear Nivel',
        'edit_title' => 'Editar Nivel',
        'show_title' => 'Detalle de Nivel',
        'inputs' => [
            'number' => 'Número',
            'name' => 'Nombre',
        ],
    ],

    'level_matters' => [
        'name' => 'Nivel Materias',
        'index_title' => 'Lista de Materias',
        'new_title' => 'Nuevo/a Materia',
        'create_title' => 'Crear Materia',
        'edit_title' => 'Editar Materia',
        'show_title' => 'Detalle de Materia',
        'inputs' => [
            'name' => 'Nombre',
            'credits' => 'Créditos',
        ],
    ],

    'matter_courses' => [
        'name' => 'Materia Cursos',
        'index_title' => 'Lista de Cursos',
        'new_title' => 'Nuevo/a Curso',
        'create_title' => 'Crear Curso',
        'edit_title' => 'Editar Curso',
        'show_title' => 'Detalle de Curso',
        'inputs' => [
            'period_id' => 'Período',
            'name' => 'Nombre',
        ],
    ],

    'courses' => [
        'name' => 'Cursos',
        'index_title' => 'Lista de Cursos',
        'new_title' => 'Nuevo/a Curso',
        'create_title' => 'Crear Curso',
        'edit_title' => 'Editar Curso',
        'show_title' => 'Detalle de Curso',
        'inputs' => [
            'name' => 'Nombre',
            'matter_id' => 'Materia',
            'period_id' => 'Período',
        ],
    ],

    'course_course_classes' => [
        'name' => 'Clases del Curso',
        'index_title' => 'Lista de Clases del Curso',
        'new_title' => 'Nuevo/a Clase',
        'create_title' => 'Crear Clase',
        'edit_title' => 'Editar Clase',
        'show_title' => 'Detalle de Clase',
        'inputs' => [
            'name' => 'Nombre',
            'description' => 'Descripción',
            'content' => 'Contenido',
        ],
    ],

    'course_class_course_class_tasks' => [
        'name' => 'Tareas de clase',
        'index_title' => 'Lista de Tareas de la clase',
        'new_title' => 'Nuevo/a Tarea',
        'create_title' => 'Crear Tarea',
        'edit_title' => 'Editar Tarea',
        'show_title' => 'Detalle de Tarea',
        'inputs' => [
            'name' => 'Nombre',
            'content' => 'Contenido',
            'file' => 'Archivo',
            'score' => 'Puntaje',
        ],
    ],

    'course_class_task_student_tasks' => [
        'name' => 'Tareas Entregadas',
        'index_title' => 'Lista de Tareas Entregadas',
        'new_title' => 'Nuevo/a Tarea',
        'create_title' => 'Crear Tarea',
        'edit_title' => 'Editar Tarea',
        'show_title' => 'Detalle de Tarea',
        'inputs' => [
            'name' => 'Nombre',
            'student_id' => 'Estudiante',
        ],
    ],

    'admissions' => [
        'name' => 'Admisiones',
        'index_title' => 'Lista de Admisiones',
        'new_title' => 'Nuevo/a Admisión',
        'create_title' => 'Crear Admisión',
        'edit_title' => 'Editar Admisión',
        'show_title' => 'Detalle de Admisión',
        'inputs' => [
            'requester_id' => 'Aspirante',
            'malla_id' => 'Malla',
            'status' => 'Estado',
        ],
    ],

    'course_classes' => [
        'name' => 'Clases del Cursi',
        'index_title' => 'Lista de Clases del Curso',
        'new_title' => 'Nuevo/a Clase',
        'create_title' => 'Crear Clase',
        'edit_title' => 'Editar Clase',
        'show_title' => 'Detalle de Clase',
        'inputs' => [
            'course_id' => 'Curso',
            'name' => 'Nombre',
            'description' => 'Descripción',
            'content' => 'Contenido',
        ],
    ],

    'course_class_all_assistances' => [
        'name' => 'Asistencias de la clase',
        'index_title' => 'Lista de Asistentes de la clase',
        'new_title' => 'Nuevo/a Asistencia',
        'create_title' => 'Crear Asistencia',
        'edit_title' => 'Editar Asistencia',
        'show_title' => 'Detalle de Asistencia',
        'inputs' => [
            'name' => 'Nombre',
        ],
    ],

    'course_class_class_comments' => [
        'name' => 'Comentarios de la clase',
        'index_title' => 'Lista de Comentarios',
        'new_title' => 'Nuevo/a Comentario',
        'create_title' => 'Crear Comentario',
        'edit_title' => 'Editar Comentario',
        'show_title' => 'Detalle de Comentario',
        'inputs' => [
            'name' => 'Nombre',
            'comment_id' => 'Comentario',
        ],
    ],

    'course_class_course_class_tasks' => [
        'name' => 'Tareas de la clase',
        'index_title' => 'Lista de Tareas de la Clase',
        'new_title' => 'Nuevo/a tarea',
        'create_title' => 'Crear Tarea',
        'edit_title' => 'Editar Tarea',
        'show_title' => 'Detalle de Tarea',
        'inputs' => [
            'name' => 'Nombre',
            'content' => 'Contenido',
            'file' => 'Archivo',
            'score' => 'Puntaje',
        ],
    ],

    'course_class_task_student_tasks' => [
        'name' => 'Tareas Entregadas',
        'index_title' => 'Lista de Tareas entregadas',
        'new_title' => 'Nuevo/a Entrega',
        'create_title' => 'Crear Entrega',
        'edit_title' => 'Editar Entrega',
        'show_title' => 'Detalle de Entrega',
        'inputs' => [
            'name' => 'Nombre',
            'student_id' => 'Estudiante',
        ],
    ],

    'student_task_student_task_attaches' => [
        'name' => 'Archivos adjuntos a la tarea',
        'index_title' => 'Lista de archivos adjuntos a la tarea',
        'new_title' => 'Nuevo/a archivo',
        'create_title' => 'Crear Archivo',
        'edit_title' => 'Editar Archivo',
        'show_title' => 'Detalle de Archivo',
        'inputs' => [
            'attach_id' => 'Archivo',
        ],
    ],

    'comments' => [
        'name' => 'Comentarios',
        'index_title' => 'Lista de Comentarios',
        'new_title' => 'Nuevo/a Comentario',
        'create_title' => 'Crear Comentario',
        'edit_title' => 'Editar Comentario',
        'show_title' => 'Detalle de Comentario',
        'inputs' => [
            'author_id' => 'Autor',
            'name' => 'Nombre',
            'content' => 'Contenido',
            'file' => 'Archivo',
        ],
    ],

    'users' => [
        'name' => 'Usuarios',
        'index_title' => 'Lista de Usuarios',
        'new_title' => 'Nuevo/a Usuario',
        'create_title' => 'Crear Usuario',
        'edit_title' => 'Editar Usuario',
        'show_title' => 'Detalle de Usuario',
        'inputs' => [
            'first_name' => 'Nombres',
            'last_name' => 'Apellidos',
            'email' => 'Email',
            'password' => 'Contraseña',
        ],
    ],

    'user_admissions' => [
        'name' => 'Admisiones',
        'index_title' => 'Lista de Admisiones',
        'new_title' => 'Nuevo/a Admisión',
        'create_title' => 'Crear Admisión',
        'edit_title' => 'Editar Admisión',
        'show_title' => 'Detalle de Admisión',
        'inputs' => [
            'malla_id' => 'Malla',
            'status' => 'Estado',
        ],
    ],

    'admission_admission_ataches' => [
        'name' => 'Archivos adjuntos a la admisión',
        'index_title' => 'Lista de Archivos adjuntos de Admisión',
        'new_title' => 'Nuevo/a archivo adjunto',
        'create_title' => 'Crear archivo Adjunto',
        'edit_title' => 'Editar archivo Adjunto',
        'show_title' => 'Detalle de archivo Adjunto',
        'inputs' => [],
    ],

    'user_student_tasks' => [
        'name' => 'Usuario Tareas del Estudiante',
        'index_title' => 'Lista de Tareas del Estudiante',
        'new_title' => 'Nuevo/a tarea',
        'create_title' => 'Crear Tarea',
        'edit_title' => 'Editar Tarea',
        'show_title' => 'Detalle de Tarea',
        'inputs' => [
            'task_id' => 'Tarea',
            'name' => 'Nombre',
        ],
    ],

    'student_task_student_task_attaches' => [
        'name' => 'Archivos Adjuntos de Tareas del Estudiante',
        'index_title' => 'Archivos Adjuntos de Tareas del Estudiante',
        'new_title' => 'Nuevo/a Archivo Adjunto',
        'create_title' => 'Crear Archivo Adjunto',
        'edit_title' => 'Editar Archivo Adjunto',
        'show_title' => 'Detalle de Archivo Adjunto',
        'inputs' => [
            'attach_id' => 'Archivo',
        ],
    ],

    'user_enrollments' => [
        'name' => 'Cursos del estudiante',
        'index_title' => 'Cursos del estudiante',
        'new_title' => 'Nuevo/a Matrícula',
        'create_title' => 'Crear Matrícula',
        'edit_title' => 'Editar Matrícula',
        'show_title' => 'Detalle de Matrícula',
        'inputs' => [
            'course_id' => 'Curso',
            'name' => 'Nombre',
        ],
    ],

    'user_courses' => [
        'name' => 'Cursos a cargo del Profesor',
        'index_title' => 'Cursos a Cargo del Profesor',
        'new_title' => 'Nuevo/a Curso',
        'create_title' => 'Crear Curso',
        'edit_title' => 'Editar Curso',
        'show_title' => 'Detalle de Curso',
        'inputs' => [
            'period_id' => 'Período',
            'matter_id' => 'Materia',
            'name' => 'Nombre',
        ],
    ],

    'course_course_classes' => [
        'name' => 'Clases del Curso',
        'index_title' => 'Lista de Clases del Curso',
        'new_title' => 'Nuevo/a Clase',
        'create_title' => 'Crear Clase',
        'edit_title' => 'Editar Clase',
        'show_title' => 'Detalle de Clase',
        'inputs' => [
            'name' => 'Nombre',
            'description' => 'Descripción',
            'content' => 'Contenido',
        ],
    ],

    'course_class_course_class_tasks' => [
        'name' => 'Tareas de la Clase del Curso',
        'index_title' => 'Lista de Tareas de la clase',
        'new_title' => 'Nuevo/a Tarea',
        'create_title' => 'Crear Tarea',
        'edit_title' => 'Editar Tarea',
        'show_title' => 'Detalle de Tarea',
        'inputs' => [
            'name' => 'Nombre',
            'content' => 'Contenido',
            'file' => 'Archivo',
            'score' => 'Puntaje',
        ],
    ],

    'course_class_task_student_tasks' => [
        'name' => 'Tareas Entregadas',
        'index_title' => 'Lista de Tareas entregadas',
        'new_title' => 'Nuevo/a Tarea',
        'create_title' => 'Crear Tarea',
        'edit_title' => 'Editar Tarea',
        'show_title' => 'Detalle de Tarea',
        'inputs' => [
            'name' => 'Nombre',
            'student_id' => 'Estudiante',
        ],
    ],

    'student_task_student_task_attaches' => [
        'name' => 'Archivos Adjuntos a la Entrega de Tarea',
        'index_title' => 'Lista de Archivos Adjuntos a Tareas',
        'new_title' => 'Nuevo/a Archivo Adjunto',
        'create_title' => 'Crear Archivo Adjunto',
        'edit_title' => 'Editar Archivo Adjunto',
        'show_title' => 'Detalle de Archivo Adjunto',
        'inputs' => [
            'attach_id' => 'Archivo',
        ],
    ],

    'course_enrollments' => [
        'name' => 'Estudiantes del Curso',
        'index_title' => 'Lista de Estudiantes del Curso',
        'new_title' => 'Nuevo/a Estudiante',
        'create_title' => 'Crear Estudiante',
        'edit_title' => 'Editar Estudiante',
        'show_title' => 'Detalle de Estudiante',
        'inputs' => [
            'student_id' => 'Estudiante',
            'name' => 'Nombre',
        ],
    ],

    'enrollments' => [
        'name' => 'Estudiantes',
        'index_title' => 'Lista de Estudiantes',
        'new_title' => 'Nuevo/a Estudiante',
        'create_title' => 'Crear Estudiante',
        'edit_title' => 'Editar Estudiante',
        'show_title' => 'Detalle de Estudiante',
        'inputs' => [
            'name' => 'Nombre',
            'student_id' => 'Estudiante',
            'course_id' => 'Curso',
        ],
    ],

    'admission_admission_ataches' => [
        'name' => 'Archivos Adjuntos de Admisión',
        'index_title' => 'Archivos Adjuntos de Admisión',
        'new_title' => 'Nuevo/a Archivo Adjunto',
        'create_title' => 'Crear Archivo Adjunto',
        'edit_title' => 'Editar Archivo Adjunto',
        'show_title' => 'Detalle de Archivo Adjunto',
        'inputs' => [
            'file' => 'Archivo',
            'name' => 'Nombre',
            'description' => 'Descripción',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Lista de Roles',
        'create_title' => 'Crear Rol',
        'edit_title' => 'Editar Rol',
        'show_title' => 'Detalle de Rol',
        'inputs' => [
            'name' => 'Nombre',
        ],
    ],

    'permissions' => [
        'name' => 'Permisos',
        'index_title' => 'Lista de Permisos',
        'create_title' => 'Crear Permiso',
        'edit_title' => 'Editar Permiso',
        'show_title' => 'Detalle de Permiso',
        'inputs' => [
            'name' => 'Nombre',
        ],
    ],
];

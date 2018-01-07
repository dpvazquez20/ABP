<?php

// File with the phrases used in the app
$strings = array(
	
	// -------------- GENERAL --------------
	'ActiFit'	=>	'ActiFit',
    'Failure'	=>	'FALLO',
	'Here'	=>	'aquí',
	'If you have forgotten your username or password press'	=>	'Si ha olvidado su nombre de usuario o contrasenha pulse',
    'Info'	=>	'INFO',
    'Mandatory'	=>	'Los campos marcados con " * "  son obligatorios',
    'Ok'	=>	'REALIZADO',
	'Or create'	=>	'O cree',
    'success'	=>	'éxito',
	'Welcome'	=>	'Bienvenido',
	'log in'	=>	'Entrar',


	// -------------- FORMS --------------
	// These words are in lower case because in the BD are in the same way
	// User 
	'admin'	=> 'Administrador',
	'apellidos'	=> 'Apellidos',
    'coach'	=> 'Entrenador',
	'contrasenha'	=>	'Contraseña',
    'dni'	=>	'DNI',
	'email'	=>	'Email',
	'login'	=>	'Login',
	'nombre'	=>	'Nombre',
	'secretary'	=> 'Secretario',
    'sportsman'	=> 'Deportista',
	'tipo'	=>	'Tipo',

	// Table
	// It uses 'nombre' and 'borrado' (they already exist)
	// Table line
    'descanso'	=>	'Descanso',
	'duracion'	=>	'Duración',
    'repeticiones'	=>	'Repeticiones',
	'series'	=>	'Series',

	// Exercise
	// It also uses 'nombre' and 'tipo' that already exist
    'cardio'	=>	'Cardiovascular',
	'descripcion'	=> 'Descripción',
    'ejercicio' => 'Ejercicio',
	'imagen'	=>	'Imagen',
    'muscular'	=>	'Muscular',
	'stretching'	=>	'Estiramiento',
	
	// Activity
	// It also uses 'tipo' and 'descripcion'
	'frecuencia'	=> 'Frecuencia',
    'friday'	=> 'Viernes',
	'individual'	=> 'Individual',
	'group'		=> 'Grupal',
    'horaFin'	=> 'Hora de fin',
    'horaInicio'	=> 'Hora de inicio',
	'monday'	=> 'Lunes',
    'numMaxParticipantes' => 'Participantes',
    'thursday'	=> 'Jueves',
	'tuesday'	=> 'Martes',
	'wednesday'	=> 'Miércoles',
	'fechaInicio' =>'Fecha inicio',
	'fechaFin' => 'Fecha fin',
	'resource' => 'Recurso',
	'act_coach' => 'Entrenador',
	'ErrorMaxPart' => 'Número de participantes mayor que aforo',
    'ErrorIncorrectDay' => 'El día seleccionado no está dentro del rango de fechas',
    'ErrorResourceNotReady' => 'El recurso no está disponible',
	'ErrorReservationTime' => 'Hora de reserva ocupada',
	
	//Assistance
	'ErrorNoResults' => 'No hay inscripciones',
	
	// Resource
	'aforo' => 'Aforo',

    // Tracing
    'Complete'	=>	'Completado',
    'No complete'	=>	'No completado',
	
    //Inscriptions
	'registeredSportsmen'	=> 'Deportistas registrados',
    'registeredActivities'	=>	'Actividades inscritas',
    'nonRegisteredActivities'	=>	'Actividades no inscritas',
    'Consult inscription' =>	'Consultar inscripciones',
    'FullActivity' => 'Actividad completa, no se admiten más inscripciones',

    // -------------- PLACEHOLDERS --------------
	// User
	'Enter a dni'	=> 'Introduzca DNI (con letra)',
	'Enter a name'	=> 'Introduzca nombre',
	'Enter a password'	=> 'Introduzca contraseña',
	'Enter a type'	=> 'Seleccione tipo de usuario',
	'Enter an email'	=> 'Introduzca correo electrónico',
	'Enter an username'	=> 'Introduzca nombre de usuario',
	'Enter surnames'	=> 'Introduzca apellidos',
	'Repeat password'	=> 'Repita contrasenha',
	// Exercise
    'Enter a description' 	=>	'Introduzca descripción',
	// Activity
    'Enter end time'	=>	'Introduzca hora de fin',
    'Enter maximum number of participants'	=> 'Introduce el numero máximo de participantes',
    'Enter start time' => 'Introuzca hora de inicio',
	// Resource
	'Enter capacity' => 'Introduzca aforo',


	// -------------- BUTTONS --------------
	'Accept'	=>	'Aceptar',
    'Assign'	=>	'Asignar entrenamiento',
    'Add exercise'	=>	'Añadir ejercicio',
	'Cancel'	=>	'Cancelar',
	'End'	=>	'Terminar',
    'Enter'	=>	'Entrar',
	'Delete'	=>	'Eliminar',
	'Insert'	=>	'Insertar',
	'Modify'	=>	'Modificar',
    'New'	=>	'Añadir',
	'Next'	=>	'Siguiente',
	'Order'	=>	'Ordenar',
	'Previous'	=>	'Anterior',
	'Reset'	=>	'Restablecer',
    'Search'	=>	'Buscar',
    'See'	=>	'Ver',
	'Send'	=>	'Enviar',


	// -------------- NAVBAR --------------
	'Activity'	=>	'Actividades',
	'Assistance'	=>	'Asistencia',
    'Event'	=>	'Eventos',
	'Exercise'	=>	'Ejercicios',
	'Home'	=>	'Inicio',
	'Inscription'	=>	'Inscripciones',
	'Notification'	=>	'Notificaciones',
	'Profile'	=>	'Perfil',
	'Reservation'	=>	'Reservas',
	'Resource'	=>	'Recursos',
	'Statistics'	=>	'Estadísticas',
	'Table'	=>	'Tablas',
	'Tracing'	=>	'Seguimiento',
	'Training'	=>	'Entrenamientos',
	'User'	=>	'Usuarios',


	// -------------- ORDER BY --------------
    'Date ascending'	=>	'Fecha ascendente',
    'Date descending'	=>	'Fecha descendente',
    'Nothing selected'	=>	'Nada seleccionado',
	'Name A-Z'	=>	'Nombre A-Z',
	'Name Z-A'	=>	'Nombre Z-A',
	'Surnames A-Z'	=>	'Apellidos A-Z',
    'Surnames Z-A'	=>	'Apellidos Z-A',


    // -------------- PAGE'S NAMES --------------
	'Log In'	=>	'Inicio de sesión',
	'Home Page'	=>	'Página de inicio',
	'New activity'	=>	'Nueva actividad',
	'New exercise'	=>	'Nuevo ejercicio',
	'New reservation'	=>	'Nueva reserva',
	'New resource'	=>	'Nuevo recurso',
	'New table'	=>	'Nueva tabla',
	'New table line'	=>	'Nueva línea de tabla',
	'New training'	=>	'Nuevo entrenamiento',
	'New user'	=>	'Nuevo usuario',
	'Consult activity'	=>	'Detalle de actividad',
	'Consult exercise'	=>	'Detalle de ejercicio',
	'Consult reservation'	=>	'Detalle de reserva',
	'Consult resource'	=>	'Detalle de recurso',
	'Consult table'	=>	'Detalle de tabla',
	'Consult table line'	=>	'Detalle de línea de tabla',
	'Consult training'	=>	'Detalle de entrenamiento',
	'Consult user'	=>	'Detalle de usuario',
	'Modify activity'	=>	'Modificar actividad',
	'Modify exercise'	=>	'Modificar ejercicio',
	'Modify reservation'	=>	'Modificar reserva',
	'Modify resource'	=>	'Modificar recurso',
	'Modify table'	=>	'Modificar tabla',
	'Modify table line'	=>	'Modificar línea de tabla',
	'Modify training'	=>	'Modificar entrenamiento',
	'Modify user'	=>	'Modificar usuario',


	// -------------- ERRORS --------------
	// connectDB.php
    'MySQLError'	=>	'Fallo al conectar a MySQL',

	//Models
    'ConnectionDBError'	=>	'Error al conectar a la base de datos',
    'ConsultErrorForm' =>	'No se pudo realizar la consulta',
    'DeleteError' =>	'Error en la eliminación',
    'DeleteErrorForm'	=>	'No se pudo borrar el elemento',
    'DeleteSuccess'	=>	'Elemento eliminado con éxito',
    'ErrorNotExist'	=> 'El elemento no existe',
    'IncorrectPassword'	=>	'La contaseña es incorrecta',
    'InsertError'	=>	'Error en la inserción',
    'InsertErrorForm' =>	'No se pudo insertar el elemento',
    'InsertErrorRepeat'	=>	'Elemento repetido',
    'InsertSuccess' => 'Elemento añadido con éxito',
    'ListErrorNotExist'	=>	'No existen elementos',
    'SearchErrorNotExist'	=>	'No se han encontrado elementos',
    'UpdateError'	=>	'Error en la modificación',
    'UpdateErrorForm'	=>	'No se pudo modificar el elemento',
    'UpdateNoModify'	=>	'No se han producido modificaciones',
    'UpdateSuccess'	=>	'Elemento modificado con éxito',
	'UserNotExist'	=>	'El usuario no existe',

	// ------------------------- SERGIO -------------------------------

	'Follow' => 'Seguir',
	'FollowErrorForm' => 'Error al intentar seguimiento',
	'completado' => 'Completado',
	'comentario' => 'Comentario',
	'completeLine' => 'completarLinea',
	'Name' => 'Nombre',
	'State' => 'Estado',
	'Complete2' => 'Completada',
	'No complete2'	=>	'No completada',
	'completeTable' => 'completarTabla',
	'toComplete' => 'Completar',
	'previousTable' => 'tablaAnterior',
	'nextTable' => 'tablaSiguiente',
	'previous' => 'Anterior',
	'next' => 'Siguiente',
	'NoTrainingError' => 'No hay ningún entrenamiento asignado',
	'clase' => 'Clase',
	'other' => 'Otro',
	'pef' => 'PEF',
	'tdu' => 'TDU',
	'normal' => 'Normal',
	'personal' => 'Personal',
	'startTime' => 'Empezar',
	'comment' => 'Comentario',
	'writeComments' => 'Escriba aquí sus comentarios',
	'List' => 'Listar',
	'SeeSession' => 'VerSesion',
	'Consult' => 'Consultar',
	'fecha' => 'Fecha',
	'inicio' => 'Inicio',
	'fin' => 'Fin',
	'enlace' => 'Enlace',
	'Back' => 'Volver',
	'TracingErrorNotStarted' => 'El usuario no ha comenzado el plan de entrenamiento',
	
	'notify' => 'Notificar',
	'Notification' => 'Notificacion',
	'Subject' => 'Asunto',
	'destination' => 'Destino',
	'Addressees' => 'Destinatarios',
	'sportsmans' => 'Deportistas',
	'coachs' => 'Entrenadores',
	'secretarys' => 'Secretarios',
	'admins' => 'Administradores',
	'Message' => 'Mensaje',
	'NotificationError' => 'Error. No se ha podido enviar la notificación',
	'NotificationOk' => 'Notificación enviada',

	// ----------------------------------------------------------------
	
	// ------------------------- ALEX -------------------------------
	
	'sesiones' => 'Sesiones',
	'sesion' => 'Sesion',
	'tabla' => 'Tabla',
	'orden_sesion' => 'Orden Sesion',
	'DeleteTable'	=>	'EliminarTabla',
	'Enter number of sesions' => 'Introduzca el numero de sesiones',
	'InsertTables' => 'InsertarTablas',
	'InsertAnother' => 'InsertarOtra',
	'AssignTraining' => 'Agisnar Entrenamiento',
	'Enter date' => 'Introduzca una fecha',
	'New event' => 'Nuevo evento',
	'fecha' => 'Fecha',
	'Most recent first' => 'Más recientes primero',
	'Oldest first' => 'Más antiguos primero',
	'Consult event' => 'Consultar evento',
	'Modify event' => 'Modificar evento',
	'Show events' => 'Mostrar eventos',
	'Add' => 'Anadir',
	'Add table'	=>	'Añadir tabla',
	'Modify training' => 'Modificar entrenamiento',
	'InsertSuccessMax' => 'Entrenamiento añadido con éxito',
	'NoAssingError' => 'No se le puede asignar entrenamiento a este usuario',
	
	// ----------------------------------------------------------------

    // ------------------------- STATISTICS -------------------------------

	'days'	=>	'Actividades por día',
    'activitiesUsers'	=> 'Nº de usuarios por actividad',
    'amountUsers'	=> 'Deportistas totales: ',
    'TDUUsers'	=>	'Deportistas TDU',
    'PEFUsers'	=>	'Deportistas PEF',
    'numExercises'	=> 'Nº de ejercicios: ',
    'numMuscular'	=>	'Musculares',
    'numCardio'	=>	'Cardiovasculares',
    'numStretching'	=>	'Estiramientos',
    'mostUsedExercise' => 'Ejercicio más usado',
    'menWomen'	=>	'Porcentaje hombres-mujeres',
    'men'	=>	'Hombres',
    'women'	=>	'Mujeres',
    'Statistics user' => 'Estadísticas del usuario',
    'showSportsmen'	=>	'Ver deportistas',
    'hideSportsmen'	=>	'Ocultar deportistas',

    // ----------------------------------------------------------------
	

);
?>

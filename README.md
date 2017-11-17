# IMPORTANTE  
   - Si tenéis que hacer un cambio permanente en la BD, exportarla de manera PERSONALIZADA siguiendo las imágenes de la carpeta     "phpmyadmin"
   - Si tenéis que hacer un cambio en vuestras vistas, o para hacer las vistas que os queden, utilizad como base las que están subidas aquí (les cambié cosas)
   - EL DOMINGO/LUNES CAMBIARLE EL NOMBRE A LA CARPETA POR G13_VersionPreliminar ANTES DE SUBIRLA , UNA VEZ ESTÉ ESO CAMBIADO, HAY QUE CAMBIAR ESE NOMBRE TAMBIÉN EN EL FICHERO
	 "install.sh" (YA HAY LINEAS COMENTADAS)
   - EL DOMINGO/LUNES BORRAR LA CARPETA ".idea" ANTES DE SUBIRLA (esta carpeta la crea PhpStorm así que no debería de pasar nada)
   
    
# NOTAS
  - Para importar la BD borrad primero la que teneis que borrar si no peta por las restricciones de las claves foráneas
  - He cambiado los siguientes nombres de funciones (las que están en los papeles que os di):
      - generateList2() ahora es generateListGroup()
      - generateView2() ahora es generateViewTracingSportsman()
      - generateView3() ahora es generateViewTracingCoach()

  - Las funciones generateList() y generateView() ya tienen en cuenta no imprimir el botón de borrar para los entrenamientos
  - Borré bastantes comentarios y cosas asi, salvo de vuestros archivos, que no los borré por si acaso
  - He puesto las series y descansos de las lineas de tablas como null (para más flexibilidad) y he cambiado las repeticiones a varchar45 (para que se pueda poner algo como 12x10x8x6) 
  - Cambié la gestión de usuarios para que acepte imágenes y creé una funcion generateListCoach() que te genera la lista de usuarios para asignar entrenamientos (ahora el entrenador tiene acceso a usuarios pero solo para verlos), falta que el que tenga entrenamientos implemente la asignación
  - Añadí los perfiles (se lo añadí a todos para más comodidad), es el icono al lado del icono de apagar (logout)
  - Cambié mas cosas pero ya no me acuerdo, creo que está todo salvo lo vuestro y la paginación (en principio se la quité por si no me da tiempo) y si queréis cambiar algo hacedlo
	pero con cuidado de no cargaros nada


INSERT IGNORE INTO `usuarios` (`id`, `login`, `contrasenha`, `nombre`, `apellidos`, `sexo`, `dni`, `email`, `borrado`, `tipo`, `clase`, `entrenador_id`, `entrenador_nombre`, `imagen`) VALUES
(1, 'hefesto', '$2y$15$4ob92z/EbNmLB1fGv8bR9eALEJNAgifgIBIiVVeAtLzCzuSduWJbq', 'Miguel', 'Cid Celard', 'Hombre', '45142391S', 'hefesto@gmail.com', 0, 'Administrador', 'Otro', NULL, NULL, 'default.png'),
(2, 'atenea', '$2y$15$rlKJmG3gxQfv3gc3qUQoxun1po32QekHWx3QBLX3JgZktS/xG9arm', 'Laura', 'Prada Montero', 'Mujer', '51616775Z', 'atenea@gmail.com', 0, 'Secretario', 'Otro', NULL, NULL, 'default.png'),
(3, 'hermes', '$2y$15$1zMNK5QMdBwrzpS4dsw0A.mfBPxhq1wDkFD8kKqNESWIblVAva.RG', 'Juan', 'Alonso Veiga', 'Hombre', '51896676M', 'hermes@gmail.com', 0, 'Entrenador', 'Otro', NULL, NULL, 'default.png'),
(4, 'artemisa', '$2y$15$dMmie3lGjIljlwR35c1esuAqq3YHqnGhZUjHQnCcQXEtz2/HAzih2', 'Manuela', 'Iglesias Portela', 'Mujer', '76479663V', 'artemisa@gmail.com', 0, 'Entrenador', 'Otro', NULL, NULL, 'default.png'),
(5, 'minerva', '$2y$15$3NLat9yiSmd22KO3u3Oznu9RazgcAglngSMuliUHAI.KKM.TxUqbC', 'Laura', 'Alonso Barreda', 'Mujer', '26387753Z', 'minerva@gmail.com', 0, 'Deportista', 'TDU', 3, 'Alonso Veiga, Juan', 'default.png'),
(6, 'scathach', '$2y$15$XXNp4j8hyVhbAkBtgQZ7COKlS7E/fVHcKoXtO0OZbv7dA3A2HUTza', 'Paula', 'Camacho Villa', 'Mujer', '71790079H', 'scathach@gmail.com', 0, 'Deportista', 'PEF', 4, 'Iglesias Portela, Manuela', 'default.png'),
(7, 'cuchulain', '$2y$15$TKY64EEn2xjaBLo2CV7KUOAr3C.fb0PRC.n2tLm3l.Xo5sfM.j7Rq', 'Bruno', 'Burgos Cos', 'Hombre', '86380475L', 'cuchulain@gmail.com', 0, 'Deportista', 'TDU', 3, 'Alonso Veiga, Juan', 'default.png'),
(8, 'isis', '$2y$15$ZXiZV9jEeeiMYAMEr/Ec0eItIEXqBdNrIRbZ3pJwT7GbfAKJuoHFS', 'Mercedes', 'Dacal Cabral', 'Mujer', '26240766C', 'isis@gmail.com', 0, 'Deportista', 'PEF', 3, 'Alonso Veiga, Juan', 'default.png'),
(9, 'seth', '$2y$15$8.uYTXIMfaz2eKXsnI6ZTeXMPv1n4amjnwLD8qR4SY4FrM1UcIWwC', 'Duarte', 'Castilla Duenas', 'Hombre', '51550026B', 'seth@gmail.com', 0, 'Deportista', 'TDU', 4, 'Iglesias Portela, Manuela', 'default.png'),
(10, 'thoth', '$2y$15$yA22oP/ojBkbtehxM95qCe9QcYpQ2jUPI3/rqefJZuMTUT1yTI72i', 'Enrique', 'Pastor Gil', 'Hombre', '53505054Q', 'thoth@gmail.com', 0, 'Deportista', 'TDU', 3, 'Alonso Veiga, Juan', 'default.png'),
(11, 'ganesha', '$2y$15$OX7QslZrZ1lJHZQod2cNXOrx.72KbxuJ.wzWw9LVNgPimTU38Af6.', 'Firmanda', 'Flyers', 'Otro', '25818341J', 'ganesha@gmail.com', 0, 'Deportista', 'TDU', 4, 'Iglesias Portela, Manuela', 'default.png'),
(12, 'kali', '$2y$15$01biauCJGy6Ph4TC.LW9hOmncATjFkYfeSJKqqYgYh0NwagtvsReK', 'Carlota', 'Fuentes Gracia', 'Mujer', '64313207D', 'kali@gmail.com', 0, 'Deportista', 'PEF', 3, 'Alonso Veiga, Juan', 'default.png'),
(13, 'mitra', '$2y$15$GtCUvVmBiJjF88jXH/MNWuvKYPmbOjT/VTpo8jdP.z4rkAISY9V..', 'Lorena', 'Morales Ocana', 'Mujer', '57487213R', 'mitra@gmail.com', 0, 'Deportista', 'PEF', 4, 'Iglesias Portela, Manuela', 'default.png'),
(14, 'sif', '$2y$15$sPCHr/dQ1tHAtNo8PJlvzuNwPci1oOGN62Ofkt8AGXKb6.BNElsuC', 'Travela', 'Vargas', 'Otro', '85723180H', 'sif@gmail.com', 0, 'Deportista', 'TDU', 4, 'Iglesias Portela, Manuela', 'default.png');




INSERT IGNORE INTO `ejercicios` (`id`, `nombre`, `descripcion`, `imagen`, `tipo`, `borrado`) VALUES
(1, 'Cinta', 'Correr en la cinta', 'cinta.jpg', 'Cardiovascular', 0),
(2, 'Press banca', 'Ejercicio de pecho en banco horizontal', 'pressbanca.png', 'Muscular', 0),
(3, 'Press inclinado', 'Ejercicio de pecho en banco inclinado', 'pressbancainclinado.jpg', 'Muscular', 0),
(4, 'Press levantado', 'Ejercicio de pecho de piÃ© en mÃ¡quina', 'presslevantado.jpg', 'Muscular', 0),
(5, 'Patada frontal en equilibrio', 'De pie, lanzamos la pierna adelante', 'patadafrontal.jpg', 'Cardiovascular', 0),
(6, 'Curl de bÃ­ceps de pie', 'Ejercicio de bÃ­ceps de pie con levantamiento alterno', 'curlalterno.png', 'Muscular', 0),
(7, 'Curl de bÃ­ceps sentado martillo', 'Ejercicio de bÃ­ceps sentado con agarre de tipo martillo', 'curlsentadomartillo.jpg', 'Muscular', 0),
(8, 'Curl de bÃ­ceps martillo', 'Ejercicio de bÃ­ceps sentado en banco inclinado', 'curlinclinado.jpg', 'Muscular', 0),
(9, 'Plancha y flexiÃ³n de piernas', 'Desde la posiciÃ³n de plancha, apoyando con las palmas de las manos, y las puntas de los pies, realizamos un salto y acercamos las rodillas al pecho', 'flexionplancha.png', 'Muscular', 0),
(10, 'Plancha sobre pelota de pilates', 'Nos acostamos boca abajo sobre la pelota de pilates, apoyando la zona abdominal y hasta mitad de los muslos, los brazos colgando a los lados. Realizamos una extensiÃ³n de tronco subiendo la parte superior del cuerpo hasta formar una linea recta', 'planchapelota.jpg', 'Muscular', 0),
(11, 'Estiramientos pectorales', 'Estiramientos varios de la zona pectoral', 'estiramientospectorales.jpg', 'Estiramiento', 0),
(12, 'Remo en mÃ¡quina', 'Un interesante ejercicio para trabajar cardio tanto de miembro inferior como superior. -Debemos ajustar adecuadamente el talÃ³n al pedal y ajustaremos adecuadamente las correas. Debemos realizar el ejercicio con el calzado adecuado, nunca descalzo. -Si te inicias en este ejercicio empieza con una resistencia baja, y poco a poco ves aumentando la intensidad de la resistencia. -La espalda permanecerÃ¡ recta durante el ejercicio, solo debemos flexionar brazos y piernas. -Los codos deben estar cerca del cuerpo, no deben acercarse a los hombros, y no abril demasiado las axilas, de esta forma centraremos el trabajo en el hombro y dorsal. -Tiraremos de la polea hasta acercar los pulgares a tus abdominales. -No balancees el cuerpo hacia atrÃ¡s para aplicar mÃ¡s fuerza. -No extiendas totalmente las piernas, las hiperxtensiones repetidas pueden resentir tu rodilla. -realices este ejercicio si tu columna sufre algÃºn tipo de afecciÃ³n o te notas la zona de la espalda contracturada', 'remomaquina.jpg', 'Cardiovascular', 0),
(13, 'Dominadas excÃ©ntricas', 'Inicia el movimiento colgÃ¡ndote a la barra de dominadas, puedes variar la separaciÃ³n entre cada mano, y el agarre puede ser pronado (o sea que las palmas de tus manos se dirijan hacia ti) o supinado (que las palmas vean hacia afuera), de esta forma proporcionas estÃ­mulos diferentes a los mÃºsculos de la espalda. Extiende los brazos por completo y relaja los hombros para que los dorsales queden totalmente estirados. Inspira profundamente y aguanta la respiraciÃ³n mientras contraes los dorsales para elevarte hacia arriba lentamente. Sube hasta que la barbilla llegue a la altura de la barra. En inglÃ©s: Pull-ups MantÃ©n los codos a los lados y hacia fuera. Expulsa el aire y baja a la posiciÃ³n inicial. El descenso es controlado, evitando dejar caer el cuerpo y frenando el movimiento para trabajar la fase negativa o excÃ©ntrica. Al subir no subas la piernas para ayudarte', 'dominadasexcentricas.png', 'Muscular', 0),
(14, 'JalÃ³n en polea alta', 'Sentado frente al aparato de poleas y con las piernas fijadas, cogemos la barra en pronaciÃ³n (manos hacia abajo) bastante separadas y tiramos de la barra hasta nuestro pecho, ensanchando el mismo y llevando los codos hacia atrÃ¡s. Sirve para desarrollar la espalda en grosor. Trabaja principalmente las fibras superiores y centrales del dorsal ancho. Otra modalidad de este ejercicio es usando, en vez de una barra, los estribos y al llegar al pecho separarlos un poco', 'jalonpolea.png', 'Muscular', 0),
(15, 'Remo con polea', 'Sentados con las piernas con una ligera flexiÃ³n que nos permita mantener la espalda recta, debemos sacar el pecho, y la zona lumbar mantenerla lo mÃ¡s recta posible durante todo el ejercicio, solo deben moverse los brazos, con un agarre neutro realizamos un tirÃ³n hasta llevas los agarres a nuestro ombligo, lentamente volvemos a la posiciÃ³n inicial.Ejercicio ideal para desarrollar la espalda baja', 'remopolea.jpg', 'Muscular', 0),
(16, 'Remo con mancuernas', 'Apoyamos una rodilla y una mano en el banco plano, cogemos la mancuerna con el otro brazo y la subimos verticalmente hasta la altura del pecho.Para endurecer el ejercicio podemos detenernos un instante en la parte alta del ejercicio.', 'remomancuernas.jpg', 'Estirammiento', 0),
(17, 'FlexiÃ³n de brazos sobre banco', 'Boca abajo con uno de los brazos en la espalda, la otra mano se apoya sobre un banco plano, los pies debemos separarlos para afirmar la base de sustentaciÃ³n, inspirar y flexionar el brazo para llevar el pecho cerca del banco, siempre evitando curvar la regiÃ³n lumbar', 'flexionbanco.jpg', 'Muscular', 0),
(18, 'ExtensiÃ³n de trÃ­ceps sentado', 'Sentado en banco, contraemos la zona abdominal para pegar bien la zona lumbar al banco. Nos ayudamos de la otra mano para mantener en vertical el brazo que realiza el movimiento. En esa posiciÃ³n realizamos una extensiÃ³n del brazo', 'extricepssentado.jpg', 'Muscular', 0),
(19, 'ExtensiÃ³n de trÃ­ceps de pie', 'Nos colocamos de pie, de manera estable frente a la polea, agarramos la polea y extendemos hacia abajo', 'extricepsdepie.png', 'Muscular', 0),
(20, 'Plancha y extensiÃ³n de trÃ­ceps', 'Desde la posiciÃ³n de plancha con las palmas de las manos apoyadas y juntas, realizamos una extensiÃ³n de trÃ­ceps', 'planchatriceps.png', 'Muscular', 0),
(21, 'Media sentadilla con pelota de pilates', 'De pie con la pelota entre la espalda y la pared. Los pies separados a la anchura de los hombros, las puntas de los pies ligeramente abiertos, en esa posiciÃ³n estable realizamos una flexiÃ³n de rodillas hasta llegar a los 90Âº , y de manera equilibrada volvemos a la posiciÃ³n inicial. Durante todo el movimiento realizaremos una presiÃ³n hacia la pelota, la cabeza permanecerÃ¡ erguida y la mirada alta', 'mediasentadillapilates.jpg', 'Muscular', 0),
(22, 'Estiramientos dorsales', 'Estiramientos varios de la zona dorsal', 'gato.png', 'Estiramiento', 0),
(23, 'Bicicleta', 'Bicicleta estÃ¡tica', 'bici.jpg', 'Cardiovascular', 0),
(24, 'Prensa inclinada', 'Apoyamos la espalda contra el respaldo , quitaremos el seguro que soporta el peso . Inspiraremos y realizaremos una flexión de rodillas haciendo descender la plataforma hasta formar una ángulo de 90 grados con las rodillas.Debemos tener en cuenta que los glúteos no deben despegarse del asiento cuando realizamos la flexión de rodilla (el peso este en la parte más baja del recorrido) esto nos evitará lesiones. Ahora empujaremos la plataforma hacia arriba hasta la posición inicial. CONSEJOS Y ERRORES MÁS COMUNES Debemos bajar la plataforma de manera lenta y controlada. Para evitar lesiones de rodilla, la extensión de las rodillas no debe ser total puesto que de ser así la fuerza peso caería sobre la línea vertical de los huesos de la pierna y muslo perdiendo tensión el cuadriceps que es músculo principal involucrado. Para evitar lesiones de espalda, no bajes las rodillas demasiado cerca del pecho. Cuanto más se desciende, mayor probabilidad hay de redondear la espalda baja, lo que favorece las lesiones', 'prensainclinada.png', 'Muscular', 0),
(25, 'AbducciÃ³n de cadera', 'AbducciÃ³n de cadera sentado en mÃ¡quina', 'abduccioncadera.jpg', 'Muscular', 0),
(26, 'Sentadilla en mÃ¡quina', 'Coloca la barra a una altura justo debajo de la altura de tus hombros.Coloca la barra en la parte trasera de los hombros. Agarra la barra usando tus manos a los lados y levÃ¡ntala del rack utilizando la fuerza de tus piernas y enderezando el torso. Abre tus pies a lo ancho de tus hombros con los dedos de los pies ligeramente hacia afuera. No bajes la cabeza o dobles la espalda durante el ejercicio. Realiza lentamente una flexiÃ³n de piernas manteniendo en todo momento la posiciÃ³n erguida.. ContinÃºa hasta que el Ã¡ngulo que se forma entre tus muslos y las pantorrillas sea un poco menos de 90 grados, inspira al bajar. Comienza a levantar la barra mientras expiras', 'sentadillamaquina.jpg', 'Muscular', 0),
(27, 'Press de hombros sentado', 'SiÃ©ntate en un banco con la espalda apoyada contra el respaldo, manteniendo los pies apoyados sobre el suelo y los abdominales tensos. Coge un par de mancuernas de manera que queden ligeramente al frente de los hombros. Utiliza un agarre prono (palmas al frente). Las manos alineadas y separadas a una distancia mayor que la anchura de los hombros (los codos deben apuntar hacia los lados y hacia abajo). MantÃ©n los hombros echados hacia atrÃ¡s, el pecho hacia fuera y la columna con su curvatura natural. Inspira y aguanta la respiraciÃ³n mientras subes el peso directamente sobre la cabeza haciendo un arco. Expulsa el aire tras pasar el punto mÃ¡s difÃ­cil de la fase de subida, detente un momento con los brazos extendidos, baja el peso de forma controlada. Los pesos deben casi tocarse en la posiciÃ³n sobre la cabeza', 'presshombro.png', 'Muscular', 0),
(28, 'ElevaciÃ³n frontal sentado', 'Coger las mancuernas con las palmas hacia abajo (agarre prono); con los brazos a los lados de los muslos y sentado en un banco plano con la zona lumbar bien pegada al respaldo del banco, con los pies separados a la altura de los hombros. Toma aire y aguantando la respiraciÃ³n levanta las mancuernas directamente delante del cuerpo con los brazos rectos pero sin bloquear los codos. Debes elevar las mancuernas hasta la altura de los hombros. Expulsa el aire mientras bajas las mancuernas de forma controlada a la posiciÃ³n inicial.Podemos endurecer el ejercicio si nos detenemos un instante en la parte mÃ¡s alta del ejercicio', 'elevacionsentado.png', 'Muscular', 0),
(29, 'Pullover con disco', 'Acostado en un banco plano, los pies sobre el banco para ayudarnos a evitar la curvatura lumbar, un disco cogido con las dos manos y apoyado sobre todo en las palmas, brazos extendidos, inspirar y bajar el disco por detrÃ¡s de la cabeza flexionando ligeramente los codos y espirar mientras se vuelve a la posiciÃ³n de partida', 'pulloverdisco.jpg', 'Muscular', 0),
(30, 'Estiramientos piernas', 'Estiramientos varios de la parte inferior', 'estiramientospiernas.jpg', 'Estiramiento', 0),
(31, 'Estiramientos brazos', 'Estiramientos varios de los brazos', 'estiramientosbrazos.jpg', 'Estiramiento', 0),
(32, 'Estiramientos varios', 'Estiramientos varios de todo el cuerpo', 'default.png', 'Estiramiento', 0);





INSERT IGNORE INTO `tablas` (`id`, `nombre`, `tipo`, `borrado`) VALUES
(1, 'Pectorales y bÃ­ceps', 'Normal', 0),
(2, 'Espalda y trÃ­ceps', 'Normal', 0),
(3, 'Piernas y hombros', 'Normal', 0),
(4, 'BÃ­ceps y trÃ­ceps', 'Normal', 0),
(5, 'Variada', 'Personal', 0);





INSERT IGNORE INTO `lineasdetabla` (`id`, `repeticiones`, `duracion`, `descanso`, `series`, `tabla_id`, `ejercicio_id`) VALUES
(1, NULL, '10 min', '1 min', NULL, 1, 1),
(2, '12-10-8-6', NULL, '90 seg', 4, 1, 2),
(3, '10', NULL, '1 min', 4, 1, 3),
(4, '8', NULL, '1 min', 3, 1, 4),
(5, '15', NULL, '30 seg', 4, 1, 5),
(6, '8 c/l', NULL, '1 min', 3, 1, 6),
(7, '8 c/l', NULL, '1 min', 3, 1, 7),
(8, '8', NULL, '1 min', 3, 1, 8),
(9, NULL, '30 seg', '30 seg', 4, 1, 9),
(10, NULL, '30 seg', '30 seg', 4, 1, 10),
(11, NULL, '15 min', NULL, NULL, 1, 1),
(12, NULL, '10 min', NULL, NULL, 1, 11),
(13, NULL, '10 min', '1 min', NULL, 2, 12),
(14, '10', NULL, '90 seg', 4, 2, 13),
(15, '12-10-8-6', NULL, '90 seg', 4, 2, 14),
(16, '10', NULL, '1 min', 3, 2, 15),
(17, '8', NULL, '1 min', 4, 2, 16),
(18, '10', NULL, '1 min', 3, 2, 17),
(19, '8 c/l', NULL, '1 min', 4, 2, 18),
(20, '8', NULL, '1 min', 3, 2, 19),
(21, NULL, '30 seg', '30 seg', 4, 2, 10),
(22, NULL, '30 seg', '30 seg', 4, 2, 20),
(23, '20', NULL, '30 seg', 4, 2, 21),
(24, NULL, '15 min', NULL, NULL, 2, 12),
(25, NULL, '10 min', NULL, NULL, 2, 22),
(26, NULL, '10 min', '1 min', NULL, 3, 23),
(27, '10', NULL, '90 seg', 4, 3, 13),
(28, '12-10-8-6', NULL, '90 seg', 4, 3, 24),
(29, '10', NULL, '1 min', 3, 3, 25),
(30, '8', NULL, '1 min', 4, 3, 26),
(31, '10', NULL, '1 min', 3, 3, 27),
(32, '8 c/l', NULL, '1 min', 4, 3, 28),
(33, '8', NULL, '1 min', 3, 3, 29),
(34, NULL, '30 seg', '30 seg', 4, 3, 10),
(35, NULL, '30 seg', '30 seg', 4, 3, 20),
(36, '20', NULL, '30 seg', 4, 3, 21),
(37, NULL, '15 min', NULL, NULL, 3, 1),
(38, NULL, '10 min', NULL, NULL, 3, 30),
(39, NULL, '10 min', '1 min', NULL, 4, 1),
(40, '10', NULL, '90 seg', 4, 4, 13),
(41, '12-10-8-6', NULL, '90 seg', 4, 4, 28),
(42, '8 c/l', NULL, '1 min', 3, 4, 6),
(43, '8 c/l', NULL, '1 min', 3, 4, 7),
(44, '8', NULL, '1 min', 3, 4, 8),
(45, '10', NULL, '1 min', 3, 4, 17),
(46, '8 c/l', NULL, '1 min', 4, 4, 18),
(47, '8', NULL, '1 min', 3, 4, 19),
(48, '15', NULL, '30 seg', 4, 4, 5),
(49, NULL, '30 seg', '30 seg', 4, 4, 10),
(50, NULL, '15 min', NULL, NULL, 4, 12),
(51, NULL, '10 min', NULL, NULL, 4, 31),
(52, NULL, '10 min', '1 min', NULL, 5, 1),
(53, '12-10-8-6', NULL, '90 seg', 4, 5, 2),
(54, '8 c/l', NULL, '1 min', 3, 5, 6),
(55, '12-10-8-6', NULL, '90 seg', 4, 5, 14),
(56, '10', NULL, '1 min', 3, 5, 17),
(57, '8 c/l', NULL, '1 min', 4, 5, 28),
(58, '15', NULL, '30 seg', 4, 5, 5),
(59, NULL, '30 seg', '30 seg', 4, 5, 9),
(60, NULL, '30 seg', '30 seg', 4, 5, 10),
(61, NULL, '30 seg', '30 seg', 4, 5, 20),
(62, NULL, '15 min', NULL, NULL, 5, 1),
(63, NULL, '10 min', NULL, NULL, 5, 31);





INSERT IGNORE INTO `entrenamientos` (`id`, `nombre`, `tipo`, `borrado`, `sesiones`) VALUES
(1, 'TDU: Principiante', 'Normal', 0, 2),
(2, 'TDU: Medio', 'Normal', 0, 3),
(3, 'TDU: Avanzado', 'Normal', 0, 4),
(4, 'PEF: BÃ¡sico', 'Personal', 0, 1);





INSERT IGNORE INTO `entrenamientos_has_tablas` (`entrenamiento_id`, `tabla_id`, `orden_sesion`) VALUES
(1, 1, 1),
(1, 2, 2),
(2, 1, 1),
(2, 2, 2),
(2, 3, 3),
(3, 1, 1),
(3, 2, 2),
(3, 3, 3),
(3, 4, 4),
(4, 1, 1);




INSERT IGNORE INTO `entrenamientos_has_usuarios` (`entrenamiento_id`, `usuario_id`) VALUES
(1, 5),
(4, 6),
(2, 7),
(4, 8),
(3, 9),
(2, 10),
(1, 11),
(4, 12),
(3, 13),
(2, 14);





INSERT IGNORE INTO `eventos` (`id`, `nombre`, `descripcion`, `imagen`, `fechaInicio`, `fechaFin`, `horaInicio`, `horaFin`, `borrado`) VALUES
(1, 'Zumba', 'TendrÃ¡ lugar una clase de demostraciÃ³n de Zumba para todas las edades. Los niÃ±os deberÃ¡n ir acompaÃ±ados de un adulto o llevar una autorizaciÃ³n. Aquellos que se inscriban en actividades de Zumba del gimnasio tras esta clase tendrÃ¡n un descuento del 30% los 3 primeros meses.', 'zumba.jpg', '2018-01-26', '2018-01-27', '00:00:00', '00:00:00', 0),
(2, 'InauguraciÃ³n', 'Evento inaugural del gimnasio donde se harÃ¡ una presentaciÃ³n de sus instalaciones asÃ­ como de la aplicaciÃ³n de la que hace uso. Se harÃ¡ un recorrido por el gimnasio mostrando las distintas salas y maquinas ademas de contar con la participaciÃ³n de entrenadores especializados. HabrÃ¡ churrasco.', 'inauguracion.jpg', '2018-01-22', '2018-01-23', '00:00:00', '00:00:00', 0),
(3, 'Torneo FÃºtbol 7', 'Se organizara un pequeÃ±o torneo de FÃºtbol 7 de hasta 16 equipos. Los interesados en apuntarse deberÃ¡n acudir al gimnasio durante la semana previa al torneo para inscribirse. No hay lÃ­mite de edad pero los menores de 16 aÃ±os deberÃ¡n presentar una autorizaciÃ³n firmada de sus padres o tutores legales.', 'futbol7.jpg', '2018-01-29', '2018-01-31', '00:00:00', '00:00:00', 0),
(4, 'Carrera popular', 'Media maratÃ³n. Los interesados en apuntarse deberan acudir al gimnasio durante la semana previa a la carrera para inscribirse. No hay lÃ­mite de edad pero los menores de 16 aÃ±os deberan presentar una autorizacion firmada de sus padres o tutores legales.', 'carrera.png', '2018-02-27', '2018-02-27', '10:00:00', '13:00:00', 0);



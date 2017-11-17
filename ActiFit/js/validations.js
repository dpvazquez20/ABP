// File with the form field's validations

/*Funcion que comprueba que el formato y la letra del DNI son validos*/
function validarDni(campo){
  var valor = campo.value; //Variable valor donde se almacenar el valor del campo que vamos a comprobar
  //Variable que contiene un array de letras para calcular la letra del dni
  var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
  
  if( !(/^\d{8}[a-zA-Z]$/.test(valor)) ) { //Se comprueba si se cumple o no el formato de de DNI (8 NUMEROS) mediante la expresion formal
    return false;
  }
 
  if(valor.charAt(8).toUpperCase() != letras[(valor.substring(0, 8))%23]) { //Se comprueba si la letra es correcta haciendo uso del array letras
    alert('DNI Incorrecto');
	return false;
  }else{
    return true;
  }
}

/*Funcion que comprueba si el formato del email es correcto*/
function validarEmail(campo){
  var valor = campo.value; //Variable valor donde se almacenar el valor del campo que vamos a comprobar
  /*Expresion regular para comprobar el email*/
  if( !(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)) ) {
    alert('Direccion incorrecta');
    campo.focus();
    return false;
  }else{
    return true;
  }
}

// Comprueba si la confirmacion de la password coincide con la password original
function validarPassword() {
  if (document.getElementById('contrasenha').value == document.getElementById('rcontrasenha').value) {
    document.getElementById('rcontrasenha').style.borderColor = 'green';
	document.getElementById('contrasenha').style.borderColor = 'green';
	return true;
  } else {
    document.getElementById('rcontrasenha').style.borderColor = 'red';
	document.getElementById('contrasenha').style.borderColor = 'red';
	alert('Las contraseñas no coinciden');
	return false;
  }
}

// Comprueba si lo que se ha introducido en el campo esta compuesto solo por letras
function validarAlfabetico(campo){
  var valor = campo.value; //Variable valor donde se almacenar el valor del campo que vamos a comprobar
  if (!/^([a-zA-Z]+\s)*[a-zA-Z]+$/.test(valor)) { //Expresion regular (solo letras y espacios)
    alert("Solo puede contener letras");
    return false;
  }else{
	return true;
  }
} 

// Funcion que comprueba todos los campos con validaciones y envia si son correctos
function comprobarValidaciones(){
	if (!validarPassword()){
		return false;
	}else{
		if (!validarAlfabetico(document.getElementById('nombre'))){
			return false;
		}else{
			if (!validarAlfabetico(document.getElementById('apellidos'))){
				return false;
			}else{
				if (!validarEmail(document.getElementById('email'))){
					return false;
				}else{
					if (!validarDni(document.getElementById('dni'))){
						return false;
					}
				}
			}
		}
	}
	alert('Bien');
	return true;
}	
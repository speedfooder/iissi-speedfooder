// Funciones de validación
	// EJERCICIO 3: Validación del formulario en cliente con Javascript (después de la validación de HTML5)
	function validateForm() {
		var noValidation = document.getElementById("#altaUsuario").novalidate;
		
		if (!noValidation){
			// Comprobar que la longitud de la contraseña es >=8, que contiene letras mayúsculas y minúsculas y números
			var error1 = passwordValidation();
			var error2 = dniValidation();
	        
			return error1.length==0 && error2.length==0;
		}
		else 
			return true;
	}

	// EJERCICIO 3.1: Comprobar la restricciones del password y aplicar clases CSS mediante JQuery
	function passwordValidation(){
		var password = document.getElementById("password");
		var pwd = password.value;
		var valid = true;

		// Comprobamos la longitud de la contraseña
		valid = valid && (pwd.length>=8);
		
		// Comprobamos si contiene letras mayúsculas, minúsculas y números
		var hasNumber = /\d/;
		var hasUpperCases = /[A-Z]/;
		var hasLowerCases = /[a-z]/;
		valid = valid && (hasNumber.test(pwd)) && (hasUpperCases.test(pwd)) && (hasLowerCases.test(pwd));
		
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
			var error = "Por favor introduzca una contraseña válida (Al menos 8 caracteres, letras mayúsculas, minúsculas y números).";
		}else{
			var error = "";
		}
	        password.setCustomValidity(error);
		return error;
	}

	//Calcula la fortaleza de una contraseña: frecuencia de repetición de caracteres
	function passwordStrength(password){
    		// Creamos un Map donde almacenar las ocurrencias de cada carácter
    		var letters = {};

    		// Recorremos la contraseña carácter por carácter
    		var length = password.length;
    		for(x = 0, length; x < length; x++) {
        		// Consultamos el carácter en la posición x
        		var l = password.charAt(x);

        		// Si NO existe en el Map, inicializamos su contador a uno
        		// Si ya existía, incrementamos el contador en uno
        		letters[l] = (isNaN(letters[l])? 1 : letters[l] + 1);
    		}

    		// Devolvemos el cociente entre el número de caracteres únicos (las claves del Map)
		// y la longitud de la contraseña
    		return Object.keys(letters).length / length;
	}
	
	//Coloreado del campo de contraseña según su fortaleza
	function passwordColor(){
		var passField = document.getElementById("pass");
		var strength = passwordStrength(passField.value);
		
		if(!isNaN(strength)){
			var type = "weakpass";
			if(passwordValidation()!=""){
				type = "weakpass";
			}else if(strength > 0.7){
				type = "strongpass";
			}else if(strength > 0.4){
				type = "middlepass";
			}
		}else{
			type = "nanpass";
		}
		passField.className = type;
		
		return type;
	}
	
	function dniValidation(){
		var dni = document.getElementById("DNI");
		var dnival = dni.value;
		var valid = true;

		// Comprobamos la longitud del dni
		valid = valid && (dnival.length==8);
		
		// Comprobamos si no contiene letras mayúsculas, minúsculas pero sí números
		var hasNumber = /\d/;
		var hasUpperCases = /[A-Z]/;
		var hasLowerCases = /[a-z]/;
		valid = valid && (hasNumber.test(dnival)) && !(hasUpperCases.test(dnival)) && !(hasLowerCases.test(dnival));
		
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
			var error = "Por favor introduzca un DNI valido (los 8 numeritos solo ;) )";
		}else{
			var error = "";
		}
	        dni.setCustomValidity(error);
		return error;
	}
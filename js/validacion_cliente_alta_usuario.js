// Funciones de validación
	function validateForm() {
		var noValidation = document.getElementById("#altaUsuario").novalidate;
		
		if (!noValidation){
			// Comprobar que la longitud de la contraseña es >=8, que contiene letras mayúsculas y minúsculas y números
			var error1 = passwordValidation();
			var error2 = dniValidation();
			var error3 = nameValidation();
			var error4 = emailValidation();
	        
			return error1.length==0 && error2.length==0
			&& error3.length==0 && error4.length==0;
		}
		else 
			return true;
	}
	
	function validateFormContacto() {
		var noValidation = document.getElementById("#contacto").novalidate;
		
		if (!noValidation){
			var error3 = nameValidation();
			var error4 = emailValidation();
	        
			return error3.length==0 && error4.length==0;
		}
		else 
			return true;
	}

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
	
	function emptyPasswordValidation(){
		var passwd = document.getElementById("password");
		var pass = passwd.value;
		var valid = pass.length>0;
		
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
			var error = "Por favor introduzca la contraseña.";
		}else{
			var error = "";
		}
	        passwd.setCustomValidity(error);
		return error;
	}
	
	//Coloreado del campo de contraseña según su fortaleza
	function passwordColor(){
		
		var passField = document.getElementById("password");
		var pass = passField.value;
		
		//Minusculas, mayusculas, numeros y simbolos.
		var StrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[$-\/:-?{-~!"#^_`\[\]])\S{8,}$/;
		
		var type = "weakpass";
			if(passwordValidation()!=""){
				type = "weakpass";
			}else{
				type = "middlepass";
				if(StrongPass.test(pass)){
					type = "strongpass";
				}
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

	function nameValidation(){
		var name = document.getElementById("nombre");
		var nameval = name.value;
		var valid = nameval.length>0;
		
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
			var error = "Por favor introduzca un nombre.";
		}else{
			var error = "";
		}
	        name.setCustomValidity(error);
		return error;
	}
	
	function emailValidation() {
		var mail = document.getElementById("email");
		var mailval = mail.value;
		var valid = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mailval);
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
			var error = "Por favor introduzca un email válido.";
		}else{
			var error = "";
		}
	        mail.setCustomValidity(error);
		return error;  
	}
/**
 * Diálogos de confirmación y respuesta SweetAlert2 que ejecuta una operación asíncrona enviando un formulario vía POST.
 * @param {form} objFormulario - La referencia al objeto formulario.
 * @param {string} urlProcesamiento - La dirección que procesará el formulario vía POST.
 * @param {string} pregunta - El título del díalogo de confirmación.
 * @param {string} texto - El texto del díalogo de confirmación.
 * @param {string} textoResultado - El título del díalogo de resultado.
 * @param {function} funcExito - [Opcional] Función a ejecutar luego de un procesamiento exitoso.
 * @param {function} argsfuncExito - [Opcional] Argumentos de la función a ejecutar.
 * @returns {SweetAlert2} - Un diálogo con una respuesta. se espera que el procesamiento POST devuelva un par JSON con atributos {"codigo", "texto"}. 
 */
function asincPOSTConConfirmacion(objFormulario, urlProcesamiento, pregunta, texto, textoResultado, funcExito=null, argsfuncExito=null) {
	const formData = new FormData(objFormulario); // Crear objeto FormData con el formulario

	Swal.fire({
		title: pregunta,
		text: texto,
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		showLoaderOnConfirm: true,
		preConfirm: async () => {
			try {
				const response = await fetch(urlProcesamiento, {
					method: "POST",
					body: formData, // Enviar el formulario directamente
				});

				if (!response.ok) {
					throw new Error(`Error: ${response.statusText}`);
				}
				// Se espera que el procesamiento POST devuelva un par JSON con atributos {"codigo", "texto"}
				const res = await response.json();

				if (res.codigo !== 1) {
					Swal.showValidationMessage(res.texto);
				}
				return res;
			} catch (error) {
				Swal.showValidationMessage(error.message);
			}
		},
		allowOutsideClick: () => !Swal.isLoading()
	}).then((result) => {
		if (result.isConfirmed) {
			Swal.fire({
				icon: "success",
				title: textoResultado,
				text: result.value.texto,
				timer: 3000,
				timerProgressBar: true,
			}).then( (resp) => {
				if (funcExito != null && (resp.isConfirmed || resp.isDenied || resp.isDismissed) ) {
					funcExito(argsfuncExito);
				}
			})
		}
	});
}

/**
 * Diálogo de respuesta SweetAlert2 que ejecuta una operación asíncrona enviando un formulario vía POST.
 * @param {form} objFormulario - La referencia al objeto formulario.
 * @param {string} urlProcesamiento - La dirección que procesará el formulario vía POST.
 * @param {string} titulo - El título del díalogo de procesamiento.
 * @param {string} texto - El texto del díalogo de procesamiento.
 * @param {string} textoResultado - El título del díalogo de resultado.
 * @param {function} funcExito - Función a ejecutar luego de un procesamiento exitoso.
 * @param {function} argsfuncExito - Argumentos de la función a ejecutar.
 * @returns {SweetAlert2} - Un diálogo con una respuesta. se espera que el procesamiento POST devuelva un par JSON con atributos {"codigo", "texto"}. 
 */
function asincPOST(objFormulario, urlProcesamiento, titulo, texto, textoResultado, funcExito=null, argsfuncExito=null) {
	const formData = new FormData(objFormulario); // Crear objeto FormData con el formulario

	Swal.fire({
		title: titulo,
		text: texto,
		icon: "info",
		allowOutsideClick: () => !Swal.isLoading(),
		showConfirmButton: false,
		didOpen: async () => {
			Swal.showLoading(); // Mostrar estado de carga
			try {
				// Enviar la petición asíncrona
				const response = await fetch(urlProcesamiento, {
					method: "POST",
					body: formData,
				});

				// Verificar si la respuesta es válida
				if (!response.ok) {
					throw new Error(`Error: ${response.statusText}`);
				}
				// Se espera que el procesamiento POST devuelva un par JSON con atributos {"codigo", "texto"}
				const res = await response.json();

				Swal.hideLoading(); // Ocultar el estado de carga

				// Verificar el resultado del procesamiento
				if (res.codigo === 1) {
					Swal.fire({
						icon: "success",
						title: textoResultado,
						text: res.texto,
						timer: 3000,
						timerProgressBar: true,
						showConfirmButton: true,
					}).then(() => {
						// Ejecutar la función de éxito si fue proporcionada
						if (funcExito != null) {
							funcExito(argsfuncExito);
						}
					});
				} else {
					// Mostrar error en caso de fallo
					Swal.fire({
						icon: "error",
						title: "Error",
						text: res.texto || "Hubo un problema con el procesamiento.",
					});
				}
			} catch (error) {
				// Manejo de errores de la petición
				Swal.hideLoading();
				Swal.fire({
					icon: "error",
					title: "Error",
					text: error.message || "Error inesperado durante el procesamiento.",
				});
			}
		},
	});
}

/**
 * Crea un formulario de manera programática con base a un arreglo de JSON de forma (K,V)
 * @param {array[json(K,V)]} arrParesJSON - Arreglo de pares de valores en formato JSON.
 * @param {string} urlProcesamiento - [Opcional] La URL de procesamiento.
 * @param {string} metodo - [Opcional] POST o GET.
 * @returns {form} - El formulario creado de manera dinámica.
 */
function creaFormDinamico(arrParesJSON, urlProcesamiento = "#", metodo = "POST") {
    // Crear el formulario
    const form = document.createElement("form");
    form.method = metodo;
    form.action = urlProcesamiento;

    // Crear los inputs dinámicamente
    arrParesJSON.forEach(({ name, value }) => {
        const input = document.createElement("input");
        input.type = "text";
        input.name = name;
        input.value = value;
        form.appendChild(input);
    });

    // Crear un botón para enviar el formulario
    const submitButton = document.createElement("button");
    submitButton.type = "submit";
    submitButton.textContent = "Enviar";

    // Agregar el botón al formulario
    form.appendChild(submitButton);

    return form;
}

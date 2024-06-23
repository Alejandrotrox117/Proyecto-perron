// Función para validar formularios
export function validarFormulario(formularioId, reglasValidacion) {
  // Objeto para almacenar el estado de validación de cada campo
  const campos = {};

  // Función para validar un campo individual
  const validarCampo = (expresion, input, campo) => {
    const errorVacio = document.getElementById(`error-${campo}-vacio`);
    const errorFormato = document.getElementById(`error-${campo}-formato`);

    if (input.value === "") {
      campos[campo] = false;
      errorVacio.style.display = "block";
      errorFormato.style.display = "none";
      input.classList.remove("is-valid");
      input.classList.add("is-invalid");
    } else if (expresion.test(input.value)) {
      campos[campo] = true;
      errorVacio.style.display = "none";
      errorFormato.style.display = "none";
      input.classList.remove("is-invalid");
      input.classList.add("is-valid");
    } else {
      // Mostrar mensaje de error y evitar el envío
      //swal("Error", `El campo no cumple con el formato requerido.`, "error");
      campos[campo] = false;
      errorVacio.style.display = "none";
      errorFormato.style.display = "block";
      input.classList.remove("is-valid");
      input.classList.add("is-invalid");
    
    }
  };

  // Se añaden los eventos de escucha a los inputs
  const inputs = formularioId.querySelectorAll("input, select");
  inputs.forEach((input) => {
    input.addEventListener("input", (e) => {
      // Se obtiene la expresión regular para el campo actual
      const expresion = reglasValidacion[e.target.name];
      // Se valida el campo si tiene una expresión regular definida
      if (expresion) {
        validarCampo(expresion, e.target, e.target.name);
      }
    });
  });

  // Retorna un objeto con el estado de validación de cada campo
  return campos;
}
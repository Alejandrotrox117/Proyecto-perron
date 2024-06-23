 // archivo con las expresiones regulares
 export const expresiones = {
    txtRol: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    txtDescripcion: /^[a-zA-ZÀ-ÿ\s0-9.,;:'"!?()\[\]{}\-_\/\\|#$%&*+=@]+$/ // Permite letras, espacios, números y algunos símbolos
  };
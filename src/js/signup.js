const input = document.getElementById("image");
const preview = document.getElementById("preview-img");
const wrapper = document.querySelector(".profile-pic-wrapper");
const errorMsg = document.getElementById("error-formato");

// Hacer clic en el contenedor para abrir el selector de archivos
wrapper.addEventListener("click", () => {
    input.click();
});

// Manejar el cambio de archivo
input.addEventListener("change", function() {
    const file = this.files[0];

    // Si no hay archivo seleccionado, salir
    if (!file) return;

    const validExt = ["image/jpeg", "image/png", "image/jpg"];

    // Si el archivo no es una imagen válida, mostrar mensaje de error
    if (!validExt.includes(file.type)) {
        errorMsg.style.display = "block";
        input.value = "";
        return;
    }

    // Ocultar mensaje de error si la imagen es válida
    errorMsg.style.display = "none";

    // Mostrar vista previa de la imagen
    const reader = new FileReader();
    reader.onload = function(e) {
        preview.src = e.target.result;
    };
    // Leer el archivo como una URL de datos
    reader.readAsDataURL(file);
});


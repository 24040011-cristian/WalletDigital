// Manejo del modal para editar o eliminar una tarjeta
document.querySelectorAll(".card-item").forEach(card => {
    card.addEventListener("click", () => {

        // Obtener datos de la tarjeta
        const id = card.dataset.id;
        const saldo = card.dataset.saldo;

        // Rellenar el formulario del modal
        document.getElementById("idTarjeta").value = id;
        document.getElementById("saldo").value = saldo;

        // Mostrar el modal
        document.getElementById("modalCard").classList.remove("hidden");
    });
});

// Cerrar el modal
document.getElementById("btnCloseModal").addEventListener("click", () => {
    document.getElementById("modalCard").classList.add("hidden");
});

// Manejar la edición de la tarjeta
document.getElementById("btnDelete").addEventListener("click", () => {

    if (confirm("¿Seguro que quieres eliminar esta tarjeta?")) {
        
        // Enviar el formulario para eliminar la tarjeta
        const form = document.getElementById("formEditCard");
        form.action = "/walletDigital/php/process.php";
        form.querySelector("input[name='accion']").value = "DeleteCard";
        form.submit();
    }
});


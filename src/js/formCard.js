document.querySelectorAll(".card-item").forEach(card => {
    card.addEventListener("click", () => {

        const id = card.dataset.id;
        const saldo = card.dataset.saldo;

        document.getElementById("idTarjeta").value = id;
        document.getElementById("saldo").value = saldo;

        document.getElementById("modalCard").classList.remove("hidden");
    });
});

document.getElementById("btnCloseModal").addEventListener("click", () => {
    document.getElementById("modalCard").classList.add("hidden");
});

document.getElementById("btnDelete").addEventListener("click", () => {
    if (confirm("¿Seguro que quieres eliminar esta tarjeta?")) {

        const form = document.getElementById("formEditCard");
        form.action = "/walletDigital/php/process.php";
        
        form.querySelector("input[name='accion']").value = "DeleteCard";

        form.submit();
    }
});



const input = document.getElementById("image");
const preview = document.getElementById("preview-img");
const wrapper = document.querySelector(".profile-pic-wrapper");
const errorMsg = document.getElementById("error-formato");

wrapper.addEventListener("click", () => {
    input.click();
});

input.addEventListener("change", function() {
    const file = this.files[0];

    if (!file) return;

    const validExt = ["image/jpeg", "image/png", "image/jpg"];

    if (!validExt.includes(file.type)) {
        errorMsg.style.display = "block";
        input.value = "";
        return;
    }

    errorMsg.style.display = "none";

    const reader = new FileReader();
    reader.onload = function(e) {
        preview.src = e.target.result;
    };
    reader.readAsDataURL(file);
});


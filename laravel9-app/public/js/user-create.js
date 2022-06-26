function checkValidate() {
    var name = document.getElementById("name");
    var nickname = document.getElementById("nickname");
    var email = document.getElementById("email");
    var address = document.getElementById("address");
    if (
        name.value != "" &&
        email.value != "" &&
        address.value != ""
        // &&
        // (name.classList.contains("is-invalid") ||
        //     email.classList.contains("is-invalid") ||
        //     address.classList.contains("is-invalid"))
    ) {
        if (nickname == "") {
            return;
        }
        document.getElementById("submitbtn").disabled = false;
    }
    return;
}

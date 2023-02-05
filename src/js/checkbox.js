function validateForm() {
    const checked = Array.from(document.getElementsByName("tag")).some((checkbox)=> checkbox.checked)


    if (!checked) {
        alert("Mindestens ein Tag muss ausgewählt sein");
        return false;
    }
    if (checked.length >= 1) {
        alert("Nur ein Tag darf ausgewählt sein");
        return false;
    }
    return true;
}
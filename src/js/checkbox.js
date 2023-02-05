function validateForm() {
    const checked = Array.from(document.getElementsByName("tag")).some((checkbox)=> checkbox.checked)

    if (!checked) {
        alert("At least one checkbox must be selected");
        return false;
    }
    return true;
}
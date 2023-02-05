function validateForm() {
    const checked = Array.from(document.getElementsByName("tag")).filter((checkbox)=> checkbox.checked);

    if (!checked.length) {
        alert("Mindestens ein Tag muss ausgewählt sein");
        return false;
    }
    document.querySelector("form").addEventListener("submit", function(event) {
        let checked = document.querySelectorAll("input[type='checkbox']:checked");
        if (checked.length > 1) {
            alert("Nur ein Tag darf ausgewählt sein");
            event.preventDefault();
        }
    });

    return true;

}
window.addEventListener('load', () => {
    const selectElement = document.getElementById("kunde");
    const selectedValue = new URL(window.location.href).searchParams.get("k_id");

    if (selectedValue) {
        selectElement.value = selectedValue;
        document.querySelector(`[value="${selectedValue}"]`).setAttribute("selected", "selected");
    }

    selectElement.addEventListener("change", function() {
        const newValue = selectElement.value;
        window.location.href = `?k_id=${newValue}`;
    });

});
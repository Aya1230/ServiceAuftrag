window.addEventListener('load', () => {
    function handleSelectElement(selectId, queryParam) {
        const selectElement = document.getElementById(selectId);
        const currentURL = new URL(window.location.href);
        const searchParams = new URLSearchParams(currentURL.search);
        const selectedValue = searchParams.get(queryParam);

        if (selectedValue) {
            selectElement.value = selectedValue;
            document.querySelector(`[value="${selectedValue}"]`).setAttribute("selected", "selected");
        }

        selectElement.addEventListener("change", function() {
            const kundeValue = document.getElementById("kunde").value;
            const userValue = document.getElementById("user").value;
            searchParams.set("k_id", kundeValue);
            searchParams.set("u_id", userValue);

            // keep the a_nr parameter in the URL if it exists
            const a_nrValue = searchParams.get("a_nr");
            if (a_nrValue) {
                searchParams.set("a_nr", a_nrValue);
            }

            const newURL = currentURL.origin + currentURL.pathname + "?" + searchParams.toString();
            window.location.href = newURL;
        });
    }

    handleSelectElement("kunde", "k_id");
    handleSelectElement("user", "u_id");
});
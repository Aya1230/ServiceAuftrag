function generatePDF() {
    var pdf = new jsPDF();
    var source = document.getElementById("pdf");
    var specialElementHandlers = {
        "#bypassme": function (element, renderer) {
            return true;
        }
    };
    pdf.setFontSize(30);
    pdf.text("Auftragdetails", 70, 25);
    pdf.fromHTML(
        source,
        10,
        10,
        {
            width: 1000,
            elementHandlers: specialElementHandlers
        },
        function (dispose) {
            pdf.save("Auftragsdetails.pdf");
        },
        10,
        10,
        null,
        true,
    );
}
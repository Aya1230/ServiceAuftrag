window.addEventListener('load', function() {
    const phoneTds = document.querySelectorAll('td#phone');
    phoneTds.forEach(function(phoneTd) {
        const phoneNumber = phoneTd.innerText;
        const formattedPhoneNumber = formatPhoneNumber(phoneNumber);
        phoneTd.innerText = formattedPhoneNumber;
    });
});

function formatPhoneNumber(phoneNumber) {
    if (phoneNumber.substring(0, 3) === '+41' || phoneNumber.substring(0, 3) === '+49') {
        return phoneNumber.replace(/(\+4\d)(\d{2})(\d{3})(\d{2})(\d{2})/, '$1 $2 $3 $4 $5');
    } else if (phoneNumber.substring(0, 2) === '07' || phoneNumber.substring(0, 2) === '01') {
        return phoneNumber.replace(/(0\d{1})(\d{3})(\d{2})(\d{2})/, '$1 $2 $3 $4');
    }
    return phoneNumber;
}

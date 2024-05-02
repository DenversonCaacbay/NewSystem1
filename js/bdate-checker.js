function checkBdate(dateInputId) {
    var dateInput = document.getElementById(dateInputId).value;
    var currentDate = new Date();
    var selectedDate = new Date(dateInput);

    // Calculate the date 18 years ago
    var eighteenYearsAgo = new Date();
    eighteenYearsAgo.setFullYear(currentDate.getFullYear() - 15);

    // Check if the selected date is less than 18 years ago
    if (selectedDate > eighteenYearsAgo) {
        alert('Invalid date. You must be 15 years or older to register.');
        // Optionally, you can clear the input or perform any other actions here
        document.getElementById(dateInputId).value = '';
    }
}
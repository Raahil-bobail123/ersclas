function registerUser(event) {
    event.preventDefault();

    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;

    // Create FormData to send via POST
    var formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);

    // Send the form data using fetch API
    fetch('submit.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data === 'duplicate') {
            // Handle duplicate entries
            alert('This email has already been registered.');
        } else {
            // Hide the form once the registration is successful
            document.getElementById('registrationForm').style.display = 'none';

            // Display the registration ID in the subtle box
            document.getElementById('generatedID').textContent = data;
            document.getElementById('registrationResult').style.display = 'block';
        }
    })
    .catch(error => console.error('Error:', error));
}

// Function to reload the page when the "Okay" button is clicked
function closePopup() {
    location.reload(); // Reload the page
}

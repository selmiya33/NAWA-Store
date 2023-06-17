// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Get the flash message element
    var flashMessage = document.querySelector('.alert.alert-success');

    // Show the flash message
    flashMessage.classList.remove('hidden');

    // Hide the flash message after 5 seconds (5000 milliseconds)
    setTimeout(function() {
        flashMessage.classList.add('hidden');
    }, 3000); // 5000 milliseconds = 5 seconds
});


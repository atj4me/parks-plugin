document.addEventListener('DOMContentLoaded', function () {
    // Get the title input element
    const titleInput = document.getElementById('title');
    /**
     * Input element for park name from the DOM.
     * @type {HTMLInputElement}
     */
    const parkNameInput = document.getElementById('park_name');

    if (titleInput && parkNameInput) {
        // Listen for title changes
        titleInput.addEventListener('input', function () {
            parkNameInput.value = this.value;
        });

        // Also sync on page load if title exists
        if (titleInput.value) {
            parkNameInput.value = titleInput.value;
        }
    }
});
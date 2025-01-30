class Modal {
    constructor(modalId) {
        this.modal = document.getElementById(modalId);
        this.overlay = document.createElement('div');
        this.overlay.classList.add('modal-overlay');
        document.body.appendChild(this.overlay);

        this.init();
    }

    // Initialize event listeners
    init() {
        // Close modal when clicking the overlay
        this.overlay.addEventListener('click', () => this.close());

        // Close modal when clicking the close button
        const closeButtons = this.modal.querySelectorAll('[data-dismiss="modal"]');
        closeButtons.forEach(button => {
            button.addEventListener('click', () => this.close());
        });
    }

    // Open the modal
    open() {
        this.modal.style.display = 'block';
        this.overlay.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }

    // Close the modal
    close() {
        this.modal.style.display = 'none';
        this.overlay.style.display = 'none';
        document.body.style.overflow = 'auto'; // Restore scrolling
    }
}

// Initialize the modal
const modal = new Modal('exampleModal');

// Open modal when the button is clicked
document.getElementById('open-modal-btn').addEventListener('click', () => {
    modal.open();
});
class Modal {
  constructor(trigger, options = {}) {
    this.options = {
      size: options.size || "medium",
      position: options.position || "center",
      content: options.content || "This is a modal",
    };
    this.trigger = trigger;
    this.modal = document.querySelector(`[data-modal=${trigger}]`);
    this.init();
  }

  init() {
    if (!this.modal) {
      console.error(`Modal with trigger [data-modal=${this.trigger}] not found.`);
      return;
    }

    console.log('modal', this.modal);
    const contentWrapper = this.modal.querySelector('.content-wrapper');
    const close = this.modal.querySelector('.close');

    if (close) {
      close.addEventListener('click', () => this.close());
    }

    this.modal.addEventListener('click', () => this.close());

    if (contentWrapper) {
      contentWrapper.addEventListener('click', (e) => e.stopPropagation());
    }
  }

  open() {
    if (this.modal) {
      this.modal.classList.add("open");
    }
  }

  close() {
    if (this.modal) {
      this.modal.classList.remove("open");
    }
  }

  toggle() {
    if (this.modal) {
      this.modal.classList.toggle("open");
    }
  }

  resize(size) {
    if (this.modal) {
      this.modal.classList.remove("small", "medium", "large");
      this.modal.classList.add(size);
    }
  }

  reposition(position) {
    if (this.modal) {
      this.modal.classList.remove("top", "bottom", "left", "right", "center");
      this.modal.classList.add(position);
    }
  }
}

// Exporting module
export default Modal;

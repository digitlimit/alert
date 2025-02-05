class Toast
{
  constructor() {
    this.$container = null;
    this.listener = null;
    this.toastId = 0;
    this.previousToast = undefined;
    this.options = {};
    this.toastType = {
      error: 'error',
      info: 'info',
      success: 'success',
      warning: 'warning',
    };

    // Initialize any existing toasts on page load
    this.init();
  }

  init() {
    // Check if the toast container exists and has toasts inside
    this.$container = $('#toastr-container');
    if (this.$container.length) {
      this.$container.children('.toastr').each((_, el) => {
        const $toastElement = $(el);
        const type = this.getToastType($toastElement);
        const title = $toastElement.find('.toastr-title').text();
        const message = $toastElement.find('.toastr-message').text();

        // Rebuild the toast using the existing elements
        this.notify({
          type,
          iconClass: this.getOptions().iconClasses[type],
          message,
          title,
        });
      });
    }
  }

  getToastType($toastElement) {
    if ($toastElement.hasClass('toastr-success')) return 'success';
    if ($toastElement.hasClass('toastr-error')) return 'error';
    if ($toastElement.hasClass('toastr-info')) return 'info';
    if ($toastElement.hasClass('toastr-warning')) return 'warning';
    return 'info'; // Default type
  }

  error(message, title, optionsOverride) {
    return this.notify({
      type: this.toastType.error,
      iconClass: this.getOptions().iconClasses.error,
      message,
      optionsOverride,
      title,
    });
  }

  info(message, title, optionsOverride) {
    return this.notify({
      type: this.toastType.info,
      iconClass: this.getOptions().iconClasses.info,
      message,
      optionsOverride,
      title,
    });
  }

  success(message, title, optionsOverride) {
    return this.notify({
      type: this.toastType.success,
      iconClass: this.getOptions().iconClasses.success,
      message,
      optionsOverride,
      title,
    });
  }

  warning(message, title, optionsOverride) {
    return this.notify({
      type: this.toastType.warning,
      iconClass: this.getOptions().iconClasses.warning,
      message,
      optionsOverride,
      title,
    });
  }

  notify(map) {
    let options = this.getOptions();
    let iconClass = map.iconClass || options.iconClass;
    if (map.optionsOverride) {
      options = Object.assign(options, map.optionsOverride);
      iconClass = map.optionsOverride.iconClass || iconClass;
    }
    if (this.shouldExit(options, map)) return;

    this.toastId++;
    this.$container = this.getContainer(options, true);

    let $toastElement = $('<div/>')
        .addClass('toastr')
        .addClass(iconClass)
        .append(`<div class="toastr-title">${map.title || ''}</div>`)
        .append(`<div class="toastr-message">${map.message}</div>`)
        .append(`<div class="toastr-progress" style="width: 100%;"></div>`);

    if (options.newestOnTop) {
      this.$container.prepend($toastElement);
    } else {
      this.$container.append($toastElement);
    }

    setTimeout(() => this.removeToast($toastElement), options.timeOut);
    return $toastElement;
  }

  removeToast($toastElement) {
    if (!$toastElement) return;
    $toastElement.fadeOut(500, () => $toastElement.remove());
  }

  getDefaults() {
    return {
      containerId: 'toastr-container',
      positionClass: 'toastr-bottom-center',
      iconClasses: {
        error: 'toastr-error',
        info: 'toastr-info',
        success: 'toastr-success',
        warning: 'toastr-warning',
      },
      timeOut: 5000,
      closeOnHover: true,
      preventDuplicates: false,
    };
  }

  getOptions() {
    return Object.assign({}, this.getDefaults(), this.options);
  }

  getContainer(options = this.getOptions(), create = false) {
    this.$container = $('#' + options.containerId);
    if (!this.$container.length && create) {
      this.$container = this.createContainer(options);
    }
    return this.$container;
  }

  createContainer(options) {
    this.$container = $('<div/>')
        .attr('id', options.containerId)
        .addClass(options.positionClass)
        .appendTo($(options.target || 'body'));
    return this.$container;
  }
}

export default Toast;

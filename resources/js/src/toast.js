class Toast
{
  $container;
  previousToast;
  listener;
  toastId = 0;
  toastType = {
    error: 'error',
    info: 'info',
    success: 'success',
    warning: 'warning'
  };

  constructor() {
    this.init();
  }

  init() {
    const toasts = document.querySelectorAll('.toastr');

    toasts.forEach(toastr => {
      const id = toastr.getAttribute('id');
      const toast = this.firstEl('.toast');

      if (!id || !toast) {
        console.error('Toast not found.');
        return;
      }

      const progress = this.firstEl('.toast-progress', toast);
      const close = this.firstEl('.toast-close-button', toast);
      const title = this.firstEl('.toast-title', toast)?.innerText ?? '';
      const message = this.firstEl('.toast-message', toast)?.innerText ?? '';
      const type = this.getToastType(toast) ?? 'info';
      const iconClass = this.getOptions().iconClasses[type];

      this.$container = toast

      this.notify({
        iconClass,
        type,
        message,
        title,
        optionsOverride: {
          containerId: id,
        }
      });
    });
  }

  getToastType(element) {
    if (element.classList.contains('toast-success')) return 'success';
    if (element.classList.contains('toast-error')) return 'error';
    if (element.classList.contains('toast-info')) return 'info';
    if (element.classList.contains('toast-warning')) return 'warning';
    return 'info'; // Default type
  }

  closeBtnEl() {
    const button = document.createElement("button");

    button.setAttribute("type", "button");

    button.innerHTML = "&times;";

    return button;
  }

  fadeOut(el, duration, callback) {
    el.style.opacity = 1;
    (function fade() {
      if ((el.style.opacity -= .1) < 0) {
        el.style.display = "none";
      } else {
        requestAnimationFrame(fade);
        callback();
      }
    })();
  };

  fadeIn(el, duration) {
    el.style.opacity = 0;

    const increment = 1 / (duration / 16);

    (function fade() {
      let val = parseFloat(el.style.opacity);

      if (!((val += increment) > 1)) {
        el.style.opacity = val;
        requestAnimationFrame(fade);
      }
    })();
  };

  el(selector, context = document) {
    if(selector.startsWith('.')) {
      return context.getElementsByClassName(selector.substring(1));
    }

    if(selector.startsWith('<') && selector.endsWith('>')) {
      return context.createElement(selector.substring(1, selector.length - 2));
    }

    if(selector.startsWith('#')) {
      return context.getElementById(selector.substring(1));
    }

    return context.querySelector(selector);
  }

  firstEl(selector, context = document) {
    return this.el(selector, context)[0] ?? null;
  }

  toastr() {
    return {
      clear: this.clear,
      remove: this.remove,
      error: this.error,
      getContainer: this.getContainer,
      info: this.info,
      options: {},
      subscribe: this.subscribe,
      success: this.success,
      version: '1.0.0',
      warning: this.warning
    }
  }

  error(message, title, optionsOverride) {
    return this.notify({
      type: this.toastType.error,
      iconClass: this.getOptions().iconClasses.error,
      message: message,
      optionsOverride: optionsOverride,
      title: title
    });
  }

  getContainer(options, create) {
    if (!options) { options = this.getOptions(); }
    this.$container = this.$container ?? document.getElementById(options.containerId);

    if (this.$container) {
      return this.$container;
    }

    if (create) {
      this.$container = this.createContainer(options);
    }
    return this.$container;
  }

  info(message, title, optionsOverride) {
    return this.notify({
      type: this.toastType.info,
      iconClass: this.getOptions().iconClasses.info,
      message: message,
      optionsOverride: optionsOverride,
      title: title
    });
  }

  subscribe(callback) {
    this.listener = callback;
  }

  success(message, title, optionsOverride) {
    return this.notify({
      type: this.toastType.success,
      iconClass: this.getOptions().iconClasses.success,
      message: message,
      optionsOverride: optionsOverride,
      title: title
    });
  }

  warning(message, title, optionsOverride) {
    return this.notify({
      type: this.toastType.warning,
      iconClass: this.getOptions().iconClasses.warning,
      message: message,
      optionsOverride: optionsOverride,
      title: title
    });
  }

  clear($toastElement, clearOptions)
  {
    const options = this.getOptions();

    if (!this.$container) {
      this.getContainer(options);
    }

    if (!this.clearToast($toastElement, options, clearOptions)) {
      this.clearContainer(options);
    }
  }

  remove($toastElement) {
    let options = this.getOptions();
    if (!this.$container) {
      this.getContainer(options);
    }

    if ($toastElement && this.el(':focus', $toastElement).length === 0) {
      this.removeToast($toastElement);
      return;
    }

    if (this.$container.children().length) {
      this.$container.remove();
    }
  }

  // internal functions

  clearContainer (options) {
    const toastsToClear = this.$container.children();
    for (let i = toastsToClear.length - 1; i >= 0; i--) {
      this.clearToast(this.el(toastsToClear[i]), options);
    }
  }

  clearToast ($toastElement, options, clearOptions) {
    let force = clearOptions && clearOptions.force ? clearOptions.force : false;
    if ($toastElement && (force || this.el(':focus', $toastElement).length === 0)) {
      $toastElement[options.hideMethod]({
        duration: options.hideDuration,
        easing: options.hideEasing,
        complete: () =>{
          this.removeToast($toastElement);
        }
      });
      return true;
    }
    return false;
  }

  createContainer(options) {
    this.$container = this.el('<div/>');
    this.$container.setAttribute('id', options.containerId);
    this.$container.classList.add(options.positionClass);

    this.el(options.target).appendChild(this.$container);
    return this.$container;
  }

  getDefaults() {
    return {
      tapToDismiss: true,
      toastClass: 'toast',
      containerId: 'toast-container',
      debug: false,

      showMethod: 'fadeIn', //fadeIn, slideDown, and show are built into jQuery
      showDuration: 300,
      showEasing: 'swing', //swing and linear are built into jQuery
      onShown: undefined,
      hideMethod: 'fadeOut',
      hideDuration: 1000,
      hideEasing: 'swing',
      onHidden: undefined,
      closeMethod: false,
      closeDuration: false,
      closeEasing: false,
      closeOnHover: true,

      extendedTimeOut: 1000,
      iconClasses: {
        error: 'toast-error',
        info: 'toast-info',
        success: 'toast-success',
        warning: 'toast-warning'
      },
      iconClass: 'toast-info',
      positionClass: 'toast-top-right',
      timeOut: 5000, // Set timeOut and extendedTimeOut to 0 to make it sticky
      titleClass: 'toast-title',
      messageClass: 'toast-message',
      escapeHtml: false,
      target: 'body',
      closeHtml: '<button type="button">&times;</button>',
      closeClass: 'toast-close-button',
      newestOnTop: true,
      preventDuplicates: false,
      progressBar: false,
      progressClass: 'toast-progress',
      rtl: false
    };
  }

  publish(args) {
    if (!this.listener) { return; }
    this.listener(args);
  }

  notify(map)
  {
    let options = this.getOptions();
    let iconClass = map.iconClass || options.iconClass;

    if (typeof (map.optionsOverride) !== 'undefined') {
      options = Object.assign(options, map.optionsOverride);
      iconClass = map.optionsOverride.iconClass || iconClass;
    }

    if (this.shouldExit(options, map)) {
      return;
    }

    this.toastId++;
    this.$container = this.getContainer(options, true);

    let intervalId = null;
    let $toastElement = this.el('<div/>');
    let $titleElement = this.el('<div/>');
    let $messageElement = this.el('<div/>');
    let $progressElement = this.el('<div/>');
    let $closeElement = this.closeBtnEl();
    let progressBar = {
      intervalId: null,
      hideEta: null,
      maxHideTime: null
    };
    let response = {
      toastId: this.toastId,
      state: 'visible',
      startTime: new Date(),
      options: options,
      map: map
    };

    // personalize toast
    this.setIcon(options, map, $toastElement);
    this.setTitle(options, map, $titleElement, $toastElement);
    this.setMessage(options, map, $messageElement, $toastElement);
    this.setCloseButton(options, $toastElement, $closeElement);
    this.setProgressBar(options, $toastElement, $progressElement);
    this.setRTL(options, $toastElement);
    this.setSequence(options, $toastElement);
    this.setAria(map, $toastElement);

    this.displayToast(options, $toastElement, intervalId, progressBar, response);

    this.handleEvents(options, $toastElement, $closeElement, intervalId, progressBar, response);

    this.publish(response);

    // console.log(response);

    return $toastElement;
  }


  //--------------------------
  escapeHtml(source) {
    if (source == null) {
      source = '';
    }

    return source
        .replace(/&/g, '&amp;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
  }


  setAria(map, $toastElement) {
    let ariaValue = '';
    switch (map.iconClass) {
      case 'toast-success':
      case 'toast-info':
        ariaValue =  'polite';
        break;
      default:
        ariaValue = 'assertive';
    }

    $toastElement.setAttribute('aria-live', ariaValue);

    return $toastElement;
  }

  handleEvents(options, $toastElement, $closeElement, intervalId, progressBar, response)
  {
    if (options.closeOnHover) {
      $toastElement.addEventListener(
          "mouseleave",
          () => this.delayedHideToast(null, options, $toastElement, intervalId, progressBar, response)
      );
    }

    if (!options.onclick && options.tapToDismiss) {
      $toastElement.addEventListener(
          'click',
          () =>  this.hideToast(null, options, $toastElement, intervalId, progressBar, response)
      );
    }

    if (options.closeButton && $closeElement) {
      $closeElement.click((event) => {
        if (event.stopPropagation) {
          event.stopPropagation();
        } else if (event.cancelBubble !== undefined && event.cancelBubble !== true) {
          event.cancelBubble = true;
        }

        if (options.onCloseClick) {
          options.onCloseClick(event);
        }

        // this.hideToast(true, options, $toastElement, intervalId, progressBar, response); // TODO: used arrow function to bind this
      });
    }

    if (options.onclick) {
      $toastElement.click((event) => {
        options.onclick(event);
        this.hideToast(null, options, $toastElement, intervalId, progressBar, response); // TODO: used arrow function to bind this
      });
    }
  }

  displayToast(options, $toastElement, intervalId, progressBar, response) {
    $toastElement.style.display = "none";

    // $toastElement[options.showMethod](
    //     {duration: options.showDuration, easing: options.showEasing, complete: options.onShown}
    // );

    this.fadeIn($toastElement, options.showDuration);

    if (options.timeOut > 0) {
      intervalId = setTimeout(
          () => this.hideToast(null, options, $toastElement, intervalId, progressBar, response),
          options.timeOut
      );

      progressBar.maxHideTime = parseFloat(options.timeOut);
      progressBar.hideEta = new Date().getTime() + progressBar.maxHideTime;
      if (options.progressBar) {
        progressBar.intervalId = setInterval(this.updateProgress, 10);
      }
    }
  }

  setIcon(options, map, $toastElement) {
    if (map.iconClass) {
      $toastElement.classList.add(options.toastClass);
      $toastElement.classList.add(map.iconClass);
    }
  }

  setSequence(options, $toastElement) {
    if (options.newestOnTop) {
      this.$container.insertBefore($toastElement, this.$container.firstChild);
    } else {
      this.$container.appendChild($toastElement);
    }
  }

  setTitle(options, map, $titleElement, $toastElement) {
    if (map.title) {
      let suffix = map.title;
      if (options.escapeHtml) {
        suffix = this.escapeHtml(map.title);
      }

      $titleElement.append(suffix);
      $titleElement.classList.add(options.titleClass);
      $toastElement.append($titleElement);
    }
  }

  setMessage(options, map, $messageElement, $toastElement) {
    if (map.message) {
      let suffix = map.message;
      if (options.escapeHtml) {
        suffix = this.escapeHtml(map.message);
      }

      $messageElement.append(suffix);
      $messageElement.classList.add(options.messageClass);
      $toastElement.append($messageElement);
    }
  }

  setCloseButton(options, $toastElement, $closeElement) {
    if (options.closeButton) {
      $closeElement.classList.add(options.closeClass);
      $closeElement.setAttribute('role', 'button');
      $toastElement.prepend($closeElement);
    }
  }

  setProgressBar(options, $toastElement, $progressElement,) {
    if (options.progressBar) {
      $progressElement.classList.add(options.progressClass);

      $toastElement.prepend($progressElement);
    }
  }

  setRTL(options, $toastElement) {
    if (options.rtl) {
      $toastElement.classList.add('rtl');
    }
  }

  shouldExit(options, map) {
    if (options.preventDuplicates) {
      if (map.message === this.previousToast) {
        return true;
      } else {
        this.previousToast = map.message;
      }
    }
    return false;
  }

  hideToast(override, options, $toastElement, intervalId, progressBar, response) {
    let method = override && options.closeMethod !== false ? options.closeMethod : options.hideMethod;

    let duration = override && options.closeDuration !== false ?
        options.closeDuration : options.hideDuration;

    let easing = override && options.closeEasing !== false ? options.closeEasing : options.hideEasing;
    if ($toastElement.querySelector(':focus') && !override) {
      return;
    }

    clearTimeout(progressBar.intervalId);

    return this.fadeOut($toastElement, duration, () => {
      this.removeToast($toastElement);

      clearTimeout(intervalId);

      if (options.onHidden && response.state !== 'hidden') {
        options.onHidden();
      }

      response.state = 'hidden';
      response.endTime = new Date();

      this.publish(response);
    });
  }

  delayedHideToast(override, options, $toastElement, intervalId, progressBar, response) {
    if (options.timeOut > 0 || options.extendedTimeOut > 0) {
      intervalId = setTimeout(
          this.hideToast(override, options, $toastElement, intervalId, progressBar, response),
          options.extendedTimeOut
      );
      progressBar.maxHideTime = parseFloat(options.extendedTimeOut);
      progressBar.hideEta = new Date().getTime() + progressBar.maxHideTime;
    }
  }

  stickAround() {
    clearTimeout(intervalId);
    progressBar.hideEta = 0;
    $toastElement.stop(true, true)[options.showMethod](
        {duration: options.showDuration, easing: options.showEasing}
    );
  }

  updateProgress() {
    var percentage = ((progressBar.hideEta - (new Date().getTime())) / progressBar.maxHideTime) * 100;
    $progressElement.width(percentage + '%');
  }
  //-------------------------







  getOptions() {
    return Object.assign({}, this.getDefaults(), this.toastr.options);
  }

  removeToast($toastElement) {
    if (!this.$container) {
      this.$container = this.getContainer();
    }

    $toastElement.remove();
    $toastElement = null;

    if (this.$container) {
      this.$container.remove();
      this.previousToast = undefined;
    }
  }
}

export default Toast;
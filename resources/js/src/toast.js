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

  el(selector, context = document) {
    if(selector.startsWith('.')) {
      return context.getElementsByClassName(selector.substring(1));
    }

    if(selector.startsWith('<') && selector.endsWith('>')) {
      return context.createElement(selector.substring(1, selector.length - 1));
    }

    if(selector.startsWith('#')) {
      return context.getElementById(selector.substring(1));
    }

    return context.querySelector(selector);
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
    this.$container = this.el('#' + options.containerId);
    if (this.$container.length) {
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
          this.removeToast($toastElement); // TODO: used arrow function to bind this
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
    let $closeElement = this.el(options.closeHtml);
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

    if (options.debug && console) {
      console.log(response);
    }

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
    $toastElement.attr('aria-live', ariaValue);
    // TODO: return $toastElement;
  }

  handleEvents(options, $toastElement, $closeElement, intervalId, progressBar, response)
  {
    if (options.closeOnHover) {
      $toastElement.hover(
          this.stickAround,
          //TODO: should override be null?
          this.delayedHideToast(null, options, $toastElement, intervalId, progressBar, response)
      );
    }

    if (!options.onclick && options.tapToDismiss) {
      // TODO: should override be null?
      $toastElement.click(this.hideToast(null, options, $toastElement, intervalId, progressBar, response));
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

        this.hideToast(true, options, $toastElement, intervalId, progressBar, response); // TODO: used arrow function to bind this
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
    $toastElement.hide();

    $toastElement[options.showMethod](
        {duration: options.showDuration, easing: options.showEasing, complete: options.onShown}
    );

    if (options.timeOut > 0) {
      intervalId = setTimeout(
          //TODO: should override be null?
          this.hideToast(null, options, $toastElement, intervalId, progressBar, response),
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
    if (this.el(':focus', $toastElement).length && !override) {
      return;
    }

    clearTimeout(progressBar.intervalId);

    return $toastElement[method]({
      duration: duration,
      easing: easing,
      complete: () => { //TODO: used arrow function to bind this
        this.removeToast($toastElement);
        clearTimeout(intervalId);
        if (options.onHidden && response.state !== 'hidden') {
          options.onHidden();
        }
        response.state = 'hidden';
        response.endTime = new Date();
        this.publish(response);
      }
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
    return $.extend({}, this.getDefaults(), this.toastr.options);
  }

  removeToast($toastElement) {
    if (!this.$container) { this.$container = this.getContainer(); }
    if ($toastElement.is(':visible')) {
      return;
    }
    $toastElement.remove();
    $toastElement = null;
    if (this.$container.children().length === 0) {
      this.$container.remove();
      this.previousToast = undefined;
    }
  }
}




// class Toast
// {
//     constructor() {
//         this.$container = null;
//         this.listener = null;
//         this.toastId = 0;
//         this.previousToast = undefined;
//         this.options = {};
//         this.toastType = {
//             error: 'error',
//             info: 'info',
//             success: 'success',
//             warning: 'warning',
//         };
//
//         // Initialize any existing toasts on page load
//         this.init();
//     }
//
//     init() {
//         const toasts = document.querySelectorAll('.toastr');
//
//         toasts.forEach(toastr => {
//             console.log('toast', toastr);
//
//             const toast = toastr.querySelector('.toast');
//             const progress = toast.querySelector('.toast-progress');
//             const title = toast.querySelector('.toast-title');
//             const message = toast.querySelector('.toast-message');
//
//             const type = this.getToastType(toast) ?? 'info';
//             const iconClass = this.getOptions().iconClasses[type];
//
// console.log('type', type);
//
//             this.$container = toast
//
//             this.notify({
//                 iconClass,
//                 type,
//                 message,
//                 title,
//             });
//         });
//     }
//
//     getToastType(element) {
//         if (element.classList.contains('toast-success')) return 'success';
//         if (element.classList.contains('toast-error')) return 'error';
//         if (element.classList.contains('toast-info')) return 'info';
//         if (element.classList.contains('toast-warning')) return 'warning';
//         return 'info'; // Default type
//     }
//
//     error(message, title, optionsOverride) {
//         return this.notify({
//             type: this.toastType.error,
//             iconClass: this.getOptions().iconClasses.error,
//             message,
//             optionsOverride,
//             title,
//         });
//     }
//
//     info(message, title, optionsOverride) {
//         return this.notify({
//             type: this.toastType.info,
//             iconClass: this.getOptions().iconClasses.info,
//             message,
//             optionsOverride,
//             title,
//         });
//     }
//
//     success(message, title, optionsOverride) {
//         return this.notify({
//             type: this.toastType.success,
//             iconClass: this.getOptions().iconClasses.success,
//             message,
//             optionsOverride,
//             title,
//         });
//     }
//
//     warning(message, title, optionsOverride) {
//         return this.notify({
//             type: this.toastType.warning,
//             iconClass: this.getOptions().iconClasses.warning,
//             message,
//             optionsOverride,
//             title,
//         });
//     }
//
//     notify(map) {
//         let options = this.getOptions();
//         let iconClass = map.iconClass || options.iconClass;
//         if (map.optionsOverride) {
//             options = Object.assign(options, map.optionsOverride);
//             iconClass = map.optionsOverride.iconClass || iconClass;
//         }
//         if (this.shouldExit(options, map)) return;
//
//         this.toastId++;
//         this.$container = this.getContainer(options, true);
//
//         let $toastElement = $('<div/>')
//             .addClass('toast')
//             .addClass(iconClass)
//             .append(`<div class="toast-title">${map.title || ''}</div>`)
//             .append(`<div class="toast-message">${map.message}</div>`)
//             .append(`<div class="toast-progress" style="width: 100%;"></div>`);
//
//         if (options.newestOnTop) {
//             this.$container.prepend($toastElement);
//         } else {
//             this.$container.append($toastElement);
//         }
//
//         setTimeout(() => this.removeToast($toastElement), options.timeOut);
//         return $toastElement;
//     }
//
//     removeToast($toastElement) {
//         if (!$toastElement) return;
//         $toastElement.fadeOut(500, () => $toastElement.remove());
//     }
//
//     getDefaults() {
//         return {
//             containerId: 'toast-container',
//             positionClass: 'toast-bottom-center',
//             iconClasses: {
//                 error: 'toast-error',
//                 info: 'toast-info',
//                 success: 'toast-success',
//                 warning: 'toast-warning',
//             },
//             timeOut: 5000,
//             closeOnHover: true,
//             preventDuplicates: false,
//         };
//     }
//
//     getOptions() {
//         return Object.assign({}, this.getDefaults(), this.options);
//     }
//
//     getContainer(options = this.getOptions(), create = false) {
//         this.$container = $('#' + options.containerId);
//         if (!this.$container.length && create) {
//             this.$container = this.createContainer(options);
//         }
//         return this.$container;
//     }
//
//     createContainer(options) {
//         this.$container = $('<div/>')
//             .attr('id', options.containerId)
//             .addClass(options.positionClass)
//             .appendTo($(options.target || 'body'));
//         return this.$container;
//     }
// }
//
// export default Toast;





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

  shouldExit(options, map) {
  if (options.preventDuplicates) {
    if (map.message === previousToast) {
      return true;
    } else {
      previousToast = map.message;
    }
  }
  return false;
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

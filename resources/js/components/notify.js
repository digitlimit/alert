import BaseComponent from '../shared/base-component.js'
import EventHandler from '../shared/dom/event-handler.js'
import { enableDismissTrigger } from '../shared/util/component-functions.js'
import { defineJQueryPlugin, reflow } from '../shared/util'

/**
 * Class definition
 */
class Notify extends BaseComponent
{
  static NAME = 'notify'
  static DATA_KEY = 'alert.notify'
  static EVENT_KEY = `.${Notify.DATA_KEY}`

  static EVENT_MOUSEOVER = `mouseover${Notify.EVENT_KEY}`
  static EVENT_MOUSEOUT = `mouseout${Notify.EVENT_KEY}`
  static EVENT_FOCUSIN = `focusin${Notify.EVENT_KEY}`
  static EVENT_FOCUSOUT = `focusout${Notify.EVENT_KEY}`
  static EVENT_HIDE = `hide${Notify.EVENT_KEY}`
  static EVENT_HIDDEN = `hidden${Notify.EVENT_KEY}`
  static EVENT_SHOW = `show${Notify.EVENT_KEY}`
  static EVENT_SHOWN = `shown${Notify.EVENT_KEY}`

  static CLASS_NAME_FADE = 'fade'
  static CLASS_NAME_HIDE = 'hide'
  static CLASS_NAME_SHOW = 'show'
  static CLASS_NAME_SHOWING = 'showing'

  static DefaultType = {
    animation: 'boolean',
    autohide: 'boolean',
    delay: 'number'
  }

  static Default = {
    animation: true,
    autohide: true,
    delay: 5000
  }

  constructor(element, config) {
    super(element, config)

    this._timeout = null
    this._hasMouseInteraction = false
    this._hasKeyboardInteraction = false
    this._setListeners()
  }

  // Getters
  static get Default() {
    return this.Default;
  }

  static get DefaultType() {
    return this.DefaultType;
  }

  static get NAME() {
    return this.NAME;
  }

  // Public
  show() {
    const showEvent = EventHandler.trigger(this._element, Notify.EVENT_SHOW)

    if (showEvent.defaultPrevented) {
      return
    }

    this._clearTimeout()

    if (this._config.animation) {
      this._element.classList.add(Notify.CLASS_NAME_FADE)
    }

    const complete = () => {
      this._element.classList.remove(Notify.CLASS_NAME_SHOWING)
      EventHandler.trigger(this._element, Notify.EVENT_SHOWN)

      this._maybeScheduleHide()
    }

    this._element.classList.remove(Notify.CLASS_NAME_HIDE) // @deprecated
    reflow(this._element)
    this._element.classList.add(Notify.CLASS_NAME_SHOW, Notify.CLASS_NAME_SHOWING)

    this._queueCallback(complete, this._element, this._config.animation)
  }

  hide() {
    if (!this.isShown()) {
      return
    }

    const hideEvent = EventHandler.trigger(this._element, Notify.EVENT_HIDE)

    if (hideEvent.defaultPrevented) {
      return
    }

    const complete = () => {
      this._element.classList.add(Notify.CLASS_NAME_HIDE) // @deprecated
      this._element.classList.remove(Notify.CLASS_NAME_SHOWING, Notify.CLASS_NAME_SHOW)
      EventHandler.trigger(this._element, Notify.EVENT_HIDDEN)
    }

    this._element.classList.add(Notify.CLASS_NAME_SHOWING)
    this._queueCallback(complete, this._element, this._config.animation)
  }

  dispose() {
    this._clearTimeout()

    if (this.isShown()) {
      this._element.classList.remove(Notify.CLASS_NAME_SHOW)
    }

    super.dispose()
  }

  isShown() {
    return this._element.classList.contains(Notify.CLASS_NAME_SHOW)
  }

  // Private

  _maybeScheduleHide() {
    if (!this._config.autohide) {
      return
    }

    if (this._hasMouseInteraction || this._hasKeyboardInteraction) {
      return
    }

    this._timeout = setTimeout(() => {
      this.hide()
    }, this._config.delay)
  }

  _onInteraction(event, isInteracting) {
    switch (event.type) {
      case 'mouseover':
      case 'mouseout': {
        this._hasMouseInteraction = isInteracting
        break
      }

      case 'focusin':
      case 'focusout': {
        this._hasKeyboardInteraction = isInteracting
        break
      }

      default: {
        break
      }
    }

    if (isInteracting) {
      this._clearTimeout()
      return
    }

    const nextElement = event.relatedTarget
    if (this._element === nextElement || this._element.contains(nextElement)) {
      return
    }

    this._maybeScheduleHide()
  }

  _setListeners() {
    EventHandler.on(this._element, Notify.EVENT_MOUSEOVER, event => this._onInteraction(event, true))
    EventHandler.on(this._element, Notify.EVENT_MOUSEOUT, event => this._onInteraction(event, false))
    EventHandler.on(this._element, Notify.EVENT_FOCUSIN, event => this._onInteraction(event, true))
    EventHandler.on(this._element, Notify.EVENT_FOCUSOUT, event => this._onInteraction(event, false))
  }

  _clearTimeout() {
    clearTimeout(this._timeout)
    this._timeout = null
  }

  // Static
  static jQueryInterface(config) {
    return this.each(function () {
      const data = Notify.getOrCreateInstance(this, config)

      if (typeof config === 'string') {
        if (typeof data[config] === 'undefined') {
          throw new TypeError(`No method named "${config}"`)
        }

        data[config](this)
      }
    })
  }
}

/**
 * Data API implementation
 */
enableDismissTrigger(Notify);

defineJQueryPlugin(Notify);

export default Notify;

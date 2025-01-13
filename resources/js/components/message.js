import BaseComponent from '../shared/base-component.js'
import EventHandler from '../shared/dom/event-handler.js'
import { enableDismissTrigger } from '../shared/util/component-functions.js'
import { defineJQueryPlugin } from '../shared/util'

/**
 * Class definition
 */
class Message extends BaseComponent {
  // Static properties
  static NAME = 'message'
  static DATA_KEY = 'alert.message'
  static EVENT_KEY = `.${Message.DATA_KEY}`
  static EVENT_CLOSE = `close${Message.EVENT_KEY}`
  static EVENT_CLOSED = `closed${Message.EVENT_KEY}`
  static CLASS_NAME_FADE = 'fade'
  static CLASS_NAME_SHOW = 'show'

  // Getters
  static get NAME() {
    return this.NAME
  }

  // Public
  close() {
    const closeEvent = EventHandler.trigger(this._element, Message.EVENT_CLOSE)

    if (closeEvent.defaultPrevented) {
      return
    }

    this._element.classList.remove(Message.CLASS_NAME_SHOW)

    const isAnimated = this._element.classList.contains(Message.CLASS_NAME_FADE)
    this._queueCallback(() => this._destroyElement(), this._element, isAnimated)
  }

  // Private
  _destroyElement() {
    this._element.remove()
    EventHandler.trigger(this._element, Message.EVENT_CLOSED)
    this.dispose()
  }

  // Static
  static jQueryInterface(config) {
    return this.each(function () {
      const data = Message.getOrCreateInstance(this)

      if (typeof config !== 'string') {
        return
      }

      if (data[config] === undefined || config.startsWith('_') || config === 'constructor') {
        throw new TypeError(`No method named "${config}"`)
      }

      data[config](this)
    })
  }
}

/**
 * Data API implementation
 */
enableDismissTrigger(Message, 'close');

/**
 * jQuery
 */
defineJQueryPlugin(Message);

export default Message;
import BaseComponent from '../shared/base-component.js'
import EventHandler from '../shared/dom/event-handler.js'
import { enableDismissTrigger } from '../shared/util/component-functions.js'
import { defineJQueryPlugin } from '../shared/util'

class Field extends BaseComponent {
  // Static properties
  static NAME = 'field'
  static DATA_KEY = 'alert.field'
  static EVENT_KEY = `.${Field.DATA_KEY}`
  static EVENT_CLOSE = `close${Field.EVENT_KEY}`
  static EVENT_CLOSED = `closed${Field.EVENT_KEY}`
  static CLASS_NAME_FADE = 'fade'
  static CLASS_NAME_SHOW = 'show'

  // Getters
  static get NAME() {
    return this.NAME
  }

  // Public
  close() {
    const closeEvent = EventHandler.trigger(this._element, Field.EVENT_CLOSE)

    if (closeEvent.defaultPrevented) {
      return
    }

    this._element.classList.remove(Field.CLASS_NAME_SHOW)

    const isAnimated = this._element.classList.contains(Field.CLASS_NAME_FADE)
    this._queueCallback(() => this._destroyElement(), this._element, isAnimated)
  }

  // Private
  _destroyElement() {
    this._element.remove()
    EventHandler.trigger(this._element, Field.EVENT_CLOSED)
    this.dispose()
  }

  // Static
  static jQueryInterface(config) {
    return this.each(function () {
      const data = Field.getOrCreateInstance(this)

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
enableDismissTrigger(Field, 'close');

/**
 * jQuery
 */
defineJQueryPlugin(Field);

export default Field;

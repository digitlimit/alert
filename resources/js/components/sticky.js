import BaseComponent from '../shared/base-component.js'
import EventHandler from '../shared/dom/event-handler.js'
import { enableDismissTrigger } from '../shared/util/component-functions.js'
import { defineJQueryPlugin } from '../shared/util'

class Sticky extends BaseComponent
{
  static NAME = 'sticky'
  static DATA_KEY = 'alert.sticky'
  static EVENT_KEY = `.${Sticky.DATA_KEY}`
  static EVENT_CLOSE = `close${Sticky.EVENT_KEY}`
  static EVENT_CLOSED = `closed${Sticky.EVENT_KEY}`
  static CLASS_NAME_FADE = 'fade'
  static CLASS_NAME_SHOW = 'show'

  // Getters
  static get NAME() {
    return this.NAME;
  }

  // Public
  close() {
    const closeEvent = EventHandler.trigger(this._element, Sticky.EVENT_CLOSE)

    if (closeEvent.defaultPrevented) {
      return
    }

    this._element.classList.remove(Sticky.CLASS_NAME_SHOW)

    const isAnimated = this._element.classList.contains(Sticky.CLASS_NAME_FADE)
    this._queueCallback(() => this._destroyElement(), this._element, isAnimated)
  }

  // Private
  _destroyElement() {
    this._element.remove()
    EventHandler.trigger(this._element, Sticky.EVENT_CLOSED)
    this.dispose()
  }

  // Static
  static jQueryInterface(config) {
    return this.each(function () {
      const data = Sticky.getOrCreateInstance(this)

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
enableDismissTrigger(Sticky, 'close')

/**
 * jQuery
 */
defineJQueryPlugin(Sticky);

export default Sticky;

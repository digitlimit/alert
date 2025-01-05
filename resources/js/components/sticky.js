import BaseComponent from '../shared/base-component.js'
import EventHandler from '../shared/dom/event-handler.js'
import { enableDismissTrigger } from '../shared/util/component-functions.js'
import { defineJQueryPlugin } from '../shared/util'

const NAME = 'sticky'
const DATA_KEY = 'alert.sticky'
const EVENT_KEY = `.${DATA_KEY}`
const EVENT_CLOSE = `close${EVENT_KEY}`
const EVENT_CLOSED = `closed${EVENT_KEY}`
const CLASS_NAME_FADE = 'fade'
const CLASS_NAME_SHOW = 'show'

class Sticky extends BaseComponent
{
  // Getters
  static get NAME() {
    return NAME
  }

  // Public
  close() {
    const closeEvent = EventHandler.trigger(this._element, EVENT_CLOSE)

    if (closeEvent.defaultPrevented) {
      return
    }

    this._element.classList.remove(CLASS_NAME_SHOW)

    const isAnimated = this._element.classList.contains(CLASS_NAME_FADE)
    this._queueCallback(() => this._destroyElement(), this._element, isAnimated)
  }

  // Private
  _destroyElement() {
    this._element.remove()
    EventHandler.trigger(this._element, EVENT_CLOSED)
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

defineJQueryPlugin(Sticky)

export default Sticky

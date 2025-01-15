import EventHandler from '../dom/event-handler.js'
import SelectorEngine from '../dom/selector-engine.js'
import Config from './config.js'

class FocusTrap extends Config
{
  static NAME = 'focustrap'
  static DATA_KEY = 'bs.focustrap'
  static EVENT_KEY = `.${FocusTrap.DATA_KEY}`
  static EVENT_FOCUSIN = `focusin${FocusTrap.EVENT_KEY}`
  static EVENT_KEYDOWN_TAB = `keydown.tab${FocusTrap.EVENT_KEY}`

  static TAB_KEY = 'Tab'
  static TAB_NAV_FORWARD = 'forward'
  static TAB_NAV_BACKWARD = 'backward'

  static Default = {
    autofocus: true,
    trapElement: null // The element to trap focus inside of
  }

  static DefaultType = {
    autofocus: 'boolean',
    trapElement: 'element'
  }

  constructor(config) {
    super()
    this._config = this._getConfig(config)
    this._isActive = false
    this._lastTabNavDirection = null
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
  activate() {
    if (this._isActive) {
      return
    }

    if (this._config.autofocus) {
      this._config.trapElement.focus()
    }

    EventHandler.off(document, FocusTrap.EVENT_KEY) // guard against infinite focus loop
    EventHandler.on(document, FocusTrap.EVENT_FOCUSIN, event => this._handleFocusin(event))
    EventHandler.on(document, FocusTrap.EVENT_KEYDOWN_TAB, event => this._handleKeydown(event))

    this._isActive = true
  }

  deactivate() {
    if (!this._isActive) {
      return
    }

    this._isActive = false
    EventHandler.off(document, FocusTrap.EVENT_KEY)
  }

  // Private
  _handleFocusin(event) {
    const { trapElement } = this._config

    if (event.target === document || event.target === trapElement || trapElement.contains(event.target)) {
      return
    }

    const elements = SelectorEngine.focusableChildren(trapElement)

    if (elements.length === 0) {
      trapElement.focus()
    } else if (this._lastTabNavDirection === FocusTrap.TAB_NAV_BACKWARD) {
      elements[elements.length - 1].focus()
    } else {
      elements[0].focus()
    }
  }

  _handleKeydown(event) {
    if (event.key !== FocusTrap.TAB_KEY) {
      return
    }

    this._lastTabNavDirection = event.shiftKey ? FocusTrap.TAB_NAV_BACKWARD : FocusTrap.TAB_NAV_FORWARD
  }
}

export default FocusTrap

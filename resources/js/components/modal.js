import BaseComponent from '../shared/base-component.js'
import EventHandler from '../shared/dom/event-handler.js'
import SelectorEngine from '../shared/dom/selector-engine.js'
import Backdrop from '../shared/util/backdrop.js'
import { enableDismissTrigger } from '../shared/util/component-functions.js'
import FocusTrap from '../shared/util/focustrap.js'
import {
  defineJQueryPlugin, isRTL, isVisible, reflow
} from '../shared/util'
import ScrollBarHelper from '../shared/util/scrollbar.js'

/**
 * Class definition
 */
class Modal extends BaseComponent
{
  static NAME = 'modal'
  static DATA_KEY = 'alert.modal'
  static EVENT_KEY = `.${Modal.DATA_KEY}`
  static DATA_API_KEY = '.data-api'
  static ESCAPE_KEY = 'Escape'

  static EVENT_HIDE = `hide${Modal.EVENT_KEY}`
  static EVENT_HIDE_PREVENTED = `hidePrevented${Modal.EVENT_KEY}`
  static EVENT_HIDDEN = `hidden${Modal.EVENT_KEY}`
  static EVENT_SHOW = `show${Modal.EVENT_KEY}`
  static EVENT_SHOWN = `shown${Modal.EVENT_KEY}`
  static EVENT_RESIZE = `resize${Modal.EVENT_KEY}`
  static EVENT_CLICK_DISMISS = `click.dismiss${Modal.EVENT_KEY}`
  static EVENT_MOUSEDOWN_DISMISS = `mousedown.dismiss${Modal.EVENT_KEY}`
  static EVENT_KEYDOWN_DISMISS = `keydown.dismiss${Modal.EVENT_KEY}`
  static EVENT_CLICK_DATA_API = `click${Modal.EVENT_KEY}${Modal.DATA_API_KEY}`

  static CLASS_NAME_OPEN = 'modal-open'
  static CLASS_NAME_FADE = 'fade'
  static CLASS_NAME_SHOW = 'show'
  static CLASS_NAME_STATIC = 'modal-static'

  static OPEN_SELECTOR = '.modal.show'
  static SELECTOR_DIALOG = '.modal-dialog'
  static SELECTOR_MODAL_BODY = '.modal-body'
  static SELECTOR_DATA_TOGGLE = '[data-bs-toggle="modal"]'

  static Default = {
    backdrop: true,
    focus: true,
    keyboard: true
  }

  static DefaultType = {
    backdrop: '(boolean|string)',
    focus: 'boolean',
    keyboard: 'boolean'
  }

  constructor(element, config) {
    super(element, config)

    this._dialog = SelectorEngine.findOne(Modal.SELECTOR_DIALOG, this._element)
    this._backdrop = this._initializeBackDrop()
    this._focustrap = this._initializeFocusTrap()
    this._isShown = false
    this._isTransitioning = false
    this._scrollBar = new ScrollBarHelper()

    this._addEventListeners()
  }

  // Getters
  static get Default() {
    return this.Default;
  }

  static get DefaultType() {
    return this.DefaultType
  }

  static get NAME() {
    return this.NAME;
  }

  // Public
  toggle(relatedTarget) {
    return this._isShown ? this.hide() : this.show(relatedTarget)
  }

  show(relatedTarget) {
    if (this._isShown || this._isTransitioning) {
      return
    }

    const showEvent = EventHandler.trigger(this._element, Modal.EVENT_SHOW, {
      relatedTarget
    })

    if (showEvent.defaultPrevented) {
      return
    }

    this._isShown = true
    this._isTransitioning = true

    this._scrollBar.hide()

    document.body.classList.add(Modal.CLASS_NAME_OPEN)

    this._adjustDialog()

    this._backdrop.show(() => this._showElement(relatedTarget))
  }

  hide() {
    if (!this._isShown || this._isTransitioning) {
      return
    }

    const hideEvent = EventHandler.trigger(this._element, Modal.EVENT_HIDE)

    if (hideEvent.defaultPrevented) {
      return
    }

    this._isShown = false
    this._isTransitioning = true
    this._focustrap.deactivate()

    this._element.classList.remove(Modal.CLASS_NAME_SHOW)

    this._queueCallback(() => this._hideModal(), this._element, this._isAnimated())
  }

  dispose() {
    EventHandler.off(window, Modal.EVENT_KEY)
    EventHandler.off(this._dialog, Modal.EVENT_KEY)

    this._backdrop.dispose()
    this._focustrap.deactivate()

    super.dispose()
  }

  handleUpdate() {
    this._adjustDialog()
  }

  // Private
  _initializeBackDrop() {
    return new Backdrop({
      isVisible: Boolean(this._config.backdrop), // 'static' option will be translated to true, and booleans will keep their value,
      isAnimated: this._isAnimated()
    })
  }

  _initializeFocusTrap() {
    return new FocusTrap({
      trapElement: this._element
    })
  }

  _showElement(relatedTarget) {
    // try to append dynamic modal
    if (!document.body.contains(this._element)) {
      document.body.append(this._element)
    }

    this._element.style.display = 'block'
    this._element.removeAttribute('aria-hidden')
    this._element.setAttribute('aria-modal', true)
    this._element.setAttribute('role', 'dialog')
    this._element.scrollTop = 0

    const modalBody = SelectorEngine.findOne(Modal.SELECTOR_MODAL_BODY, this._dialog)
    if (modalBody) {
      modalBody.scrollTop = 0
    }

    reflow(this._element)

    this._element.classList.add(Modal.CLASS_NAME_SHOW)

    const transitionComplete = () => {
      if (this._config.focus) {
        this._focustrap.activate()
      }

      this._isTransitioning = false
      EventHandler.trigger(this._element, Modal.EVENT_SHOWN, {
        relatedTarget
      })
    }

    this._queueCallback(transitionComplete, this._dialog, this._isAnimated())
  }

  _addEventListeners() {
    EventHandler.on(this._element, Modal.EVENT_KEYDOWN_DISMISS, event => {
      if (event.key !== Modal.ESCAPE_KEY) {
        return
      }

      if (this._config.keyboard) {
        this.hide()
        return
      }

      this._triggerBackdropTransition()
    })

    EventHandler.on(window, Modal.EVENT_RESIZE, () => {
      if (this._isShown && !this._isTransitioning) {
        this._adjustDialog()
      }
    })

    EventHandler.on(this._element, Modal.EVENT_MOUSEDOWN_DISMISS, event => {
      // a bad trick to segregate clicks that may start inside dialog but end outside, and avoid listen to scrollbar clicks
      EventHandler.one(this._element, Modal.EVENT_CLICK_DISMISS, event2 => {
        if (this._element !== event.target || this._element !== event2.target) {
          return
        }

        if (this._config.backdrop === 'static') {
          this._triggerBackdropTransition()
          return
        }

        if (this._config.backdrop) {
          this.hide()
        }
      })
    })
  }

  _hideModal() {
    this._element.style.display = 'none'
    this._element.setAttribute('aria-hidden', true)
    this._element.removeAttribute('aria-modal')
    this._element.removeAttribute('role')
    this._isTransitioning = false

    this._backdrop.hide(() => {
      document.body.classList.remove(Modal.CLASS_NAME_OPEN)
      this._resetAdjustments()
      this._scrollBar.reset()
      EventHandler.trigger(this._element, Modal.EVENT_HIDDEN)
    })
  }

  _isAnimated() {
    return this._element.classList.contains(Modal.CLASS_NAME_FADE)
  }

  _triggerBackdropTransition() {
    const hideEvent = EventHandler.trigger(this._element, Modal.EVENT_HIDE_PREVENTED)
    if (hideEvent.defaultPrevented) {
      return
    }

    const isModalOverflowing = this._element.scrollHeight > document.documentElement.clientHeight
    const initialOverflowY = this._element.style.overflowY
    // return if the following background transition hasn't yet completed
    if (initialOverflowY === 'hidden' || this._element.classList.contains(Modal.CLASS_NAME_STATIC)) {
      return
    }

    if (!isModalOverflowing) {
      this._element.style.overflowY = 'hidden'
    }

    this._element.classList.add(Modal.CLASS_NAME_STATIC)
    this._queueCallback(() => {
      this._element.classList.remove(Modal.CLASS_NAME_STATIC)
      this._queueCallback(() => {
        this._element.style.overflowY = initialOverflowY
      }, this._dialog)
    }, this._dialog)

    this._element.focus()
  }

  /**
   * The following methods are used to handle overflowing modals
   */
  _adjustDialog() {
    const isModalOverflowing = this._element.scrollHeight > document.documentElement.clientHeight
    const scrollbarWidth = this._scrollBar.getWidth()
    const isBodyOverflowing = scrollbarWidth > 0

    if (isBodyOverflowing && !isModalOverflowing) {
      const property = isRTL() ? 'paddingLeft' : 'paddingRight'
      this._element.style[property] = `${scrollbarWidth}px`
    }

    if (!isBodyOverflowing && isModalOverflowing) {
      const property = isRTL() ? 'paddingRight' : 'paddingLeft'
      this._element.style[property] = `${scrollbarWidth}px`
    }
  }

  _resetAdjustments() {
    this._element.style.paddingLeft = ''
    this._element.style.paddingRight = ''
  }

  // Static
  static jQueryInterface(config, relatedTarget) {
    return this.each(function () {
      const data = Modal.getOrCreateInstance(this, config)

      if (typeof config !== 'string') {
        return
      }

      if (typeof data[config] === 'undefined') {
        throw new TypeError(`No method named "${config}"`)
      }

      data[config](relatedTarget)
    })
  }
}

/**
 * Data API implementation
 */

EventHandler.on(document, Modal.EVENT_CLICK_DATA_API, Modal.SELECTOR_DATA_TOGGLE, function (event) {
  const target = SelectorEngine.getElementFromSelector(this)

  if (['A', 'AREA'].includes(this.tagName)) {
    event.preventDefault()
  }

  EventHandler.one(target, Modal.EVENT_SHOW, showEvent => {
    if (showEvent.defaultPrevented) {
      // only register focus restorer if modal will actually get shown
      return
    }

    EventHandler.one(target, Modal.EVENT_HIDDEN, () => {
      if (isVisible(this)) {
        this.focus()
      }
    })
  })

  // avoid conflict when clicking modal toggler while another one is open
  const alreadyOpen = SelectorEngine.findOne(Modal.OPEN_SELECTOR)
  if (alreadyOpen) {
    Modal.getInstance(alreadyOpen).hide()
  }

  const data = Modal.getOrCreateInstance(target)

  data.toggle(this)
})

enableDismissTrigger(Modal)

/**
 * jQuery
 */

defineJQueryPlugin(Modal)

export default Modal


import EventHandler from '../dom/event-handler.js'
import Config from './config.js'
import { execute } from './index.js'

class Swipe extends Config
{
  static NAME = 'swipe'
  static EVENT_KEY = '.bs.swipe'
  static EVENT_TOUCHSTART = `touchstart${Swipe.EVENT_KEY}`
  static EVENT_TOUCHMOVE = `touchmove${Swipe.EVENT_KEY}`
  static EVENT_TOUCHEND = `touchend${Swipe.EVENT_KEY}`
  static EVENT_POINTERDOWN = `pointerdown${Swipe.EVENT_KEY}`
  static EVENT_POINTERUP = `pointerup${Swipe.EVENT_KEY}`
  static POINTER_TYPE_TOUCH = 'touch'
  static POINTER_TYPE_PEN = 'pen'
  static CLASS_NAME_POINTER_EVENT = 'pointer-event'
  static SWIPE_THRESHOLD = 40

  static Default = {
    endCallback: null,
    leftCallback: null,
    rightCallback: null
  }

  static DefaultType = {
    endCallback: '(function|null)',
    leftCallback: '(function|null)',
    rightCallback: '(function|null)'
  }

  constructor(element, config) {
    super()
    this._element = element

    if (!element || !Swipe.isSupported()) {
      return
    }

    this._config = this._getConfig(config)
    this._deltaX = 0
    this._supportPointerEvents = Boolean(window.PointerEvent)
    this._initEvents()
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
  dispose() {
    EventHandler.off(this._element, Swipe.EVENT_KEY)
  }

  // Private
  _start(event) {
    if (!this._supportPointerEvents) {
      this._deltaX = event.touches[0].clientX

      return
    }

    if (this._eventIsPointerPenTouch(event)) {
      this._deltaX = event.clientX
    }
  }

  _end(event) {
    if (this._eventIsPointerPenTouch(event)) {
      this._deltaX = event.clientX - this._deltaX
    }

    this._handleSwipe()
    execute(this._config.endCallback)
  }

  _move(event) {
    this._deltaX = event.touches && event.touches.length > 1 ?
      0 :
      event.touches[0].clientX - this._deltaX
  }

  _handleSwipe() {
    const absDeltaX = Math.abs(this._deltaX)

    if (absDeltaX <= Swipe.SWIPE_THRESHOLD) {
      return
    }

    const direction = absDeltaX / this._deltaX

    this._deltaX = 0

    if (!direction) {
      return
    }

    execute(direction > 0 ? this._config.rightCallback : this._config.leftCallback)
  }

  _initEvents() {
    if (this._supportPointerEvents) {
      EventHandler.on(this._element, Swipe.EVENT_POINTERDOWN, event => this._start(event))
      EventHandler.on(this._element, Swipe.EVENT_POINTERUP, event => this._end(event))

      this._element.classList.add(Swipe.CLASS_NAME_POINTER_EVENT)
    } else {
      EventHandler.on(this._element, Swipe.EVENT_TOUCHSTART, event => this._start(event))
      EventHandler.on(this._element, Swipe.EVENT_TOUCHMOVE, event => this._move(event))
      EventHandler.on(this._element, Swipe.EVENT_TOUCHEND, event => this._end(event))
    }
  }

  _eventIsPointerPenTouch(event) {
    return this._supportPointerEvents
        && (event.pointerType === Swipe.POINTER_TYPE_PEN || event.pointerType === Swipe.POINTER_TYPE_TOUCH)
  }

  // Static
  static isSupported() {
    return 'ontouchstart' in document.documentElement || navigator.maxTouchPoints > 0
  }
}

export default Swipe

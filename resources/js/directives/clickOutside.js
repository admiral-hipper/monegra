/**
 * Example: v-click-outside="event => {}"
 *
 * or
 *
 * Example: v-click-outside="{
 *              callback: event => {}, // Trigger event
 *              delay: 1000, // Delay trigger event
 *              include: (el, event) => el.parentElement || [el, el, ...] // Click must be outside all included elements
 *          }"
 *
 * @param event: Event
 * @param el: HTMLElement
 * @param binding: ClickOutsideDirective
 * @param vNode: vNode
 */
function directive(event, el, binding, vNode) {
    // If click was triggered programmaticaly (domEl.click()) then
    // it shouldn't be treated as click-outside
    // Chrome/Firefox support isTrusted property
    // IE/Edge support pointerType property (empty if not triggered
    // by pointing device)
    if (('isTrusted' in event && !event.isTrusted) ||
        ('pointerType' in event && !event.pointerType)
    ) return;

    // Check if additional elements were passed to be included in check
    // (click must be outside all included elements, if any)
    let elements = (binding.args.include || (() => []))(el, event);

    if (!Array.isArray(elements)) {
        if (elements instanceof HTMLElement && elements.nodeType) {
            elements = [elements];
        }
    }

    // Add the root element for the component this directive was defined on
    elements.push(el);

    // Check if it's a click outside our elements, and then if our callback returns true.
    // Non-toggleable components should take action in their callback and return falsy.
    // Toggleable can return true if it wants to deactivate.
    // Note that, because we're in the capture phase, this callback will occur before
    // the bubbling click event on any outside elements.
    !elements.some(el => el.contains(event.target)) && setTimeout(() => {
        isVisible(el) && binding.args.callback && binding.args.callback(event);
    }, binding.args.delay || 0);
}

/**
 * @param el: HTMLElement
 * @param binding: ClickOutsideDirective
 * @param vNode: vNode
 */
function inserted(el, binding, vNode) {
    if (!binding.value || (
        typeof binding.value !== 'function'
        && typeof binding.value.callback !== 'function'
    )) {
        console.error(`[click-outside:] provided expression '${binding.expression}' is not a function - in component '${vNode.context.$options.name}'`);

        return;
    }

    if (typeof binding.value === 'object') {
        binding.args = {
            callback: binding.value.callback,
            delay: binding.value.delay,
            include: binding.value.include
        };
    } else {
        binding.args = {
            callback: binding.value
        };
    }

    const onClick = event => directive(event, el, binding, vNode);

    const app = document.body;

    app.addEventListener('click', onClick, true);

    el._clickOutside = onClick;
}

function unbind(el) {
    if (!el._clickOutside) return;

    const app = document.body;

    app && app.removeEventListener('click', el._clickOutside, true);

    delete el._clickOutside;
}

/**
 * @param el: HTMLElement
 * @returns {boolean}
 */
function isVisible(el) {
    const {display, visibility} = window.getComputedStyle(el);

    return (display !== 'none' && visibility !== 'hidden');
}

export const ClickOutside = {
    inserted,
    unbind
};

export default ClickOutside;

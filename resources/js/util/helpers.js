'use strict';

/**
 * Clone an array or object.
 *
 * @param payload: any
 * @returns {any}
 */
export function clone(payload) {
    return JSON.parse(JSON.stringify(payload));
}

/**
 * Copy string to clipboard.
 *
 * @param string
 */
export function copyToClipboard(string) {
    const fallback = string => {
        const textArea = document.createElement('textarea');
        textArea.value = string;

        /* Place in top-left corner of screen regardless of scroll position. */
        textArea.style.position = 'fixed';
        textArea.style.top = 0;
        textArea.style.left = 0;

        /**
         * Ensure it has a small width and height. Setting to 1px / 1em.
         * Doesn't work as this gives a negative w/h on some browsers.
         */
        textArea.style.width = '2em';
        textArea.style.height = '2em';

        /* We don't need padding, reducing the size if it does flash render. */
        textArea.style.padding = 0;

        /* Clean up any borders. */
        textArea.style.border = 'none';
        textArea.style.outline = 'none';
        textArea.style.boxShadow = 'none';

        /* Avoid flash of white box if rendered for any reason. */
        textArea.style.background = 'transparent';

        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            document.execCommand('copy');
        } catch (error) {
            console.error('[copyToClipboard]: Oops, unable to copy.\n', error);
        }

        document.body.removeChild(textArea);
    };

    if (!navigator.clipboard) {
        fallback(string);

        return;
    }

    navigator.clipboard
             .writeText(string)
             .catch(error => {
                 console.error('[copyToClipboard]: Oops, unable to copy.\n', error);
             });
}

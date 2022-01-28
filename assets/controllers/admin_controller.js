import { Controller } from 'stimulus';

export default class extends Controller {
    constructor() {
        super();
        this.test = '';
    }

    connect() {
        this.test = '';
        document.addEventListener('swup:contentReplaced', () => {
            window.initNav();
        });
    }

    disconnect() {
        this.element.removeEventListener('swup:connect', this.onConnect);
    }
}

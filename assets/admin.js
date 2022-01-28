/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/admin/admin.scss';

// start the Stimulus application
import './bootstrap';

window.bootstrap = require('bootstrap');

window.toggleNav = () => {
    document.getElementById('nav').classList.toggle('opened');
};
window.initNav = () => {
    document.querySelectorAll('.navbar-toggler').forEach((e) => {
        e.removeEventListener('click', window.toggleNav);
        e.addEventListener('click', window.toggleNav);
    });
};
document.addEventListener('DOMContentLoaded', () => {
    window.initNav();
});

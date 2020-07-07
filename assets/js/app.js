/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/whatToWatch.scss';
import '../css/home.scss';
import '../css/movies.scss';
import '../css/navbar.scss';
import '../css/content.scss';
import '../img/aventure.jpg';
import '../img/espace.jpg';
import '../img/gun.jpg';
import '../img/happy.jpg';
import '../img/horror.jpg';
import '../img/series.jpg';
import '../img/action.jpg';
import '../img/love.jpg';
import '../img/fantasy.jpg';
import '../img/combat-de-chat.jpg';
import '../img/triste.jpg';
import '../img/suspense.jpg';
import '../img/error-404.jpg';
import '../img/YouTube_23392.png';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

// app.js

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
});


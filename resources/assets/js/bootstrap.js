import Vue from 'vue';

window.Popper = require('popper.js/dist/umd/popper');
window.Bus = new Vue();

window._ = require('lodash');

window.Highcharts = require('highcharts');
Highcharts.setOptions({
    time: {
        timezone: window.settings.timezone
    }
});

/**
 * MomentJS
 */
moment.locale(window.settings.locale);

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

require('./http/bootstrap');
require('./http/socket');
require('./voice/bootstrap');

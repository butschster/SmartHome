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

    require('breakpoints-js');
    require('animsition');
    require('jquery-asScrollable');
    require('jquery-asScrollbar');
    require('jquery-mousewheel');
    require('../../../node_modules/jquery-asHoverScroll/dist/jquery-asHoverScroll.es');
    window.Tether = require('tether');
    window.screenfull = require('screenfull');

    require('bootstrap');
} catch (e) {}

require('./http/bootstrap');
require('./http/socket');
require('./voice/bootstrap');

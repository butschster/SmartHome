import Artyom from 'artyom.js';

// Create a variable that stores your instance
window.artyom = new Artyom();

let MobileDetect = require('mobile-detect');
let device = new MobileDetect(window.navigator.userAgent);

const isMobile = !_.isEmpty(device.mobile());

// Start the commands !
artyom.initialize({
    lang: "ru-RU",
    continuous: ! isMobile, // Listen forever
    //soundex: true,// Use the soundex algorithm to increase accuracy
    debug: window.settings.debug, // Show messages in the console
    listen: ! isMobile, // Start to listen commands !
}).then(() => {
    console.log("Artyom has been succesfully initialized");
}).catch((err) => {
    console.error("Artyom couldn't be initialized: ", err);
});
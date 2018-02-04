import Artyom from 'artyom.js';

// Create a variable that stores your instance
window.artyom = new Artyom();



// Start the commands !
artyom.initialize({
    lang: "ru-RU",
    continuous: true, // Listen forever
    soundex: true,// Use the soundex algorithm to increase accuracy
    debug: true, // Show messages in the console
    listen: true, // Start to listen commands !
}).then(() => {
    console.log("Artyom has been succesfully initialized");
}).catch((err) => {
    console.error("Artyom couldn't be initialized: ", err);
});
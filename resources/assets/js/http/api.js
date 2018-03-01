import * as commands from './api/commands';
import * as device from './api/device';
import * as device_property from './api/device_property';
import * as room from './api/room';
import * as weather from './api/weather';
import * as mqtt from './api/mqtt';
import * as xiaomi from './api/xiaomi';

export default (function () {

    const methods = {
        commands,
        device,
        device_property,
        room,
        weather,
        mqtt,
        xiaomi
    };

    class ApiMethods {
        constructor(methods) {
            for (let prop in methods) {
                this[prop] = (...params) => {
                    if (typeof methods[prop] == 'function') {
                        return methods[prop](...params);
                    }

                    return methods[prop];
                }
            }
        }
    }

    class Api {
        register(module, methods) {
            this[module] = () => new ApiMethods(methods);
        }
    }

    let response = new Api();
    for (let prop in methods) {
        response.register(prop, methods[prop]);
    }

    return new Proxy(response, {
        get(target, property) {
            if (typeof target[property] === 'undefined') {
                throw new Error(`Api method [${property}] not found`);
            }

            if (property == 'register') {
                return target[property];
            }

            try {
                return target[property]();
            } catch (e) {
                console.error(e.message);
            }
        },

        set(target, property, value, receiver) {

            if (typeof target[property] === 'undefined') {
                target[property] = value
                return true;
            }

            if (typeof target[property]() === 'object') {
                throw new Error('You can\'t override api methods');
            }

            return false;
        }
    });
})()
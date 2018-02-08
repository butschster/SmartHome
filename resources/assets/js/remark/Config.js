let values = {};

function get(...names) {
    let data = values;
    let callback = function (data, name) {
        return data[name];
    };

    for (let i = 0; i < names.length; i++) {
        let name = names[i];

        data = callback(data, name);
    }

    return data;
}

function set(name, value) {
    if (typeof name === 'string' && typeof value !== 'undefined') {
        values[name] = value;
    } else if (typeof name === 'object') {
        values = $.extend(true, {}, values, name);
    }
}

export {
    get,
    set
};

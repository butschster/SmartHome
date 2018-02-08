import Site from "../../js/remark/Site";

class Generator {

    generate(crumbs, name, params) {
        this.crumbs = crumbs;
        this.breadcrumbs = [];

        this.__call(name, params);

        let last = this.breadcrumbs.pop();
        last.last = true;

        this.breadcrumbs.push(last);

        return this.breadcrumbs;
    }

    __call(name, params) {
        if (!_.has(this.crumbs, name)) {
            throw new Error(`Breadcrumb not found with name [${name}]`);
        }

        this.crumbs[name](this, params);

        return this.breadcrumbs;
    }

    parent(name, params) {
        this.__call(name, params);
    }

    push(title, route) {
        this.breadcrumbs.push({
            title, route, last: false
        })
    }
}

class Breadcrumbs {

    constructor(generator) {
        this.generator = generator;
        this.crumbs = {};
    }

    register(name, callback) {
        this.crumbs[name] = callback;

        return this;
    }

    exists(name) {
        return _.has(this.crumbs, name);
    }

    generate(name, params) {
        return this.generator.generate(this.crumbs, name, params)
    }
}

let instance = null;

function getInstance() {
    if (!instance) {
        instance = new Breadcrumbs(new Generator);
    }

    return instance;
}

export default getInstance();
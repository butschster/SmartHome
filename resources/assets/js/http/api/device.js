import axios from 'axios';

/**
 * @returns {AxiosPromise<any>}
 */
export function list() {
    return axios.get('/api/devices');
}

/**
 *
 * @param {UUID} id
 * @returns {AxiosPromise<any>}
 */
export function show(id) {
    return axios.get(`/api/device/${id}`);
}

/**
 *
 * @param {UUID} id
 * @param {Object} data
 * @returns {AxiosPromise<any>}
 */
export function update(id, data) {
    return axios.post(`/api/device/${id}`, data);
}

/**
 *
 * @param {UUID} device
 * @returns {AxiosPromise<any>}
 */
export function properties(device) {
    return axios.get(`/api/device/${device}/properties`);
}

/**
 *
 * @param {UUID} property
 * @returns {AxiosPromise<any>}
 */
export function property(property) {
    return axios.get(`/api/device/property/${property}`);
}
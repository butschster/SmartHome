import axios from 'axios';

/**
 *
 * @param {UUID} device
 * @returns {AxiosPromise<any>}
 */
export function list(device) {
    return axios.get(`/api/device/${device}/properties`);
}

/**
 *
 * @param {UUID} property
 * @param {Object} params
 * @param {Object.from} string
 * @param {Object.to} string
 * @returns {AxiosPromise<any>}
 */
export function logs(property, params) {
    return axios.get(`/api/device/property/${property}/logs`, {params});
}

/**
 *
 * @param {UUID} property
 * @returns {AxiosPromise<any>}
 */
export function show(property) {
    return axios.get(`/api/device/property/${property}`);
}

/**
 * @param {UUID} property
 * @param {Object} data
 * @returns {AxiosPromise<any>}
 */
export function update(property, data) {
    return axios.post(`/api/device/property/${property}`, data);
}

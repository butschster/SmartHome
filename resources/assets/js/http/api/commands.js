import axios from 'axios';

/**
 *
 * @param command
 * @param text
 * @returns {AxiosPromise<any>}
 */
export function fromSpech(command, text) {
    return axios.post(`/api/invoke/spech`, {command, text});
}

/**
 * @param {UUID} propertyId
 * @param {string} command
 * @returns {AxiosPromise<any>}
 */
export function invoke(propertyId, command, parameters) {
    return axios.post(`/api/invoke/${propertyId}/${command}`, {parameters});
}

/**
 *
 * @returns {AxiosPromise<any>}
 */
export function triggers() {
    return axios.get(`/api/spech/triggers`);
}
import axios from 'axios';

/**
 *
 * @param {Object} params
 * @returns {AxiosPromise<any>}
 */
export function logs(params) {
    return axios.get(`/api/xiaomi/logs`, {params});
}


/**
 * @returns {AxiosPromise<any>}
 */
export function gateways() {
    return axios.get('/api/xiaomi/gateways');
}


/**
 * @param {uuid} id
 * @returns {AxiosPromise<any>}
 */
export function gateway(id) {
    return axios.get(`/api/xiaomi/gateway/${id}`);
}


/**
 * @param {uuid} id
 * @returns {AxiosPromise<any>}
 */
export function gatewayDevices(id) {
    return axios.get(`/api/xiaomi/gateway/${id}/devices`);
}

/**
 * @param {uuid} id
 * @returns {AxiosPromise<any>}
 */
export function updateGateway(id, data) {
    return axios.post(`/api/xiaomi/gateway/${id}`, data);
}

/**
 * @param {uuid} id
 * @returns {AxiosPromise<any>}
 */
export function destroyGateway(id) {
    return axios.delete(`/api/xiaomi/gateway/${id}`);
}
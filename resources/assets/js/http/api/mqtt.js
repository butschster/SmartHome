import axios from 'axios';

/**
 *
 * @param {Object} params
 * @returns {AxiosPromise<any>}
 */
export function logs(params) {
    return axios.get(`/api/mqtt/logs`, {params});
}

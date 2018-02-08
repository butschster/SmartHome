import axios from 'axios';

/**
 * @returns {AxiosPromise<any>}
 */
export function current() {
    return axios.get('/api/weather/current');
}
import axios from 'axios';

/**
 * @returns {AxiosPromise<any>}
 */
export function list() {
    return axios.get('/api/rooms');
}

/**
 *
 * @param {UUID} id
 * @returns {AxiosPromise<any>}
 */
export function show(id) {
    return axios.get(`/api/room/${id}`);
}

/**
 * @returns {AxiosPromise<any>}
 */
export function store(data) {
    return axios.post(`/api/room`, data);
}

/**
 * @param {uuid} id
 * @returns {AxiosPromise<any>}
 */
export function update(id, data) {
    return axios.post(`/api/room/${id}`, data);
}

/**
 * @param {uuid} id
 * @returns {AxiosPromise<any>}
 */
export function destroy(id) {
    return axios.delete(`/api/room/${id}`);
}
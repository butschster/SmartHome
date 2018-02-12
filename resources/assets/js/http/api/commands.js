import axios from 'axios';


/**
 * @param {UUID} propertyId
 * @param {string} command
 * @returns {AxiosPromise<any>}
 */
export function handleDeviceCommand(propertyId, command, parameters) {
    return axios.post(`/api/device/handle/${propertyId}/${command}`, {parameters});
}

/**
 *
 * @param command
 * @param text
 * @returns {AxiosPromise<any>}
 */
export function voiceCommand(command, text) {
    return axios.post(`/api/voice/command`, {command, text});
}

/**
 *
 * @returns {AxiosPromise<any>}
 */
export function voiceCommands() {
    return axios.get(`/api/voice/commands`);
}
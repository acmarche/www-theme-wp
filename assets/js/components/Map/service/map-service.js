import axios from '../../Axios';

/**
 * @param {string|null} keyword
 * @returns {Promise}
 */
export function loadKml( keyword ) {
    const params = {};

    const url = `wp-json/map/kml/${keyword}`;

    return axios.get( url, {
        params
    });
}

/**
 * @returns {Promise}
 */
export function filtres() {
    const url = 'wp-json/map/filtres';

    return axios.get( url, {

    });
}

import axios from '../../Axios';

/**
 * @param {string|null} keyword
 * @returns {Promise}
 */
export function searchElastic( keyword ) {
    const params = {};

    const url = `wp-json/search/search/${keyword}`;

    return axios.get( url, {
        params
    });
}

/**
 * @param {string|null} keyword
 * @returns {Promise}
 */
export function suggestElastic( keyword ) {
    const params = {};

    const url = `wp-json/search/suggest/${keyword}`;

    return axios.get( url, {
        params
    });
}

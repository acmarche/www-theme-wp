import axios from '../../Axios';

/**
 * @param {string|null} keyword
 * @returns {Promise}
 */
export function searchElastic( keyword ) {
    const params = {};

    const url = `wp-json/search/v1/search/${keyword}`;

    return axios.get( url, {
        params
    });
}

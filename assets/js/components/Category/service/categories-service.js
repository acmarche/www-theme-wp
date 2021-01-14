import axios from '../../Axios';

/**
 * @param {string|null} siteSlug
 * @param {int|null} mainCategoryId
 * @returns {Promise}
 */
export function fetchCategories( siteSlug, mainCategoryId ) {
    const params = {};

    if ( mainCategoryId ) {
        params.parent = mainCategoryId;
    }

    params._fields = 'name, id, description';
    params.per_page = 100;

    const url = `${siteSlug}wp-json/wp/v2/categories`;

    return axios.get( url, {
        params
    });
}

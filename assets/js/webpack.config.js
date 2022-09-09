const defaults = require( '@wordpress/scripts/config/webpack.config' );
const path = require( 'path' );

module.exports = {
    ...defaults,
    mode: 'production',
    entry: {
        category: [
            `${path.resolve( __dirname, 'src' )}/category.js`
        ],
        search: [
            `${path.resolve( __dirname, 'src' )}/search.js`
        ],
        map: [
            `${path.resolve( __dirname, 'src' )}/map.js`
        ],
        searchScreen: [
            `${path.resolve( __dirname, 'src' )}/searchScreen.js`
        ],
        searchScreenHome: [
            `${path.resolve( __dirname, 'src' )}/searchScreenHome.js`
        ],
        notificationPermission: [
            `${path.resolve( __dirname, 'src' )}/notificationPermission.js`
        ]
    },
    externals: {
        react: 'React',
        'react-dom': 'ReactDOM'
    }
};

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
        agenda: [
            `${path.resolve( __dirname, 'src' )}/agenda.js`
        ]
    },
    externals: {
        react: 'React',
        'react-dom': 'ReactDOM'
    }
};

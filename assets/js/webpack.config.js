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
        ],
        searchScreen: [
            `${path.resolve( __dirname, 'src' )}/searchScreen.js`
        ],
        searchScreenHome: [
            `${path.resolve( __dirname, 'src' )}/searchScreenHome.js`
        ]
    },
    externals: {
        react: 'React',
        'react-dom': 'ReactDOM'
    },
    module: {
        rules: [ {
            loader: 'babel-loader',
            exclude: /node_modules/
        } ]
    }
};

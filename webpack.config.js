const path = require('path');

module.exports = {
    entry: './admin/js/block.js',
    output: {
        path: path.resolve(__dirname, 'admin/js/dist'),
        filename: 'block.js'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env', '@babel/preset-react']
                    }
                }
            }
        ]
    },
    externals: {
        react: 'React',
        'react-dom': 'ReactDOM',
        '@wordpress/blocks': ['wp', 'blocks'],
        '@wordpress/editor': ['wp', 'editor'],
        '@wordpress/block-editor': ['wp', 'blockEditor'],
        '@wordpress/element': ['wp', 'element'],
        '@wordpress/components': ['wp', 'components'],
        '@wordpress/i18n': ['wp', 'i18n']
    }
};

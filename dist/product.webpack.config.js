var path = require('path');
var webpack = require('webpack');

module.exports = {
    entry: [
        './product.js'
    ],
    output: {
        path: __dirname,
        filename: '../js/product.js',
        libraryTarget: 'var',
        library: 'productTips'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: /node_modules/
            }]
    },
    externals: {
        jquery: "$"
    }
};

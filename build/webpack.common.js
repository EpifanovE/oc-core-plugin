const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');

const isDev = process.env.NODE_ENV === 'development';

module.exports = {
    entry: {
        'core': [
            '@babel/polyfill',
            path.resolve(__dirname, '../src/js/core.js')
        ],
        'admin': [
            '@babel/polyfill',
            path.resolve(__dirname, '../src/js/admin.js')
        ],
    },
    output: {
        path: path.resolve(__dirname, '../assets'),
        filename: 'js/[name].min.js'
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx)$/,
                resolve: {extensions: [".js", ".jsx"]},
                loader: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            '@babel/preset-env'
                        ]
                    }
                },
                exclude: /node_modules/
            },
            {
                test: /\.(sass|scss)$/,
                include: path.resolve(__dirname, '../src/scss'),
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            hmr: isDev,
                            sourceMap: isDev,
                        },
                    },
                    {
                        loader: "css-loader",
                        options: {
                            sourceMap: isDev,
                            url: false
                        }
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            plugins: () => [
                                require('autoprefixer')
                            ],
                            sourceMap: isDev
                        }
                    },
                    {
                        loader: "sass-loader",
                        options: {
                            sourceMap: isDev,
                        }
                    }

                ],
            },
            {
                test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: '[name].[ext]',
                        outputPath: 'fonts'
                    }
                }]
            },
        ]
    },
    plugins: [
    	new CleanWebpackPlugin(),
        new CopyPlugin([
            {
                from: path.resolve(__dirname, '../node_modules/@fortawesome/fontawesome-free/webfonts'),
                to: path.resolve(__dirname, '../assets/fonts')
            },
            {
                from: path.resolve(__dirname, '../src/img'),
                to: path.resolve(__dirname, '../assets/img')
            }
        ]),
        new MiniCssExtractPlugin({
            filename: 'css/[name].min.css',
        }),
    ],
    watchOptions: {
        poll: true,
        aggregateTimeout: 100
    },
    performance: {
        hints: false
    },
    externals: {
        $: 'jQuery',
        jQuery: 'jQuery',
    },
};
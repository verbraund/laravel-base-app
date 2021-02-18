const mix = require('laravel-mix');
//const { styles } = require( '@ckeditor/ckeditor5-dev-utils' );

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.react('resources/assets/admin/js/index.js', 'public/js/admin')
    .sass('resources/assets/admin/style/index.sass', 'public/css/admin');

//
//mix.override(function (webpackConfig) {
//    webpackConfig.module.rules.push({
//        oneOf: [
//            {
//                test: /ckeditor5-[^/\\]+[/\\]theme[/\\]icons[/\\][^/\\]+\.svg$/,
//                use: [ 'raw-loader' ]
//            },
//            {
//                test: /ckeditor5-[^/\\]+[/\\]theme[/\\].+\.css$/,
//                use: [
//                    {
//                        loader: 'style-loader',
//                        options: {
//                            injectType: 'singletonStyleTag',
//                            singleton: true,
//
//                        }
//                    },
//                    {
//                        loader: 'postcss-loader',
//                        options: styles.getPostCssConfig( {
//                            themeImporter: {
//                                themePath: require.resolve( '@ckeditor/ckeditor5-theme-lark' )
//                            },
//                            minify: true
//                        } )
//                    }
//                ]
//            },
//            {
//                loader: require.resolve( 'file-loader' ),
//                // Exclude `js` files to keep the "css" loader working as it injects
//                // its runtime that would otherwise be processed through the "file" loader.
//                // Also exclude `html` and `json` extensions so they get processed
//                // by webpack's internal loaders.
//                exclude: [
//                    /\.(js|mjs|jsx|ts|tsx)$/,
//                    /\.html$/,
//                    /\.json$/,
//                    /ckeditor5-[^/\\]+[/\\]theme[/\\]icons[/\\][^/\\]+\.svg$/,
//                    /ckeditor5-[^/\\]+[/\\]theme[/\\].+\.css$/
//                ],
//                options: {
//                    name: 'static/media/[name].[hash:8].[ext]',
//                }
//            },
//
//
//        ]
//    });
//
//    return webpackConfig;
//});

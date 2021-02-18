const mix = require('laravel-mix');
const { styles } = require( '@ckeditor/ckeditor5-dev-utils' );
const CKEditorWebpackPlugin = require( '@ckeditor/ckeditor5-dev-webpack-plugin' );

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


Mix.listen('configReady', function(config) {
    const rules = config.module.rules;
    const cssExt = '.css';
    const cssExclude = /ckeditor5-[^/\\]+[/\\]theme[/\\].+\.css$/;
    const svgExt = '.svg';
    const svgExclude = /ckeditor5-[^/\\]+[/\\]theme[/\\]icons[/\\][^/\\]+\.svg$/;

    for (let rule of rules) {
        if (rule.test) {
            if((rule.test.toString()).indexOf(cssExt) + 1){

                if(rule.hasOwnProperty('exclude')){
                    if(Array.isArray(rule.exclude)){
                        rule.exclude.push(cssExclude);
                    }else{
                        let tmp = rule.exclude;
                        rule.exclude = [tmp, cssExclude]
                    }
                }else{
                    rule.exclude = [cssExclude];
                }
            }

            if ((rule.test.toString()).indexOf(svgExt) + 1) {
                if(rule.hasOwnProperty('exclude')){
                    if(Array.isArray(rule.exclude)){
                        rule.exclude.push(svgExclude);
                    }else{
                        let tmp = rule.exclude;
                        rule.exclude = [tmp, svgExclude]
                    }
                }else{
                    rule.exclude = [svgExclude];
                }
            }
        }
    }
});

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
//                            attributes: {
//                                'data-cke': true
//                            }
//                        }
//                    },
//                    {
//                        loader: 'postcss-loader',
//                        options: styles.getPostCssConfig({
//                            themeImporter: {
//                                themePath: require.resolve( '@ckeditor/ckeditor5-theme-lark' )
//                            },
//                            minify: true
//                        })
//                    },
//                ]
//            }
//        ]
//    });
//    //console.log(webpackConfig.module.rules);
//
//    return webpackConfig;
//});


mix.webpackConfig({
    module: {
        rules: [
            {
                oneOf: [
                    {
                        test: /ckeditor5-[^/\\]+[/\\]theme[/\\]icons[/\\][^/\\]+\.svg$/,
                        use: [ 'raw-loader' ]
                    },
                    {
                        test: /ckeditor5-[^/\\]+[/\\]theme[/\\].+\.css$/,
                        use: [
                            {
                                loader: 'style-loader',
                                options: {
                                    injectType: 'singletonStyleTag',
                                    attributes: {
                                        'data-cke': true
                                    }
                                }
                            },
                            {
                                loader: 'postcss-loader',
                                options: styles.getPostCssConfig({
                                    themeImporter: {
                                        themePath: require.resolve( '@ckeditor/ckeditor5-theme-lark' )
                                    },
                                    minify: true
                                })
                            }
                        ]
                    }
                ]
            }
        ]
    },
    plugins: [

        new CKEditorWebpackPlugin( {
            language: 'ru',
            addMainLanguageTranslationsToAllAssets: true
        } )
    ]
});
const mix = require('laravel-mix');

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

const TerserPlugin = require('terser-webpack-plugin');

const IS_PRODUCTION = mix.inProduction();

/**
 * Для предотвращения удаления активных ассетов в момент компиляции
 *
 * @type {{path: *}}
 */
const supplementToOutput = IS_PRODUCTION
    ? {path: path.resolve(__dirname, './public/js/dist')}
    : {};

mix
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .webpackConfig({
        output: {
            publicPath: '/',
            filename: '[name].js',
            chunkFilename: 'js/chunks/[name].bundle.js?id=[chunkhash]',
            sourceMapFilename: '[name].map?id=[hash:8]',
            chunkLoadTimeout: 120000,
            ...supplementToOutput
        },
        resolve: {
            unsafeCache: true,
            modules: ['node_modules'],
            extensions: [
                '*',
                '.js',
                '.jsx',
                '.json',
                '.vue',
                '.css',
                '.scss',
                '.sass'
            ]
        },
        optimization: {
            removeEmptyChunks: true,
            mergeDuplicateChunks: false,
            providedExports: true,
            namedModules: true,
            namedChunks: true,
            nodeEnv: process.env.NODE_ENV,
            minimize: IS_PRODUCTION,
            splitChunks: {
                chunks: 'async',
                minSize: 10000,
                minChunks: 1,
                maxAsyncRequests: Infinity,
                automaticNameDelimiter: '~',
                automaticNameMaxLength: 109,
                maxInitialRequests: Infinity,
                name: true,
                cacheGroups: {
                    default: {
                        reuseExistingChunk: true,
                        minChunks: 2,
                        priority: -20
                    },
                    vendors: {
                        automaticNamePrefix: 'vendors',
                        test: /[\\\/]node_modules[\\\/]/,
                        priority: -10
                    }
                }
            },
            minimizer: !IS_PRODUCTION
                ? []
                : [
                    new TerserPlugin({
                        cache: true,
                        parallel: true,
                        sourceMap: false,
                        extractComments: false,
                        terserOptions: {
                            mangle: true
                        }
                    })
                ]
        }
    });

if (IS_PRODUCTION) {
    mix.version();
}

//
// Шаблон личного кабинета пользователя AdminMart
//
// AdminMart (https://www.adminmart.com/) — шаблон, который используется в личном кабинете,
// ниже копируются нужные для него сбилденные css, js, картинки.
// ```
// npm run dev
// ```
//
// Если нужно изменить стили или например переопределить цветовую тему с помощью переменных scss,
// то нужно перейти в resources/html-templates/adminmart и выполнить:
// ```
// npm install
// gulp watch
// ```
//
mix
    .copyDirectory('resources/html-templates/adminmart/src/dist', 'public/adminmart/dist')
    .copyDirectory('resources/html-templates/adminmart/src/assets', 'public/adminmart/assets');

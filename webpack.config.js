// Imports from node_modules
const Encore = require('@symfony/webpack-encore');
const path = require('path');
const PurgeCssPlugin = require('purgecss-webpack-plugin');
const glob = require('glob-all');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

// Config to be used only for production
if (Encore.isProduction()) {
    Encore
        // Enables hashed filenames (e.g. app.abc123.css)
        .enableVersioning()
        // Copies the images to the build folder
        .copyFiles({
            from: './assets/images',
            to: 'images/[path][name].[hash:8].[ext]',
            pattern: /\.(gif|png|jpe?g|svg)$/i,
        })
        // Minify image in order to reduce the size
        .addLoader({
            test: /\.(gif|png|jpe?g|svg)$/i,
            loader: 'image-webpack-loader',
            options: {
                mozjpeg: {
                    progressive: true,
                    quality: 50,
                },
                pngquant: {
                    quality: [0.5, 0.5],
                },
                webp: {
                    quality: 75,
                },
            },
        })
        // Add PurgeCssPlugin to remove unused CSS
        .addPlugin(
            new PurgeCssPlugin({
                paths: glob.sync([
                    path.join(__dirname, 'templates/**/*.html.twig'),
                    path.join(__dirname, 'assets/js/**/*.js'),
                    path.join(__dirname, 'assets/css/**/*.css'),
                ]),
                only: ['build', 'vendor'],
            }),
        );
}
// Config to be used only for development
else if (Encore.isDev()) {
    Encore
        // Add sources maps for debugging.
        .enableSourceMaps()
        // Copies the images to the build folder
        .copyFiles({
            from: './assets/images',
            to: 'images/[path][name].[ext]',
            pattern: /\.(gif|png|jpe?g|svg)$/i,
        });
}

Encore
    // Directory where compiled assets will be stored.
    .setOutputPath('public/build/')
    // Public path used by the web server to access the output path.
    .setPublicPath('/build')
    // Add 1 entry for each "page" of your app.
    .addEntry('index', './assets/js/index.js')
    .addEntry('cart', './assets/js/cart.js')
    // Add 1 entry for emails of your app.
    .addEntry('foundation', './assets/js/foundation.js')
    // Add 1 entry for categories views.
    .addEntry('categories', './assets/js/categories.js')
    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()
    // Helps Webpack do it's job for multiple entry files.
    .enableSingleRuntimeChunk()
    // Removes the old files before building the new ones.
    .cleanupOutputBeforeBuild()
    // Displays notifications.
    .enableBuildNotifications()
    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
    // Enables and loads PostCSS
    .enablePostCssLoader((options) => {
        options.config = {
            path: 'postcss.config.js',
        };
    })
    // Reduce the number of HTTP requests inlining small files as base64 encoded URLs in the generated CSS files.
    // Uses file-loader as a default fallback if the bytes limit has been exceeded
    .configureUrlLoader({
        fonts: { limit: 4096 },
        images: { limit: 4096 },
    })
    // Fix [object Module] url error for images
    .configureLoaderRule('images', (loaderRule) => {
        loaderRule.options.esModule = false;
    });

module.exports = Encore.getWebpackConfig();

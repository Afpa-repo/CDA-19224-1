const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // Directory where compiled assets will be stored.
    .setOutputPath('public/build/')
    // Public path used by the web server to access the output path.
    .setPublicPath('/build')
    // Add 1 entry for each "page" of your app.
    .addEntry('index', './assets/js/index.js')
    // Add 1 entry for emails of your app.
    .addEntry('foundation', './assets/js/foundation.js')
    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()
    // Helps Webpack do it's job for multiple entry files.
    .enableSingleRuntimeChunk()
    // Removes the old files before building the new ones.
    .cleanupOutputBeforeBuild()
    // Displays notifications.
    .enableBuildNotifications()
    // Add sources maps for debugging.
    .enableSourceMaps(!Encore.isProduction())
    // Enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())
    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv(config => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
    // Enables and loads PostCSS
    .enablePostCssLoader(options => {
        options.config = {
            path: 'postcss.config.js'
        };
    })
    // Reduce the number of HTTP requests inlining small files as base64 encoded URLs in the generated CSS files.
    // Uses file-loader as a default fallback if the bytes limit has been exceeded
    .configureUrlLoader({
        fonts: {limit: 4096},
        images: {limit: 4096},
    })
    // Copies the images to the build folder
    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[hash:8].[ext]',
        pattern: /\.(png|jpg|jpeg)$/
    })
    // Fix [object Module] url error for images
    .configureLoaderRule('images', loaderRule => {
        loaderRule.options.esModule = false;
    });

module.exports = Encore.getWebpackConfig();

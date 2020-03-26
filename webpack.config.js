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
    .addEntry('app', './assets/js/app.js')
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
    // Gets integrity="..." attributes on your script & link tags
    .enableIntegrityHashes(Encore.isProduction())
    // Enables and loads PostCSS
    .enablePostCssLoader(options => {
        options.config = {
            path: 'postcss.config.js'
        }
    })
;

module.exports = Encore.getWebpackConfig();

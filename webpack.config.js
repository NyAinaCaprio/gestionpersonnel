var Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // répertoire où les actifs compilés seront stockés
    .setOutputPath('public/build/')
    // chemin public utilisé par le serveur Web pour accéder au chemin de sortie
    .setPublicPath('/build')
    // nécessaire uniquement pour le déploiement de CDN ou de sous-répertoires
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Ajoutez 1 entrée pour chaque "page" de votre application
     * (y compris celui qui est inclus sur chaque page - par exemple "application")
     *
     *Chaque entrée se traduira par un fichier JavaScript (par exemple app.js)
     * et un fichier CSS (par exemple app.css) si votre JavaScript importe CSS
     */
    .addEntry('app', './assets/js/app.js')
    //.addEntry('page1', './assets/js/page1.js')
    //.addEntry('page2', './assets/js/page2.js')

    // Lorsqu'il est activé, Webpack "divise" vos fichiers en morceaux plus petits pour une meilleure optimisation.
    .splitEntryChunks()

    // nécessitera une balise de script supplémentaire pour runtime.js
    // mais, vous le voulez probablement, sauf si vous créez une application d'une seule page
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Activez et configurez les autres fonctionnalités ci-dessous. Pour un plein
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    // enables Sass/SCSS support
    //.enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()

    // uncomment if you use API Platform Admin (composer req api-admin)
    //.enableReactPreset()
    //.addEntry('admin', './assets/js/admin.js')
;

var config = Encore.getWebpackConfig();
config.externals.jquery = 'jQuery'

module.exports = config

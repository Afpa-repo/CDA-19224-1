// Plugins to use only in development
const developmentPlugins = [
    require('stylelint')()
];

// Plugins to use whatever the env is
const generalPlugins = [
    require('postcss-preset-env')({stage: 3}),
    require('postcss-font-magician')({display: 'swap'}),
    require('postcss-reporter')({clearReportedMessages: true})
];

// Plugins to use only in production
const productionPlugins = [
    require('cssnano')({preset: 'default'}),
];

// Exports the postcss config depending on NODE_ENV
if (process.env.NODE_ENV === 'production') {
    module.exports = {
        plugins: [
            ...generalPlugins,
            ...productionPlugins
        ]
    }
} else {
    module.exports = {
        plugins: [
            ...developmentPlugins,
            ...generalPlugins
        ]
    }
}
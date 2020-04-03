module.exports = {
    plugins: [
        require('stylelint')({
            extends: ['stylelint-config-standard'],
            rules: {indentation: 4}
        }),
        require('postcss-preset-env')({stage: 3}),
        require('postcss-font-magician')({display: 'swap'}),
        require('cssnano')({preset: 'default'}),
        require('postcss-reporter')({clearReportedMessages: true})
    ]
};

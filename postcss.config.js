module.exports = {
    plugins: [
        require('stylelint')({
            extends: ['stylelint-config-standard'],
            rules: {indentation: 4}
        }),
        require('postcss-font-magician')({display: 'swap'}),
        require('autoprefixer')(),
        require('cssnano')({preset: 'default'}),
        require('postcss-reporter')({clearReportedMessages: true})
    ]
};

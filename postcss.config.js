module.exports = {
    plugins: [
        require('stylelint')({
            extends: ['stylelint-config-standard'],
            rules: {indentation: 8}
        }),
        require('autoprefixer')(),
        require('cssnano')({preset: 'default'}),
        require('postcss-reporter')({clearReportedMessages: true})
    ]
};
module.exports = {
    plugins: {
        autoprefixer: {},
        cssnano: {
            preset: 'default'
        },
        'postcss-reporter': {
            clearReportedMessages: true
        }
    }
};
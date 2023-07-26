export default {
    plugins: {
        autoprefixer: {},
        cssnano: {},
        "@fullhuman/postcss-purgecss": {
             content: ['resources/views/**/*']
        },
    }
}

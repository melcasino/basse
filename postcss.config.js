const postcssPlugins = [
    require('postcss-preset-env')({
        features: {
            'custom-properties': true,
        },
    }),
];

if (process.env.NODE_ENV === 'production') {
    postcssPlugins.push(
        require('postcss-discard-comments')({
            //removeAll: false, // Keep all block comments.
            removeAllButFirst: true // Keep first block comment and delete the rest.
        }),
    );
}

module.exports = {
    plugins: postcssPlugins,
};
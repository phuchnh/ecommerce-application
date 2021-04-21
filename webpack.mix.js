const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .copyDirectory('resources/cpanel/vendor', 'public/cpanel/vendor')
  .js('resources/cpanel/js/app.js', 'public/cpanel/js')
  .vue()
  .postCss('resources/cpanel/css/app.css', 'public/cpanel/css', [
    require('postcss-import'),
    require('autoprefixer'),
  ])
  .babelConfig({
    plugins: ['@babel/plugin-syntax-dynamic-import'],
  })
  .webpackConfig(require('./webpack.config'))
  .extract(['vue'])
  .sourceMaps();

if (mix.inProduction()) {
  mix.version();
}

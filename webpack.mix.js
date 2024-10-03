const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// app
mix.styles(
  [
    "node_modules/tabler-ui/dist/assets/css/dashboard.css",
    "node_modules/tabler-ui/dist/assets/plugins/charts-c3/plugin.css",
    "node_modules/flatpickr/dist/flatpickr.css",
    "resume_assets/builder.min.css",
    "css/customize.css",
  ],
  "css/app.bundle.css"
);

mix.scripts(
  [
    "node_modules/tabler-ui/src/assets/js/vendors/jquery-3.2.1.min.js",
    "node_modules/tabler-ui/src/assets/js/vendors/bootstrap.bundle.min.js",
    "node_modules/tabler-ui/src/assets/js/vendors/selectize.min.js",
    "node_modules/flatpickr/dist/flatpickr.js",
    "node_modules/flatpickr/dist/l10n/ru.js",
    "node_modules/flatpickr/dist/l10n/pt.js",
    "node_modules/flatpickr/dist/l10n/tr.js",
    "resume_assets/builder.min.js",
    "resume_assets/sweetalert.js",
  ],
  "js/app.bundle.js"
);

mix.copyDirectory("node_modules/tabler-ui/dist/assets/fonts", "fonts");

var gulp        = require('gulp'),
    browserSync = require('browser-sync'),
    concat      = require('gulp-concat'),
    sass        = require('gulp-sass'),
    jshint      = require('gulp-jshint');
    uglify      = require('gulp-uglify');
    rename      = require('gulp-rename');
    shell       = require('gulp-shell');

    base_theme_path = '../zurb_foundation';

    sassOptions = { outputStyle: 'compressed', sourcemap: 'none'};

    jsLibs = [
      // base_theme_path + '/js/vendor/placeholder.js',
      // base_theme_path + '/js/vendor/fastclick.js'
      'js/jquery.waypoints.min.js'
      // 'js/svg4everybody.min.js'
    ];

    jsFoundation = [
      base_theme_path + '/js/foundation/foundation.js',
      base_theme_path + '/js/foundation/foundation.abide.js',
      // base_theme_path + '/js/foundation/foundationaccordion.js',
      base_theme_path + '/js/foundation/foundation.alert.js',
      base_theme_path + '/js/foundation/foundation.clearing.js',
      // base_theme_path + '/js/foundation/foundation.dropdown.js',
      // base_theme_path + '/js/foundation/foundation.equalizer.js',
      // base_theme_path + '/js/foundation/foundation.interchange.js',
      // base_theme_path + '/js/foundation/foundation.joyride.js',
      // base_theme_path + '/js/foundation/foundation.magellan.js',
      // base_theme_path + '/js/foundation/foundation.offcanvas.js',
      // base_theme_path + '/js/foundation/foundation.orbit.js',
      // base_theme_path + '/js/foundation/foundation.reveal.js',
      // base_theme_path + '/js/foundation/foundation.slider.js',
      // base_theme_path + '/js/foundation/foundation.tab.js',
      // base_theme_path + '/js/foundation/foundation.tooltip.js',
      base_theme_path + '/js/foundation/foundation.topbar.js'
    ];

    jsApp = [
      'js/_*.js'
    ];


// Launch the Server
 gulp.task('browser-sync', ['lint','sass', 'scripts'], function() {
 browserSync.init({
   // Change as required
  open:  'external',
  host:  'aubriehill.dev',
  proxy: 'aubriehill.dev',
  port:  3000

  /*socket: {
       // For local development only use the default Browsersync local URL.
       // domain: 'localhost:3000'
       // For external development (e.g on a mobile or tablet) use an external URL.
       // You will need to update this to whatever BS tells you is the external URL when you run Gulp.
       //domain: '192.168.0.13:3000'
   }*/
 });
});


// @task sass
// Compile files from scss
gulp.task('sass', function () {
  return gulp.src('scss/*.scss')
        .pipe(sass(sassOptions).on('error', sass.logError))
        .pipe(gulp.dest('css'))
        .pipe(browserSync.reload({stream:true}));
});

// @task lint
// Check js for errors
gulp.task('lint', function() {
    return gulp.src('js/_*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'))
        .pipe(browserSync.reload({stream:true}));
});

// @task scripts
// Concatenate & Minify JS
gulp.task('scripts', function() {
    return gulp.src(jsLibs.concat(jsFoundation).concat('js/_*.js'))
        .pipe(concat('all.js'))
        .pipe(gulp.dest('js'))
        .pipe(rename('all.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('js'));
});


// @task clearcache
// Clear all caches
gulp.task('clearcache', function() {
  return shell.task([
    'drush cc all'
  ]);
});

// @task reload
// Refresh the page after clearing cache
gulp.task('refresh', ['clearcache'], function () {
  browserSync.reload();
});


// @task watch
// Watch scss files for changes & recompile Clear cache when Drupal related files are changed
gulp.task('watch', function () {
  gulp.watch(['scss/*.scss', 'scss/**/*.scss'], ['sass']);
  gulp.watch(jsApp, ['lint', 'scripts']);
  gulp.watch('**/*.{php,inc,info}',['refresh']);
});

// Default task, running just `gulp` will compile Sass files, launch BrowserSync & watch files.
gulp.task('default', ['browser-sync', 'watch']);
/**
 * ThreePM Block Controller build scripts.
 */

// Declare gulp libraries.
const gulp       = require( 'gulp' ),
      babel      = require( 'gulp-babel' )
      browserify = require( 'browserify' ),
      buffer     = require( 'vinyl-buffer' ),
      clean      = require( 'gulp-clean-css' ),
      rename     = require( 'gulp-rename' ),
      sass       = require( 'gulp-sass' ),
      source     = require( 'vinyl-source-stream' ),
      uglify     = require( 'gulp-uglify' );

// JS editor build task.
gulp.task( 'js-editor', () => {
  return browserify( { entries: [ 'block-controller/source/js/disable-blocks.js' ] } )
    .transform( 'babelify', { presets: [ 'es2015', 'react' ] } )
    .bundle()
    .pipe( source( 'block-controller-editor.min.js' ) )
    .pipe( buffer() )
    .pipe( uglify() )
    .pipe( gulp.dest( 'block-controller/build' ) );
} );

// JS admin build task.
gulp.task( 'js-admin', () => {
  return browserify( { entries: [ 'block-controller/source/js/settings-page.js' ] } )
    .transform( 'babelify', { presets: [ 'es2015' ] } )
    .bundle()
    .pipe( source( 'block-controller-admin.min.js' ) )
    .pipe( buffer() )
    .pipe( uglify() )
    .pipe( gulp.dest( 'block-controller/build' ) );
} );

// CSS build task.
gulp.task( 'css', () => {
  return gulp.src( 'block-controller/source/scss/block-controller.scss' )
    .pipe( sass().on( 'error', sass.logError ) )
    .pipe( clean() )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( gulp.dest( 'block-controller/build' ) );
} );

// Default task.
gulp.task( 'default', gulp.series( 'js-editor', 'js-admin', 'css' ) );

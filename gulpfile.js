/**
 * ThreePM Block Controller build scripts.
 */

// Declare gulp libraries.
const gulp       = require( 'gulp' ),
      browserify = require( 'browserify' ),
      buffer     = require( 'vinyl-buffer' ),
      concat     = require( 'gulp-concat' ),
      sass       = require( 'gulp-sass' ),
      sassLint   = require( 'gulp-sass-lint' ),
      source     = require( 'vinyl-source-stream' ),
      uglify     = require( 'gulp-uglify' );


// Build editor JS files.
function jsEditorTask( done ) {
  return browserify( { entries: [ 'block-controller/source/js/disable-blocks.js' ] } )
    .transform( 'babelify', { presets: [ '@babel/preset-env', '@babel/preset-react' ] } )
    .bundle()
    .pipe( source( 'block-controller-editor.min.js' ) )
    .pipe( buffer() )
    .pipe( uglify() )
    .pipe( gulp.dest( 'block-controller/build' ) );
}


// Build admin JS files.
function jsAdminTask( done ) {
  return browserify( { entries: [ 'block-controller/source/js/settings-page.js' ] } )
    .transform( 'babelify', { presets: [ '@babel/preset-env', '@babel/preset-react' ] } )
    .bundle()
    .pipe( source( 'block-controller-admin.min.js' ) )
    .pipe( buffer() )
    .pipe( uglify() )
    .pipe( gulp.dest( 'block-controller/build' ) );
};


// Build CSS files.
function cssTask( done ) {
  return gulp.src( 'block-controller/source/scss/block-controller.scss' )
    .pipe( sass( { outputStyle: 'compressed' } ) )
    .pipe( gulp.dest( 'block-controller/build' ) );
};


// Build everything.
function buildTask( done ) {
  jsEditorTask( done );
  jsAdminTask( done );
  cssTask( done );
  done();
}


// Tasks.
gulp.task( 'jsEditor', jsEditorTask );
gulp.task( 'jsAdmin', jsAdminTask );
gulp.task( 'css', cssTask );
gulp.task( 'default', buildTask );

const gulp       = require( 'gulp' ),
      babel      = require( 'gulp-babel' )
      browserify = require( 'browserify' ),
      buffer     = require( 'vinyl-buffer' ),
      source     = require( 'vinyl-source-stream' ),
      uglify     = require( 'gulp-uglify' );

// Array of JS files, in order by dependency.
const jsFiles = [
  'source/js/block/index.js'
];

// JS build task.
gulp.task( 'js', () => {
  return browserify( { entries: jsFiles } )
    .transform( 'babelify', { presets: [ 'es2015', 'react' ] } )
    .bundle()
    .pipe( source( 'block-controller.min.js' ) )
    .pipe( buffer() )
    .pipe( uglify() )
    .pipe( gulp.dest( 'build' ) );
} );

// Default task.
gulp.task( 'default', 'js' );

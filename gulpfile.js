/**
 * Gulp Modules.
 */
var gulp = require('gulp');
var less = require('gulp-less');
var path = require('path');
var del  = require('del');

/**
 * Set path to resources directory.
 */
var resources = './resources/';

/**
 * Remove old generated content.
 */
gulp.task('clean', function(cb) {
    del([resources + 'dist', resources + 'css'], cb);
});

/**
 * Compile LESS stylesheets to CSS.
 */
gulp.task('less', function () {
  gulp.src(resources + 'less/default.less')
    .pipe(less({
      paths: [ path.join(__dirname, 'less', 'includes') ]
    }))
    .pipe(gulp.dest(resources + 'dist'));
    gulp.src(resources + 'fonts/*').pipe(gulp.dest(resources + 'dist/'));
});

/**
 * Default Gulp Task.
 */
gulp.task('default', ['clean'], function() {
    gulp.start('less');
});

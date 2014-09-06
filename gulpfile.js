/**
 * Gulp Modules.
 */
var gulp    = require('gulp');
var less    = require('gulp-less');
var path    = require('path');
var del     = require('del');
var cssmin  = require('gulp-cssmin')

/**
 * Set path to resources directory.
 */
var resources = './resources/';

/**
 * Remove old generated content.
 */
gulp.task('clean', function(cb) {
    del(['public/*'], cb);
});

/**
 * Compile LESS stylesheets to CSS.
 */
gulp.task('less', function () {
  gulp.src(resources + 'less/default.less')
    .pipe(less({
      paths: [ path.join(__dirname, 'less', 'includes') ]
    }))
    .pipe(cssmin().on('error', function(err) {
        console.log(err);
    }))
    .pipe(gulp.dest('public/'));
    gulp.src(resources + 'fonts/*').pipe(gulp.dest('public/fonts/'));
    gulp.src(resources + 'img/*').pipe(gulp.dest('public/img/'));
});

/**
 * Move static assets.
 */
gulp.task('move', function () {
    gulp.src(resources + 'fonts/*').pipe(gulp.dest('public/fonts/'));
    gulp.src(resources + 'img/*').pipe(gulp.dest('public/img/'));
});

/**
 * Default Gulp Task.
 */
gulp.task('default', ['clean'], function() {
    gulp.start('less', 'move');
});

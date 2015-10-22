var gulp = require('gulp');
var rename = require("gulp-rename");
var sass = require('gulp-sass');
var minifyCss = require('gulp-minify-css');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');

// JAVASCRIPT
gulp.task('compress', function() {
  return gulp.src('js/*.js')
    .pipe(uglify())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('./build/js/'));
});

// SASS
gulp.task('sass', function () {
  gulp.src('./sass/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.init())
    .pipe(minifyCss())
    .pipe(sourcemaps.write())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('./build/css'));
});

// Watch
gulp.task('js:watch', function () {
  gulp.watch('./js/**/*.js', ['compress']);
});

gulp.task('sass:watch', function () {
  gulp.watch('./sass/**/*.scss', ['sass']);
});

// GLOBAL
gulp.task('default', ['compress', 'sass']);
gulp.task('watch', ['default','js:watch', 'sass:watch']);

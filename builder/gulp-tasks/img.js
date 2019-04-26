var gulp     = require('gulp');
var notify   = require('gulp-notify');
var imagemin = require('gulp-imagemin');
var plumber  = require('gulp-plumber');
var path     = require('./path.js');
var wait;


gulp.task('img', (done) => {
	var onError = function(err) {
		notify.onError({
			title:    "Gulp",
			subtitle: "Failure!",
			message:  "Error: <%= error.message %>",
			sound:    "Beep"
		})(err);
		this.emit('end');
	};
	return gulp.src(path + '/src/img/**/*')
		.pipe(imagemin())
		.pipe(gulp.dest(path + '/dist/images'));
	done();
});

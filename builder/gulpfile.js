var gulp    = require('gulp');
var plumber = require('gulp-plumber');
var notify  = require('gulp-notify');
var myPath  = require('./gulp-tasks/path.js');

const gulpRequireTasks = require('gulp-require-tasks');
// Invoke the module with options.
gulpRequireTasks({

  // Specify path to your tasks directory.
  path: process.cwd() + '/gulp-tasks' // This is default!

});

gulp.task('run', gulp.parallel('sass', 'scripts', 'img', 'copy') );
gulp.task('default', (done) => {
    gulp.watch(myPath + "/src/scss/**/*.scss", gulp.series('sass'));
    gulp.watch(myPath + "/src/js/**/*.js", gulp.series('scripts'));
    gulp.watch([myPath + "/src/img/**/*.*"], gulp.series('img'));
    done();
});

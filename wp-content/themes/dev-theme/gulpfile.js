// Variables //
// First of all change theme name
var themeName = 'theme';
var buildDir  = '../' + themeName + '/';

// plugins for development
var gulp = require('gulp'),
	rimraf = require('rimraf'),
	sass = require('gulp-sass'),
	inlineimage = require('gulp-inline-image'),
	prefix = require('gulp-autoprefixer'),
	plumber = require('gulp-plumber'),
	dirSync = require('gulp-directory-sync'),
	browserSync = require('browser-sync').create(),
	concat = require('gulp-concat'),
	cssfont64 = require('gulp-cssfont64'),
	sourcemaps = require('gulp-sourcemaps'),
	postcss = require('gulp-postcss'),
	assets  = require('postcss-assets');

// plugins for build
var purify = require('gulp-purifycss'),
	uglify = require('gulp-uglify'),
	imagemin = require('gulp-imagemin'),
	pngquant = require('imagemin-pngquant'),
	csso = require('gulp-csso');

//----------------------------------------------------Compiling
gulp.task('sass', function () {
	gulp.src(['sass/**/*.scss', '!' + 'sass/**/_*.scss'])
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(inlineimage())
		.pipe(prefix('last 3 versions'))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('styles/'))
		.pipe(browserSync.stream());
});

gulp.task('fontsConvert', function () {
	return gulp.src(['fonts/*.woff', 'fonts/*.woff2'])
		.pipe(cssfont64())
		.pipe(gulp.dest('styles/'))
		.pipe(browserSync.stream());
});

gulp.task('php', function() {
	return gulp.src(['**/*.php', '!' + buildDir + '**/*.php'])
		.pipe(browserSync.stream());
});

gulp.task('js', function() {
	return gulp.src(['js/**/*.js'])
		.pipe(browserSync.stream());
});
//----------------------------------------------------Compiling###

//watching files and run tasks
gulp.task('watch', function () {
	gulp.watch('sass/**/*.scss', ['sass']);
	gulp.watch('js/**/*.js', ['js']);
	gulp.watch('**/*.php', ['php']);
});

//livereload and open project in browser
gulp.task('browser-sync', function () {
	var files = [
		'style.css',
		'js/**/*.js',
		'**/*.php'
	];
	browserSync.init({
		proxy: "localhost:8888/wp.dev/"
		//notify: false
	});
});

gulp.task('cssLint', function () {
	return gulp.src(['sass/**/*.scss', '!' + 'sass/templates/*.scss'])
		.pipe(postcss(
			[
				stylelint(),
				reporter({ clearMessages: true })
			],
			{
				syntax: postcss_scss
			}
		));
});

//---------------------------------building final project folder
//clean build folder
gulp.task('cleanBuildDir', function (cb) {
	rimraf(buildDir, cb);
});

//minify images
gulp.task('imgBuild', function () {
	return gulp.src('i/**/*')
		.pipe(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngquant()]
		}))
		.pipe(gulp.dest(buildDir + 'i/'))
});

//copy fonts
gulp.task('fontsBuild', function () {
	return gulp.src('fonts/**/*.*')
		.pipe(gulp.dest(buildDir + 'fonts/'))
});

//copy and minify js
gulp.task('jsBuild', function () {
	return gulp.src('js/**/*')
		.pipe(uglify())
		.pipe(gulp.dest(buildDir + 'js/'))
});

//copy, minify css
gulp.task('cssBuild', function () {
	return gulp.src('styles/**/*')
		.pipe(purify(['js/**/*']))
		.pipe(csso())
		.pipe(gulp.dest(buildDir + 'styles/'))
});

//copy theme files
gulp.task('copyFiles', function () {
	return gulp.src(['**/*.php', 'acf-json/**'])
		.pipe(gulp.dest(buildDir))
});
//---------------------------------------------

gulp.task('default', ['php', 'sass', 'js', 'watch', 'browser-sync']);

gulp.task('build', ['cleanBuildDir'], function () {
	gulp.start('imgBuild', 'fontsBuild', 'jsBuild', 'cssBuild', 'copyFiles');
});
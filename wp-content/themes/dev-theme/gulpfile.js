// Variables //
// First of all change theme name and proxy
var themeName = 'theme',
		assetsDir = 'assets/',
		buildDir  = '../' + themeName + '/',
		proxy     = 'localhost:8888/wp.dev/';

// plugins for development
var gulp      = require('gulp'),
	rimraf      = require('rimraf'),
	sass        = require('gulp-sass'),
	inlineimage = require('gulp-inline-image'),
	prefix      = require('gulp-autoprefixer'),
	plumber     = require('gulp-plumber'),
	dirSync     = require('gulp-directory-sync'),
	browserSync = require('browser-sync').create(),
	concat      = require('gulp-concat'),
	cssfont64   = require('gulp-cssfont64'),
	sourcemaps  = require('gulp-sourcemaps'),
	postcss     = require('gulp-postcss'),
	assets      = require('postcss-assets'),
	svgsprite   = require('gulp-svg-sprite'),
	svgmin      = require('gulp-svgmin'),
	cheerio     = require('gulp-cheerio'),
	replace     = require('gulp-replace');

// plugins for build
var purify    = require('gulp-purifycss'),
	uglify      = require('gulp-uglify'),
	imagemin    = require('gulp-imagemin'),
	pngquant    = require('imagemin-pngquant'),
	csso        = require('gulp-csso');

//----------------------------------------------------Compiling
gulp.task('sass', function () {
	gulp.src([assetsDir + 'sass/**/*.scss', '!' + assetsDir + 'sass/**/_*.scss'])
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

gulp.task('jsConcat', function () {
	return gulp.src(assetsDir + 'js/all/**/*.js')
			.pipe(concat('all.js', {newLine: ';'}))
			.pipe(gulp.dest('js/'))
			.pipe(browserSync.stream());
});

gulp.task('js', function() {
	return gulp.src(['js/**/*.js'])
		.pipe(browserSync.stream());
});
//----------------------------------------------------Compiling###

//--------------------------------------------SVG sprite
gulp.task('svgSpriteBuild', function () {
	return gulp.src(assetsDir + 'i/icons/*.svg')
	// minify svg
			.pipe(svgmin({
				js2svg: {
					pretty: true
				}
			}))
			// remove all fill and style declarations in out shapes
			.pipe(cheerio({
				run: function ($) {
					$('[fill]').removeAttr('fill');
					$('[stroke]').removeAttr('stroke');
					$('[style]').removeAttr('style');
				},
				parserOptions: {xmlMode: true}
			}))
			// cheerio plugin create unnecessary string '&gt;', so replace it.
			.pipe(replace('&gt;', '>'))
			// build svg sprite
			.pipe(svgsprite({
				mode: {
					symbol: {
						sprite: '../sprite.svg',
						render: {
							scss: {
								dest: '../../../'+ assetsDir +'/sass/_sprite.scss',
								template: assetsDir + 'sass/templates/_sprite_template.scss'
							}
						},
						example: true
					}
				}
			}))
			.pipe(gulp.dest('i/sprite/'));
});
//---------------------------------------------SVG sprite###


//watching files and run tasks
gulp.task('watch', function () {
	gulp.watch(assetsDir + 'sass/**/*.scss', ['sass']);
	gulp.watch(assetsDir + 'js/**/*.js', ['js']);
});

//livereload and open project in browser
gulp.task('browser-sync', function () {
	var files = [
		'style.css',
		'styles/main_global.css',
		'js/**/*.js'
	];
	browserSync.init({
		proxy: proxy
		//notify: false
	});
});

gulp.task('cssLint', function () {
	return gulp.src([assetsDir + 'sass/**/*.scss', '!' + assetsDir + 'sass/templates/*.scss'])
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
	return gulp.src(assetsDir + 'i/**/*')
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
gulp.task('copyPHPFiles', function () {
	return gulp.src('**/*.php')
		.pipe(gulp.dest(buildDir))
});

gulp.task('copyACFJson', function () {
	return gulp.src('acf-json/**')
			.pipe(gulp.dest(buildDir + 'acf-json/'))
});

gulp.task('copySVGFiles', function () {
	return gulp.src(['i/icons/**/*.svg', 'i/sprite/**'])
			.pipe(gulp.dest(buildDir + 'i/'))
});
//---------------------------------------------

gulp.task('default', ['sass', 'jsConcat', 'js', 'watch', 'browser-sync']);

gulp.task('build', ['cleanBuildDir'], function () {
	gulp.start('imgBuild', 'fontsBuild', 'jsBuild', 'cssBuild', 'copyPHPFiles' ,'copyACFJson', 'copySVGFiles');
});
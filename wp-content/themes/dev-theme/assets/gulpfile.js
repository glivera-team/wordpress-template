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

//plugins for testing
//var html5Lint = require('gulp-html5-lint');
var reporter = require('postcss-reporter');
var stylelint = require('stylelint');
var postcss_scss = require("postcss-scss");

//var assetsDir = '';
var outputDir = '../';
var buildDir  = '../build/';

//----------------------------------------------------Compiling
gulp.task('sass', function () {
	gulp.src(['sass/**/*.scss', '!' + 'sass/**/_*.scss'])
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(inlineimage())
		.pipe(prefix('last 3 versions'))
		.pipe(postcss([assets({
			basePath:outputDir,
			loadPaths: ['i/']
		})]))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(outputDir + 'styles/'))
		.pipe(browserSync.stream());
});

gulp.task('jsConcat', function () {
	return gulp.src('js/all/**/*.js')
		.pipe(concat('all.js', {newLine: ';'}))
		.pipe(gulp.dest(outputDir + 'js/'))
		.pipe(browserSync.stream());
});

gulp.task('fontsConvert', function () {
	return gulp.src(['fonts/*.woff', 'fonts/*.woff2'])
		.pipe(cssfont64())
		.pipe(gulp.dest(outputDir + 'styles/'))
		.pipe(browserSync.stream());
});

gulp.task('php', function() {
	return gulp.src('../**/*.php')
		.pipe(browserSync.stream());
});
//----------------------------------------------------Compiling###

//-------------------------------------------------Synchronization
gulp.task('imageSync', function () {
	return gulp.src('')
		.pipe(plumber())
		.pipe(dirSync('i/', outputDir + 'i/', {printSummary: true}))
		.pipe(browserSync.stream());
});

gulp.task('fontsSync', function () {
	return gulp.src('')
		.pipe(plumber())
		.pipe(dirSync('fonts/', outputDir + 'fonts/', {printSummary: true}))
		.pipe(browserSync.stream());
});

gulp.task('jsSync', function () {
	return gulp.src('js/*.js')
		.pipe(plumber())
		.pipe(gulp.dest(outputDir + 'js/'))
		.pipe(browserSync.stream());
});
//-------------------------------------------------Synchronization###


//watching files and run tasks
gulp.task('watch', function () {
	gulp.watch('sass/**/*.scss', ['sass']);
	gulp.watch('js/**/*.js', ['jsSync']);
	gulp.watch('js/all/**/*.js', ['jsConcat']);
	gulp.watch('i/**/*', ['imageSync']);
	gulp.watch('fonts/**/*', ['fontsSync', 'fontsConvert']);
	gulp.watch('../**/*.php', ['php']);
});

//livereload and open project in browser
gulp.task('browser-sync', function () {
	var files = [
		'./style.css',
		'./js/**/*.js',
		'./**/*.php'
	];
	browserSync.init({
		proxy: "localhost:8888/wp.dev/",
		//notify: false
	});
});


//---------------------------------building final project folder
//clean build folder
gulp.task('cleanBuildDir', function (cb) {
	rimraf(buildDir, cb);
});


//minify images
gulp.task('imgBuild', function () {
	return gulp.src(outputDir + 'i/**/*')
		.pipe(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngquant()]
		}))
		.pipe(gulp.dest(buildDir + 'i/'))
});

//copy fonts
gulp.task('fontsBuild', function () {
	return gulp.src(outputDir + 'fonts/**/*')
		.pipe(gulp.dest(buildDir + 'fonts/'))
});

//copy and minify js
gulp.task('jsBuild', function () {
	return gulp.src(outputDir + 'js/**/*')
		.pipe(uglify())
		.pipe(gulp.dest(buildDir + 'js/'))
});

//copy, minify css
gulp.task('cssBuild', function () {
	return gulp.src(outputDir + 'styles/**/*')
		.pipe(purify([outputDir + 'js/**/*', outputDir + '**/*.html']))
		.pipe(csso())
		.pipe(gulp.dest(buildDir + 'styles/'))
});


//// --------------------------------------------If you need iconfont
// var iconfont = require('gulp-iconfont'),
// 	iconfontCss = require('gulp-iconfont-css'),
// 	fontName = 'iconfont';
// gulp.task('iconfont', function () {
// 	gulp.src(['i/icons/*.svg'])
// 		.pipe(iconfontCss({
// 			path: 'assets/sass/templates/_icons_template.scss',
// 			fontName: fontName,
// 			targetPath: '../../sass/_icons.scss',
// 			fontPath: '../fonts/icons/',
// 			svg: true
// 		}))
// 		.pipe(iconfont({
// 			fontName: fontName,
// 			svg: true,
// 			formats: ['svg','eot','woff','ttf']
// 		}))
// 		.pipe(gulp.dest('assets/fonts/icons'));
// });

//--------------------------------------------If you need svg sprite
// var svgSprite = require('gulp-svg-sprite'),
// 	svgmin = require('gulp-svgmin'),
// 	cheerio = require('gulp-cheerio'),
// 	replace = require('gulp-replace');
//
// gulp.task('svgSpriteBuild', function () {
// 	return gulp.src('i/icons/*.svg')
// 	// minify svg
// 		.pipe(svgmin({
// 			js2svg: {
// 				pretty: true
// 			}
// 		}))
// 		// remove all fill and style declarations in out shapes
// 		.pipe(cheerio({
// 			run: function ($) {
// 				$('[fill]').removeAttr('fill');
// 				$('[stroke]').removeAttr('stroke');
// 				$('[style]').removeAttr('style');
// 			},
// 			parserOptions: {xmlMode: true}
// 		}))
// 		// cheerio plugin create unnecessary string '&gt;', so replace it.
// 		.pipe(replace('&gt;', '>'))
// 		// build svg sprite
// 		.pipe(svgSprite({
// 			mode: {
// 				symbol: {
// 					sprite: "../sprite.svg",
// 					render: {
// 						scss: {
// 							dest:'../../../sass/_sprite.scss',
// 							template: "sass/templates/_sprite_template.scss"
// 						}
// 					},
// 					example: true
// 				}
// 			}
// 		}))
// 		.pipe(gulp.dest('i/sprite/'));
//});

//testing your build files
// gulp.task('validation', function () {
// 	return gulp.src(buildDir + '**/*.html')
// 		.pipe(html5Lint());
// });

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


gulp.task('default', ['php', 'sass', 'imageSync', 'fontsSync', 'fontsConvert', 'jsConcat', 'jsSync', 'watch', 'browser-sync']);

gulp.task('build', ['cleanBuildDir'], function () {
	gulp.start('imgBuild', 'fontsBuild', 'jsBuild', 'cssBuild');
});


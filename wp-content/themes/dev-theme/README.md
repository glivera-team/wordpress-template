# Welcome to glivera-team-wordpress-template

## Get started
1. Install [node.js](https://nodejs.org/),[python(2 version)](https://www.python.org/downloads/release/python-2710/),[Microsoft Visual Studio C++ 2013](https://www.microsoft.com/en-gb/download/details.aspx?id=44914) and gulp globally

        npm install gulp -g

2. Install npm packages. If you have problems in browser-sync install on Windows look [here](http://www.browsersync.io/docs/#windows-users)

        npm i

	If you use link of global packages:

		npm install gulp rimraf gulp-sass gulp-inline-image gulp-autoprefixer gulp-plumber gulp-directory-sync browser-sync gulp-concat gulp-cssfont64 gulp-purifycss gulp-uglify gulp-imagemin imagemin-pngquant gulp-csso gulp-sourcemaps gulp-postcss postcss-assets postcss-reporter stylelint postcss-scss -g

		npm link gulp rimraf gulp-sass gulp-inline-image gulp-autoprefixer gulp-plumber gulp-directory-sync browser-sync gulp-concat gulp-cssfont64 gulp-purifycss gulp-uglify gulp-imagemin imagemin-pngquant gulp-csso gulp-sourcemaps gulp-postcss postcss-assets postcss-reporter stylelint postcss-scss

3. Let's code!

        gulp

4. Edit files in assets folder, see result in dist folder. If you want to build optimized version of project run :

        gulp build

5. Lint your styles

        gulp cssLint

## How to work with js

Create all your main scripts in assets/js. Create all your additional scripts (jquery,plugins, и т.д) in assets/js/all. Gulp will concat all your additional scripts into all.js

```
$(document).ready(function () {
	svg4everybody({});
});
```

## Working with images with PostCSS:

```
.test_block {
        width: width('rub.png');
        height:  height('rub.png');
        background: resolve('rub.png') no-repeat;
        background-size: size('rub.png');
}
```

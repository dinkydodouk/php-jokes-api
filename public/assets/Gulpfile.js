const { src, dest, series } = require('gulp');
const sass = require('gulp-sass');
const minifyCSS = require('gulp-csso');
const autoprefixer = require('gulp-autoprefixer');
const concat = require('gulp-concat');
const babel = require('gulp-babel');
const minifyJS = require('gulp-uglify');

function css() {
    return src('sass/jokes.scss')
        .pipe(sass())
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
        .pipe(minifyCSS())
        .pipe(concat('style.min.css'))
        .pipe(dest('css'))
}

function js() {
    return src('js/dev/**.js')
        .pipe(babel({
            presets: ['@babel/env']
        }))
        .pipe(minifyJS())
        .pipe(concat('scripts.min.js'))
        .pipe(dest('js'))
}

exports.css = series(css);
exports.js = series(js);
exports.default = series(css, js);
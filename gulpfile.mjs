import gulp from 'gulp';
import autoprefixer from 'autoprefixer';
import debug from 'gulp-debug';
import cssnano from 'cssnano';
import del from 'del';
import postCss from 'gulp-postcss';
import postCssReporter from 'postcss-reporter';
import sass from 'gulp-dart-sass';
import rename from "gulp-rename";

const paths = {
    distRoot: './assets/',
    distCss: './assets/css/',
    distJs: './assets/js/',
    distFonts: './assets/fonts/',
};

export const clean = () => {
    return del('assets');
};

export const css = () => {

    const plugins = [
        postCssReporter(),
        autoprefixer(),
        cssnano()
    ];

    return gulp.src(['src/scss/style.scss'])
        .pipe(sass())
        .pipe(postCss(plugins))
        .on('error', console.error)
        .pipe(debug())
        .pipe(rename(function (path) {
            path.extname = ".min.css";
        }))
        .pipe(gulp.dest(paths.distCss))
};

export const build = gulp.series(clean, gulp.parallel(css));

export default gulp.series(build);

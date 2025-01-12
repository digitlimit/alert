import resolve from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';
import babel from '@rollup/plugin-babel';
import terser from '@rollup/plugin-terser';
import scss from 'rollup-plugin-scss';
import postcss from 'postcss';
import cssnano from 'cssnano';
import fs from 'fs';

export default {
    input: 'resources/js/alert.js',
    output: [
        {
            file: 'public/js/alert.js',
            format: 'iife',
            name: 'DigitlimitAlert',
            sourcemap: true,
        },
        {
            file: 'public/js/alert.min.js',
            format: 'iife',
            name: 'DigitlimitAlert',
            plugins: [terser()],
            sourcemap: true,
        },
    ],
    plugins: [
        resolve(),
        commonjs(),
        babel({
            babelHelpers: 'bundled',
            exclude: 'node_modules/**',
        }),
        scss({
            output: (styles, styleNodes) => {
                // Write the uncompressed CSS file
                fs.writeFileSync('public/css/alert.css', styles);

                // Minify the CSS and write the minified file
                postcss([cssnano()])
                    .process(styles, { from: undefined })
                    .then((result) => {
                        fs.writeFileSync('public/css/alert.min.css', result.css);
                    });
            },
        }),
    ],
};





// import resolve from '@rollup/plugin-node-resolve';
// import commonjs from '@rollup/plugin-commonjs';
// import babel from '@rollup/plugin-babel';
// import terser from '@rollup/plugin-terser';
// import scss from 'rollup-plugin-scss';
//
// export default {
//     input: 'resources/js/alert.js',
//     output: [
//         {
//             file: 'public/js/alert.js',
//             format: 'iife',
//             name: 'DigitlimitAlert',
//             sourcemap: true,
//         },
//         {
//             file: 'public/js/alert.min.js',
//             format: 'iife',
//             name: 'DigitlimitAlert',
//             plugins: [terser()],
//             sourcemap: true,
//         },
//     ],
//     plugins: [
//         resolve(),
//         commonjs(),
//         babel({
//             babelHelpers: 'bundled',
//             exclude: 'node_modules/**',
//         }),
//         scss({
//             output: 'public/css/alert.css',
//         }),
//     ],
// };

module.exports = function(grunt) {

    grunt.initConfig({
        sass: {
            uawebtide: {
                options: {
                    sourcemap: 'none',
                    style: 'compressed',
                    noCache: true,
                    update: false
                },
                files: [{
                    expand: true,
                    src: '*.scss',
                    cwd: 'scss',
                    dest: 'css',
                    ext: '.min.css'
                }]
            }
        },
        uglify: {
            options: {
                mangle: false,
                compress: false
            },
            uawebtide: {
                files: [{
                    expand: true,
                    src: [ 'ua-webtide-main.js' ],
                    cwd: 'js',
                    dest: 'js',
                    ext: '.min.js'
                }]
            }
        },
        watch: {
            uawebtide: {
                files: [ '**/*', '!Gruntfile.js' ],
                tasks: [ 'newer:sass:uawebtide', 'newer:uglify:uawebtide' ]
            }
        }
    });

    // Load our dependencies
    grunt.loadNpmTasks( 'grunt-contrib-sass' );
    grunt.loadNpmTasks( 'grunt-contrib-uglify' );
    grunt.loadNpmTasks( 'grunt-contrib-watch' );
    grunt.loadNpmTasks( 'grunt-newer' );

    // Register our tasks
    grunt.registerTask( 'default', [ 'newer:sass', 'newer:uglify', 'watch' ] );

    // Register a watch function
    grunt.event.on( 'watch', function( action, filepath, target ) {
        grunt.log.writeln( target + ': ' + filepath + ' has ' + action );
    });

};
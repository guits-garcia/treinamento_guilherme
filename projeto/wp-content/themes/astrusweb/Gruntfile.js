module.exports = function(grunt) {

	var path = "bower_components";

	var jsFileList = [
		path + '/desandro-matches-selector/matches-selector.js',
		path + '/ev-emitter/ev-emitter.js',
		path + '/fizzy-ui-utils/utils.js',
		path + '/get-size/get-size.js',
		path + '/imagesloaded/imagesloaded.pkgd.js',
		path + '/jquery/dist/jquery.min.js',
		path + '/jquery-form/dist/jquery.form.min.js',
		path + '/jquery-mask-plugin/dist/jquery.mask.min.js',
		path + '/jquery-ui/jquery-ui.min.js',
		path + '/jquery-validation/dist/jquery.validate.min.js',
		path + '/jquery-validation/dist/additional-methods.min.js',
		path + '/jquery.maskedinput/dist/jquery.maskedinput.min.js',
		path + '/jquery.scrollTo/jquery.scrollTo.min.js',
		path + '/scrollmagic/scrollmagic/minified/ScrollMagic.min.js',
		path + '/slick-carousel/slick/slick.min.js',
		path + '/fancybox/dist/jquery.fancybox.min.js'
	]

	var cssFileList = [
		path + '/font-awesome/css/font-awesome.min.css',
		path + '/jquery-ui/themes/base/jquery-ui.min.css',
		path + '/slick-carousel/slick/slick.scss',
		path + '/fancybox/dist/jquery.fancybox.min.css'
	]

	grunt.initConfig({
		concat: {
			js: {
				options: {
					separator: '\n;'
				},
				src: [jsFileList],
				dest: 'assets/js/vendor.js'
			},
			css: {
				src: [cssFileList],
				dest: 'assets/css/vendor.css'
			}
		},
		compass: {
			dev: {
				options: {
					sassDir: 'assets/scss',
					cssDir: 'assets/css',
					outputStyle: 'compressed'
				}
			}
		},
		watch: {
			css: {
				files: 'assets/scss/*.scss',
				tasks: ['compass'],
				options: {
					livereload: {
						port: 6971
					}
				}
			}
		},
		copy: {
			main: {
				files: [
					{ expand: true, flatten: true, cwd: 'assets/vendor/components/font-awesome/fonts', src: ['**'], dest: 'assets/fonts' },
					{ expand: true, flatten: true, cwd: 'assets/vendor/components/gmaps', src: ['gmaps.min.js.map'], dest: 'assets/js' },
					{ expand: true, flatten: true, cwd: 'assets/vendor/components/jquery/dist', src: ['jquery.min.map'], dest: 'assets/js' },
				]
			}
		},
		uglify: {
			options: {
				compress: true
			},
			my_target: {
				files: {
					'assets/js/vendor.js': ['assets/js/vendor.js']
				}
			}

		}
	});

	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-uglify');

	grunt.registerTask('default', ['watch']);
	grunt.registerTask('vendor', ['concat','copy','uglify']);

}

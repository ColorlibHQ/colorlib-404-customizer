'use strict';

module.exports = function ( grunt ) {

	require( 'load-grunt-tasks' )( grunt, { scope: 'devDependencies' } );

	grunt.config.init( {
		pkg: grunt.file.readJSON( 'package.json' ),

		checktextdomain: {
			standard: {
				options: {
					text_domain: [ 'colorlib-404-customizer' ],
					create_report_file: true,
					keywords: [
						'__:1,2d',
						'_e:1,2d',
						'_x:1,2c,3d',
						'esc_html__:1,2d',
						'esc_html_e:1,2d',
						'esc_html_x:1,2c,3d',
						'esc_attr__:1,2d',
						'esc_attr_e:1,2d',
						'esc_attr_x:1,2c,3d',
						'_ex:1,2c,3d',
						'_n:1,2,4d',
						'_nx:1,2,4c,5d',
						'_n_noop:1,2,3d',
						'_nx_noop:1,2,3c,4d'
					]
				},
				files: [
					{
						src: [
							'**/*.php',
							'!node_modules/**',
							'!build/**'
						],
						expand: true
					}
				]
			}
		},

		makepot: {
			target: {
				options: {
					cwd: '',
					domainPath: 'languages/',
					exclude: [ 'build/.*', 'node_modules/.*' ],
					include: [],
					mainFile: 'colorlib-404-customizer.php',
					potComments: '',
					// A .pot is the template catalogue; the .po beside it is a
					// translation. Generating a .po here was a long-standing
					// mislabelling of the same file.
					potFilename: 'colorlib-404-customizer.pot',
					potHeaders: {
						poedit: true,
						'x-poedit-keywordslist': true
					},
					processPot: null,
					type: 'wp-plugin',
					updateTimestamp: true,
					updatePoFiles: false
				}
			}
		},

		/*
		 * Minify the staged copy in place, keeping the original filenames.
		 *
		 * The plugin enqueues `style.css`, never `style.min.css`, so writing
		 * `.min.css` siblings into assets/ (as this task used to) produced files
		 * nothing ever loaded — and it only covered the admin stylesheets, not the
		 * 20 template stylesheets visitors actually download. Minifying the build
		 * staging directory instead means the shipped zip serves minified CSS under
		 * the names the plugin already asks for, while the sources stay readable.
		 */
		cssmin: {
			build: {
				files: [
					{
						expand: true,
						cwd: 'build/',
						src: [ '**/*.css' ],
						dest: 'build/'
					}
				]
			}
		},

		clean: {
			build: {
				src: [ 'build/' ]
			}
		},

		copy: {
			build: {
				expand: true,
				src: [
					'**',
					'!node_modules/**',
					'!vendor/**',
					'!build/**',
					'!readme.md',
					'!README.md',
					'!CLAUDE.md',
					'!.claude/**',
					'!.github/**',
					// Listing images live in the SVN /assets/ directory, not in the plugin.
					'!.wordpress-org/**',
					'!phpcs.ruleset.xml',
					'!phpcs.xml',
					'!phpcs.xml.dist',
					'!package-lock.json',
					'!svn-ignore.txt',
					'!Gruntfile.js',
					'!package.json',
					'!composer.json',
					'!composer.lock',
					'!set_tags.sh',
					'!colorlib-404-customizer.zip',
					'!nbproject/**'
				],
				dest: 'build/'
			}
		},

		compress: {
			build: {
				options: {
					pretty: true,
					archive: '<%= pkg.name %>.zip'
				},
				expand: true,
				cwd: 'build/',
				src: [ '**/*' ],
				dest: '<%= pkg.name %>/'
			}
		}

	} );

	grunt.registerTask( 'textdomain', [ 'checktextdomain' ] );

	grunt.registerTask( 'i18n', [ 'checktextdomain', 'makepot' ] );

	// Stage, minify the staged CSS, zip, then throw the staging directory away.
	grunt.registerTask( 'build-archive', [
		'i18n',
		'clean:build',
		'copy:build',
		'cssmin:build',
		'compress:build',
		'clean:build'
	] );

	grunt.registerTask( 'default', [ 'build-archive' ] );
};

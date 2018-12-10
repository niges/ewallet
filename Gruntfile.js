module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    concat: {
      options: {
        separator: '\n'
      },
      dist: {
        src: [
        	'./src/js/wrapper/start.js',
        	'./src/modules/**/*.js',
        	'./src/js/wrapper/end.js'
        ],
        dest: './build/app.js'
      },
      template: {
        src: [
          './src/modules/**/*.tpl.php'
        ],
        dest : './build/templates.php'
      }
    },
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
      },
      dist: {
        files: {
          'build/app.min.js': ['build/app.js']
        }
      }
    },
	watch: {
	  scripts: {
	    files: ['src/modules/**/*.js','src/***/**/*.tpl.php'],
	    tasks: ['default'],
	    options: {
	      spawn: false,
	    },
	  },
	}

  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-watch');


  grunt.registerTask('default', ['concat', 'uglify']);

};
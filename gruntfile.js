module.exports = function(grunt) {

  grunt.initConfig({

    // Watches for changes and runs tasks
    // Livereload is setup for the 35729 port by default
    watch: {
      scss: {
        files: ['scss/**/*.scss'],
        tasks: ['compass:dev'],
        options: {
          livereload: 35729
        }
      },
      js:{
        files: ['js/**/*.js'],
        tasks: ['concat'],
        options: {
          livereload: 35729
        }
      },
      php: {
        files: ['**/*.php'],
        options: {
          livereload: 35729
        }
      }
    },

    compass: {                  // Task
      dist: {                   // Target
        options: {              // Target options
          sassDir: 'scss',
          cssDir: 'css',
          environment: 'production'
        }
      },
      dev: {                    // Another target
        options: {
          sassDir: 'scss',
          cssDir: 'css'
        }
      }
    },

    concat: {
      options: {
        separator: ';\n',
      },
      dist: {
        src: ['js/lib/jquery.min.js',
              'js/lib/bootstrap.min.js',
              'js/lib/jquery.transposer.js',
              'js/lib/owl.carousel.min.js',
              'js/lib/jquery.tablesorter.min.js'],
        dest: 'js/lib.js',
      },
    },

  });

  // Default task
  grunt.registerTask('default', ['concat', 'watch']);

  // Load up tasks
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');

};
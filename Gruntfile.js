module.exports = function (grunt) {
      grunt.initConfig({
      watch: {
      css: {
        files: 'less/**/*.less',
        tasks: ['less'],
        options: {
          livereload: true,
        },
      },
    },
    less: {
      development: {
        options: {
          paths: ["css"]
        },
        files: {
          "css/all.css": "less/all.less"
        }
      }
    }
  });
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.registerTask('default', ['less','watch']);
};

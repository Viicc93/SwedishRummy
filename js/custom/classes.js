var crazyBuilder = (function($) {

  // cache dom
  var $body = $('body'),
      $messagesDiv = $body.find('.messages'),
      $section = $('<section/>');

      $messagesDiv.after($section);


      // The base object is our "inheritance engine"
    var Base = {
        extend: function(properties) {
            // create a new object with this object as its prototype
            var obj = Object.create(this);
            // add properties to the new object
            Object.assign(obj, properties);
            return obj;
        }
    };

    // A memory for all "classes"
    var classMemory = {};

    // create Crazy class
    classMemory.Crazy = Base.extend({
        render: function() {}
    });
    // players prototype
    classMemory.Players = classMemory.Crazy.extend({
      /**
       * showName() method is a method that
       * create a div and print out every user name
       *
       */
      showName: function() {

        $section.append('<div class="game_users" data-user-id="' +  this._playerId + '"><p>' + this.name + '</p></div>');
      }
    });

    return {
      classMemory: classMemory,
    }
})(jQuery);


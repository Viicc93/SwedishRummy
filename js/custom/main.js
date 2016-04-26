(function($) {

  // cache dom
  var $body = $('body'),
      $form = $body.find('.user-form');

/*
* variables from index.php
* 1- deck_users      contains all users in deck-object "came from index.php"
* 2- plyaer_id       contains 1 user id "came from index.php"
*/

var crazy8 = [
  {
    players: deck_users,
    className: 'Players',
    type: 'player',
    list: 'players'
  }
];
console.log(deck_users);


/*
 * ajax method is the main method that hold jQuery
 * ajax method. this method give us the opportunity
 * to use HTTP methods for RESTfull services like
 * POST, GET, PUT, PATCH and DELETE
 */
function ajax(url, type, data, callBack) {
    // define the default HTTP method
    type = type || 'GET';
    // assign jQuery ajax method to res variable
    var res = $.ajax({
        url: url,
        type: type,
        data: data
    });
    // if the request success will call the callback function
    res.success(function(data) {
        callBack(data);
    });
    // if failed dispaly the error details
    res.fail(function(err) {
        console.error('response err', err.status);
    });
};


// create memory object to hold all that we'll get from resources
var memory = {},
    countLoadedUsers = 0,

    resourceByList = {},
    resourceByType = {};

crazy8.forEach(function(resource) {
    memory[resource.list] = resource;
    resourceByList[resource.list] = resource;
    resourceByType[resource.type] = resource;
    countLoadedUsers++;
    if (countLoadedUsers == crazy8.length) {

      classify();
      playerName();
      addDealButton();
    }
});



function classify() {
  for(listName in memory) {
    var list = memory.players[listName];

    var className = resourceByList[listName].className;
    var classObj  = crazyBuilder.classMemory[className];

    if (list.push) {
      memory.players[listName] = list.map(function(listItem) {

        return classObj.extend(listItem);

      });
    }else{
      memory[listName] = classObj.extend(list);
    }
  }
};

function playerName() {
  for (var i = 0; i < memory.players.players.length; i++) {
    memory.players.players[i].showName();

  }
};

function addDealButton() {
  if (memory.players.players.length > 1) {
    $form.append('<form action="inc/deal_cards.php" method="POST">' +
      '<button type="submit" name="deal" class="btn btn-default">Deal</button></form>');
  }
}



})(jQuery);


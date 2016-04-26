(function($) {

  // cache dom
  var $body = $(document).find('body'),
      $joinForm = $('form'),
      $cardOnTable = $('<div class="cards_on_table"/>');

      console.log(player_id);


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

// get deck as json object
var deckUrl = 'api/deck_json.php';
ajax(deckUrl, null, null, function(data) {
  //console.log(data);
});

// get cards on table
var cardsOnTableUrl = 'api/cards_on_table.php';
$.getJSON(cardsOnTableUrl, function(cards) {
  for (var i = 0; i < cards.length; i++) {
    $cardOnTable.append('<a data-cardId="' + cards[i]._cardId + '"><img src="img/back_of_card.png" /></a>');
    $('.messages').after($cardOnTable);
  };
});



// get users as json object
var usersUrl = 'api/get_users.php';
$.getJSON(usersUrl, function(users) {
  if (users.length > 1) {
    $joinForm.after('<button type="submit" class="deal-cards btn btn-default">Deal Cards</button>');
    usersInit(users);
  }
});

// create user container "div" to hold every user cards
function usersInit(users) {
  $body.delegate('.deal-cards', 'click', function(event) {
    for (var i = 0; i < users.length; i++) {
      $('.cards_on_table').after('<div class="col-md-6 user-cards" data-user-id="' + users[i]._playerId + '"><h4>' + users[i].name + '</h4></div>');
      dealUsersCard(users[i]);
    };
  });
}

// deal cards to every user
function dealUsersCard(users) {
  var $userHolder = $('.user-cards');
$userHolder.each(function(el) {
if ($(this).attr('data-user-id') == users._playerId) {
  var cardsOnHand = users._cardsOnHand;
  for(var i in cardsOnHand) {
 users._playerId === player_id ? $(this).append('<a data-cardId="' + cardsOnHand[i]._cardId + '"><img  src="' + cardsOnHand[i]._href + '" /></a>') : $(this).append('<a data-cardId="' + cardsOnHand[i]._cardId + '"><img  src="img/back_of_card.png" /></a>');

    console.log(users);
  }
  //console.log(users);
}
});

}

})(jQuery);


(function($) {

    // cache dom
    var $body = $(document).find('body'),
        $joinForm = $('form'),
        $cardOnTable = $('<div class="cards_on_table table"/>'),
        $thrownCards = $('<div class="cards_on_table thrown"/>'),
        $table = $body.find('#table');

    $table.prepend('<h1 class="game-heading">SWEDISH RUMMEY</h1>');

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

    function whichPlayer() {
        var url = 'json/game_status.json';
        ajax(url, null, null, function(queue) {
            thisPlayer(queue.whichPlayer);
        });
    }

    function thisPlayer(index) {
       var url = 'api/game_queue.php';
       ajax(url, 'POST', { indx: index }, function(data) {
        console.log(data);
       });
    }




    // create user container "div" to hold every user cards
    function usersInit(users) {
        $body.delegate('.deal-cards', 'click', function(event) {

            for (var i = 0; i < users.length; i++) {
                $('.cards_on_table').before('<div class="col-md-6 user-cards" data-user-id="' + users[i]._playerId + '"><h4>' + users[i].name + '</h4></div>');
                $table.find('.game-heading').hide('slow');
                dealUsersCard(users[i]);
            };
            $('button[type="submit"]').prop('disabled', true);
            startCard();
            whichPlayer();
        });
    };

        // get cards on table
        var cardsOnTableUrl = 'api/cards_on_table.php';
         $.getJSON(cardsOnTableUrl, function(cards) {
            for (var i = 0; i < cards.length; i++) {
                $cardOnTable.append('<a data-cardId="' + cards[i]._cardId + '"><img data-cardId="' + cards[i]._cardId + '" class="cards-pos" src="img/back_of_card.png" /></a>');
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




    function startCard() {

        var thrownCardUrl = 'api/thrown_card.php';
        $.getJSON(thrownCardUrl, function(cards) {
            $cardOnTable.after($thrownCards);
            $thrownCards.append('<a data-cardId="' + cards[0]._cardId + '"><img data-cardId="' + cards[0]._cardId + '" class="cards-pos" src="' + cards[0]._href + '" /></a>');
        });

            /**
             * send POST request to start_card.php to call
             * startCard-method. startCard-method will show
             * the start card on the table "the first thrown card"
             */
            // var deckUrl = 'api/start_card.php';
            // ajax(deckUrl, 'POST', { action: "start" }, function(data) {
            //     console.log(data);
            // });
    }



    // deal cards to every user
    function dealUsersCard(users) {
        // get wrapper div
        var $userHolder = $('.user-cards');
        // loop through user divs
        $userHolder.each(function(el) {
            // check user id
            if ($(this).attr('data-user-id') == users._playerId) {
                var cardsOnHand = users._cardsOnHand;
                for (var i in cardsOnHand) {
                    // if the user id in data-user-id the same user-id that came from the session to show picture side of the card, otherwise the backside will be shown
                    users._playerId === player_id ? $(this).append('<a class="active-user" data-cardId="' + cardsOnHand[i]._cardId + '">' +
                        '<img data-cardId="' + cardsOnHand[i]._cardId + '" src="' + cardsOnHand[i]._href + '" /></a>') : $(this).append('<a style="pointer-events: none;" data-cardId="' + cardsOnHand[i]._cardId + '">' +
                        '<img data-cardId="' + cardsOnHand[i]._cardId + '"  src="img/back_of_card.png" /></a>');
                }
                //console.log(users);
            }
        });
    }

    $(document).delegate('.active-user', 'click', function(event) {
        var $cardId = $(this).attr('data-cardId'),
            $userId = $(this).parent('.user-cards').attr('data-user-id');
            var deckUrl = 'api/play_card.php';
            ajax(deckUrl, 'POST', { userId: $userId, cardId: $cardId }, function(data) {
                console.log(data);
            });
    });

})(jQuery);

(function($) {
    // cache dom
    var $body = $(document).find('body'),
        $joinForm = $('form'),
        $dealButton = $('<div class="deal-cards"/>'),
        $cardOnTable = $('<div class="cards_on_table table"/>'),
        $thrownCards = $('<div class="cards_on_table thrown"/>'),
        $userHands = $('<div class="users-hand"/>'),
        $table = $body.find('#table'),
        $message = $table.find('.messages'),
        $suit = '<div class="suit"/>';

    $table.prepend('<h1 class="game-heading">SWEDISH RUMMEY</h1>');
    $joinForm.after($dealButton);
    $message.after($userHands);
    $userHands.after([$thrownCards, $cardOnTable]);

    console.log(player_id);

    var countUser = 0;


    /*
     * ajax method is the main method that hold jQuery
     * ajax method. this method give us the opportunity
     * to use HTTP methods for RESTfull services like
     * POST, GET, PUT, PATCH and DELETE
     */
    function ajax(url, type, dataType, data, callBack) {
        // define the default HTTP method
        type = type || 'GET';
        // assign jQuery ajax method to res variable
        var res = $.ajax({
            url: url,
            type: type,
            dataType: dataType || 'JSON',
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


    /**
     * Deck object
     *
     *
     */
    var url = 'api/deck_object.php';
    $.getJSON(url, function(deck) {



        /* Display deal button */
        dealButton(deck._users);

        /* Render cards on table */
        getCardsOnTable(deck._cards);


        // tableInit(deck._users);
        // getCardsOnTable(deck._cards);

        // // On deal card click event
        $body.delegate('.deal-cards', 'click', function() {

            /* Render users hand */
            renderPlayersHand(deck._users);

            /* Get user's turn icon beside your's name */
            getTurnIcon(deck.playerTurn);

            /* Bot throw card */
            //botPlayCard();
            controller();

            /* Get thrown card */
            thrownCardOnTable(deck._thrownCards);


            userPlayCard(deck._users);



            // userWrapperDiv(deck._users);
            // // Show thrown cards on table
            // thrownCardOnTable(deck._thrownCards);

            // // Bot turn
            // botPlayCard();

            // gameController();
            // // Update Bot cards on hand
            // updateBotHand();
            //console.log(deck);
        });
    });

    // ==========================================================================
    // RENDER PLAYERS HAND
    // ==========================================================================

    function renderPlayersHand(users) {
        for (var i = 0; i < users.length; i++) {
            var cardsOnHand = users[i]._cardsOnHand;
            if ($('.users-hand .user-cards').length < users.length) {

                $userHands.append('<div class="col-md-6 user-cards" data-user-pos="' + i + '" data-user-id="' + users[i]._playerId + '"></div>');
            }
            $table.find('.game-heading').hide('slow');

            /* Render cards on hands */
            renderHands(users[i]);
        };
    }


    /**
     * Deal cards to every user
     *
     *
     */
    function renderHands(users) {
        var $html = '';
        var cardsOnHand = users._cardsOnHand;
        // get wrapper div
        var $userHolder = $('.user-cards');
        // loop through user divs
        $userHolder.each(function(el) {
            // // check user id
            if ($(this).attr('data-user-id') == users._playerId) {
                $userHolder.prepend($suit);
                for (var i  in cardsOnHand) {
                    // if the user id in data-user-id the same user-id that came from the session to show picture side of the card, otherwise the backside will be shown
                    users._playerId === player_id ? $html += ('<a style="pointer-events: none;" data-cardid="' + cardsOnHand[i]._cardId + '">' +
                        '<img data-cardid="' + cardsOnHand[i]._cardId + '" src="' + cardsOnHand[i]._href + '" /></a>') : $html += ('<a style="pointer-events: none;" data-cardid="' + cardsOnHand[i]._cardId + '">' +
                        '<img data-cardid="' + cardsOnHand[i]._cardId + '" src="' + cardsOnHand[i]._href + '"  /></a>');
                    $(this).html(['<h4>' + users.name + '</h4>', $html]);
                }
                //src="img/back_of_card.png"
            }
        });
    }


    /**
     * Get user's turn icon
     *
     *
     */
    function getTurnIcon(whosTurn) {
        // Remove icon to prevent icon dublication
        $('.user-cards h4 span').remove();

        // appen the icon to the user who has the turn
        $('.user-cards[data-user-pos="' + whosTurn + '"] h4').append('<span class="glyphicon glyphicon-ok-sign"/>');

        // Create data-player-turn attribute to help us to add
        // the 4 symbols if the user has thrown 8
        $('.suit').attr('data-player-turn', whosTurn);

        /* Create clickable links to the user who has the turn */
        clickableLinks(whosTurn);

    }

    /**
     * Add active-user class to a-tags to the user
     * that has the turn
     *
     */
    function clickableLinks(whosTurn) {
        whosTurn > 0 ? $('.user-cards[data-user-pos="' + whosTurn + '"] a').addClass('active-user').removeAttr('style') : '';
    }

    /* ************************************************************************* */


    // /**
    //  * Show Deal Cards button
    //  *
    //  *
    //  */
    function dealButton(users) {

        if (users.length > 1) {
            $dealButton.html('<button type="submit" class="btn btn-default">Deal Cards</button>');
        }
    }


    /* ************************************************************************* */

    // /**
    //  * Get cards on Table
    //  *
    //  *
    //  */
    function getCardsOnTable(cards) {
        var $html = '';
        for (var i = 0; i < cards.length; i++) {
            $html += '<a data-cardid="' + cards[i]._cardId + '"><img data-cardid="' + cards[i]._cardId + '" class="cards-pos" src="img/back_of_card.png" /></a>';
        };
        $cardOnTable.html($html);
        $userHands.after($cardOnTable);
    }


    /* ==========================================================================
       THROWN CARDS ON TABLE
       ========================================================================== */


    /**
     * Get thrown cards on table
     *
     *
     */
    function thrownCardOnTable(thrownCards) {
        //console.log(thrownCards);

        $cardOnTable.after($thrownCards);

        var $html = '';

        for (var i = 0; i < thrownCards.length; i++) {

            $html += '<img data-cardid="' + thrownCards[i]._cardId + '" class="cards-pos" src="' + thrownCards[i]._href + '" />';
        };
        $thrownCards.html($html);
    }



    /* ==========================================================================
       BOT PLAY CARD
       ========================================================================== */
    function botPlayCard() {


        var url = 'api/bot_play_card.php';

        ajax(url, null, null, null, function(data) {
            //console.log(data);
        });
    }

    /* ==========================================================================
       USER PLAY CARD
       ========================================================================== */
    function userPlayCard(users) {
    //     // var $userDivWrapper = $body.find('.user-cards[data-user-pos="' + nextPlayer + '"] h4');
    //     // if ($userDivWrapper.find('span').length < 1) {

    //     //     $userDivWrapper.append('<span class="glyphicon glyphicon-ok-sign"/>');
    //     // }
            $(document).delegate('.active-user img', 'click', function(event) {
            var $cardId = $(this).attr('data-cardid'),
                $userId = $(this).parents('.user-cards').attr('data-user-id'),
                $playerTurn = $(this).parents('.user-cards').attr('data-user-pos');

            var deckUrl = 'api/user_play_card.php';
            ajax(deckUrl, 'POST', null, { userid: $userId, cardid: $cardId, playerTurn: $playerTurn }, function(data) {
            console.log('player turn', data);
            });


            renderPlayersHand(users);
        });
    }





    function controller() {
        setInterval(function() {
        botPlayCard();


        /**
         * Deck object
         *
         *
         */
        var url = 'api/deck_object.php';
        $.getJSON(url, function(deck) {
            /**
             * Check if the first card in thrownCards array
             * has value 8, if not will render thrown cards
             * array on table
             */

            if (deck._thrownCards[0]._value != 8) {
                // Render thrown cards on table
                thrownCardOnTable(deck._thrownCards);
            }else{
                console.log('It is 8');

                $suit = '<div class="chose-suit"><a class="click-suit"><img id="heart" src="img/heart.png"/></a><a class="click-suit"><img id="spades" src="img/spades.png"/></a><a class="click-suit"><img id="diamonds" src="img/diamonds.png"/><a/><a class="click-suit"><img id="clubs" src="img/clubs.png"/></a></div>';
                    $userHands.find('.suit').prepend($suit);
                    $('.chose-suit').siblings('a').removeClass('active-user');
            }
            // Update player turn icon
            getTurnIcon(deck.playerTurn);

            // Render player's hand
            renderPlayersHand(deck._users);

            // Update player turn icon
            getTurnIcon(deck.playerTurn);
            console.log(deck.availableCards);
        });

        }, 3000);
    }


    // /**
    //  * Create wrapper for every user
    //  *
    //  *
    //  */
    // function userWrapperDiv(users) {
    //     for (var i = 0; i < users.length; i++) {

    //         //$userHands.append('<div data-user-turn="' + i + '" data-user-id="' + users[i]._playerId + '" />');
    //         $userHands.append('<div class="col-md-6 user-cards" data-user-pos="' + i + '" data-user-id="' + users[i]._playerId + '"></div>');
    //         $table.find('.game-heading').hide('slow');

    //         dealCards(users[i]);
    //     }
    //     $('button[type="submit"]').prop('disabled', true);

    // }


    // /**
    //  * Deal cards to every user
    //  *
    //  *
    //  */
    // function dealCards(users) {
    //     var $html = '';
    //     // get wrapper div
    //     var $userHolder = $('.user-cards');
    //     // loop through user divs
    //     $userHolder.each(function(el) {
    //         // // check user id
    //         if ($(this).attr('data-user-id') == users._playerId) {
    //             var cardsOnHand = users._cardsOnHand;
    //             for (var i in cardsOnHand) {
    //                 // if the user id in data-user-id the same user-id that came from the session to show picture side of the card, otherwise the backside will be shown
    //                 users._playerId === player_id ? $html += ('<a class="active-user" data-cardId="' + cardsOnHand[i]._cardId + '">' +
    //                     '<img data-cardId="' + cardsOnHand[i]._cardId + '" src="' + cardsOnHand[i]._href + '" /></a>') : $html += ('<a style="pointer-events: none;" data-cardId="' + cardsOnHand[i]._cardId + '">' +
    //                     '<img data-cardId="' + cardsOnHand[i]._cardId + '"  src="img/back_of_card.png" /></a>');
    //                 $(this).html(['<h4>' + users.name + '</h4>', $html]);
    //             }
    //         }
    //     });

    // }


    // /**
    //  * Get cards on Table
    //  *
    //  *
    //  */
    // function getCardsOnTable(cards) {
    //     var $html = '';
    //     for (var i = 0; i < cards.length; i++) {
    //         $html += '<a data-cardId="' + cards[i]._cardId + '"><img data-cardId="' + cards[i]._cardId + '" class="cards-pos" src="img/back_of_card.png" /></a>';
    //     };
    //     $cardOnTable.html($html);
    //     $userHands.after($cardOnTable);
    // }

    // /**
    //  * Get thrown cards on table
    //  *
    //  *
    //  */
    // function thrownCardOnTable(thrownCards) {
    //     //console.log(thrownCards);

    //     $cardOnTable.after($thrownCards);

    //     var $html = '';

    //     for (var i = 0; i < thrownCards.length; i++) {

    //         $html += '<img data-cardId="' + thrownCards[i]._cardId + '" class="cards-pos" src="' + thrownCards[i]._href + '" />';
    //     };
    //     $thrownCards.html($html);
    // }

    // /* ==========================================================================
    //    BOT PLAY CARD
    //    ========================================================================== */
    // function botPlayCard() {
    //     setTimeout(function() {

    //         var url = 'api/bot_play_card.php';

    //         ajax(url, null, null, null, function(data) {
    //             //console.log(data);
    //         });
    //     }, 3000);
    // }


    // function updateBotHand() {
    //     setTimeout(function() {

    //         var url = 'api/game_state.php';
    //         ajax(url, null, null, null, function(botHand) {

    //             var $html = '';
    //             // get wrapper div
    //             var $userHolder = $('.user-cards');
    //             // loop through user divs
    //             $userHolder.each(function(el) {
    //                 //     // // check user id
    //                 console.log(botHand.nextPlayer);
    //                 for (var i = 0; i < botHand.users.length; i++) {

    //                     dealCards(botHand.users[i]);
    //                 };
    //             });

    //         });
    //     }, 2000);
    // var nextPlayer = $('.user-cards[data-user-pos="0"]');
    //     nextPlayer.find('h4').append('<span class="glyphicon glyphicon-ok-sign"/>');
    // }



    // /* ==========================================================================
    //    UPDATE THROWN CARDS ON TABLE
    //    ========================================================================== */




    // function updateThrownCards() {
    //     var url = 'api/update_thrown_card.php';
    //     ajax(url, null, null, null, function(thrownCards) {

    //         $cardOnTable.after($thrownCards);

    //         var $html = '';

    //         for (var i = 0; i < thrownCards.length; i++) {
    //         console.log(thrownCards[i]);

    //             $html += '<img data-cardId="' + thrownCards[i]._cardId + '" class="cards-pos" src="' + thrownCards[i]._href + '" />';
    //         };
    //         $thrownCards.html($html);
    //     });
    // }

    // function gameController() {

    //     setInterval(function() {
    //         updateThrownCards();
    //         $.getJSON('api/game_state.php', function(state) {
    //                 //console.log(state.nextPlayer);
    //                 userPlayCard(state.nextPlayer);
    //                 console.log(state);
    //         });
    //     }, 1000)
    // }


    // /* ==========================================================================
    //    USER PLAY CARD
    //    ========================================================================== */
    // function userPlayCard(nextPlayer) {
    //     var $userDivWrapper = $body.find('.user-cards[data-user-pos="' + nextPlayer + '"] h4');
    //     if ($userDivWrapper.find('span').length < 1) {

    //         $userDivWrapper.append('<span class="glyphicon glyphicon-ok-sign"/>');
    //     }
    //         $(document).delegate('.active-user', 'click', function(event) {
    //         var $cardId = $(this).attr('data-cardId'),
    //             $userId = $(this).parent('.user-cards').attr('data-user-id'),
    //             $playerTurn = $(this).parent('.user-cards').attr('data-user-pos');
    //         var deckUrl = 'api/user_play_card.php';
    //         ajax(deckUrl, 'POST', null, { userId: $userId, cardId: $cardId, playerTurn: $playerTurn }, function(data) {
    //             console.log(data);
    //         });

    //         updateUserHand()
    //     //console.log($playerTurn);
    //     });
    // }

    // function updateUserHand() {
    //     var url = 'api/game_state.php';
    //     $.getJSON(url, function(botHand) {
    //         for (var i = 0; i < botHand.users.length; i++) {

    //          dealCards(botHand.users);
    //          console.log(botHand.users);
    //         };

    //         //console.log(botHand.cardsOnHand);
    //     });
    // }

})(jQuery);

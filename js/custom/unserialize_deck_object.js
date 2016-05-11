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

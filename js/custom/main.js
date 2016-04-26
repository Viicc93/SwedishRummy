(function($) {

$.getJSON('api/get_deck.php', function(data){
  var users = data._users;
  test(users);
});

function test(users) {
    if (users.length > 1) {
      $('form').after('<button type="submit" name="deal-btn" id="deal-btn" class="btn btn-default">Deal</button>');
    };
}


$(document).delegate('#deal-btn','click', function(event){

  $.getJSON('api/get_cardsOnHand.php', function(data){
    console.log(data);
    $('body').append('<h1>'+ data +'</h1>');
});

})
})(jQuery);


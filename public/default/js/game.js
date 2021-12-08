var game_id = '';
$(document).ready(function () {
    $("#important-notice-button-newgame").on('click', function () {
        $(".important-notice-wrapper").hide();
        $('#dealer-cards-area').empty();
        $('#player-cards-area').empty();
        loader('on');
        table_id = $("#gametable_id").val();
       $.ajax({
            type: 'GET',
            url: URL + 'gameApi/cleanStart/' + table_id,
            success: function (data) {
                result = $.parseJSON(data);
                $('#dealer-cards-area').append(result[0][0]);
                $('#player-cards-area').append(result[0][1]);
                loader('off');
                if (result[1][0] == 'blackjack') {
                    alert("Blackjack!");
                    newRound();
                }
                updateStats(result);
                   game_id = result[3].game_id;
               }
       }); 
       //newRound();
    });
    
    $("#hit-button").on('click', function () {
       table_id = $("#gametable_id").val();
       $.ajax({
            type: 'GET',
            url: URL + 'gameApi/hit/' + table_id,
            success: function (data) {
                result = $.parseJSON(data);
                $('#player-cards-area').append(result[0][0]);
                if (result[1][0] == 'dealer') {
                    $('#you-lost').fadeIn('slow');
                    setTimeout(function() {
                        $('#you-lost').fadeOut('slow');
                        newRound();
                    }, 2500);
                }
                updateStats(result);
            }
       });
    });
    
    $("#stand-button").on('click', function () {
       table_id = $("#gametable_id").val();
       $.ajax({
            type: 'GET',
            url: URL + 'gameApi/stand/' + table_id,
            success: function (data) {
                result = $.parseJSON(data);
                $("#dealer-card-1").remove();
                $('#dealer-cards-area').append(result[2]);
                $.each(result[0], function(index, value) {
                    setTimeout(function() {
                        $('#dealer-cards-area').append(value);
                    }, 1500);
                    updateStats(result);
                });
                
                setTimeout(function() {
                    if (result[1][0] == 'player') {
                        $('#you-won').fadeIn('slow');
                        setTimeout(function() {
                            $('#you-won').fadeOut('slow');
                        }, 1500);
                    } else if (result[1][0] == 'dealer') {
                        $('#you-lost').fadeIn('slow');
                        setTimeout(function() {
                            $('#you-lost').fadeOut('slow');
                        }, 1500);
                    } else if (result[1][0] == 'draw') {
                        $('#its-a-draw').fadeIn('slow');
                        setTimeout(function() {
                            $('#its-a-draw').fadeOut('slow');
                        }, 1500);
                    }
                }, 2000);
            }
        });
        setTimeout(function() {
            newRound();
        }, 3000);
    });
});

function newRound() {
    $('#dealer-cards-area').empty();
    $('#player-cards-area').empty();
    loader('on');
    table_id = $("#gametable_id").val();
    $.ajax({
         type: 'GET',
         url: URL + 'gameApi/start/' + table_id + '/' + game_id,
         success: function (data) {
             result = $.parseJSON(data);
             $('#dealer-cards-area').append(result[0][0]);
             $('#player-cards-area').append(result[0][1]);
             loader('off');
             if (result[1][0] == 'blackjack') {
                 alert("Blackjack!");
                 newRound();
             }
             updateStats(result);
         }
    });
}

function updateStats(active_values) {
    $('#balance-display').text(active_values[3].balance);
    $('#cardcount-display').text(active_values[3].card_count);
    console.log(active_values[3].balance);
}
/* 
 

setTimeout(function() {
    loaderOff();
}, 10000); 
*/
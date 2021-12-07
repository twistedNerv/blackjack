$(document).ready(function () {
    $("#important-notice-button-newgame").on('click', function () {
       $(".important-notice-wrapper").hide();
       newRound();
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
            }
       });
    });
    
    $("#stand-button").on('click', function () {
       table_id = $("#gametable_id").val();
       console.log("test");
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
                });
                
                setTimeout(function() {
                if (result[1][0] == 'player') {
                    $('#you-won').fadeIn('slow');
                    setTimeout(function() {
                        $('#you-won').fadeOut('slow');
                    }, 2500);
                } else if (result[1][0] == 'dealer') {
                    $('#you-lost').fadeIn('slow');
                    setTimeout(function() {
                        $('#you-lost').fadeOut('slow');
                    }, 2500);
                } else if (result[1][0] == 'draw') {
                    $('#its-a-draw').fadeIn('slow');
                    setTimeout(function() {
                        $('#its-a-draw').fadeOut('slow');
                    }, 2500);
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
         url: URL + 'gameApi/start/' + table_id,
         success: function (data) {
             result = $.parseJSON(data);
             $('#dealer-cards-area').append(result[0][0]);
             $('#player-cards-area').append(result[0][1]);
             loader('off');
             if (result[1][0] == 'blackjack') {
                 alert("Blackjack!");
             }
         }
    });
}
/* 
 

setTimeout(function() {
    loaderOff();
}, 10000); 
*/
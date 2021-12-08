<input type='hidden' id='gametable_id' value='<?= $data['gametable_id'] ?>' />
<div class="col-sm-12 "> 
    <div class="row game-table"> 
        <div class="col-sm-9"> 
            <div class="row">
                <div class="col-sm-12 text-center" id="dealer-area"> 
                    <div id="dealer-cards-area" class="col-sm-12">
<!--                        <div id="dealer-card-0" class="the-card" style="left: 0px;background-image: url('http://localhost/blackjack/public/default/images/cards/jack_of_clubs.png')" /></div>-->
                    </div>
                    <div id="dealer-other-area" class="col-sm-12">
                        <h4></h4>
                    </div>
                </div>
                <div class="col-sm-12 text-center" id="player-area"> 
                    <div id="player-cards-area" class="col-sm-12">kkk
                    </div>
                    <div id="player-other-area" class="col-sm-12">
                        <input type='button' value="Hit" id='hit-button' />
                        <input type='button' value="Stand" id='stand-button' />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 text-right" id="info-area">
            <div class='balance-area' style="background-color:grey;">
                Balance: <span class="balance-display"><?=$data['active_user']['balance']?></span>
            </div>
            <div class='stats-area' style="background-color:grey;">
                Here be stats
            </div>
            <div class='stats-area' style="background-color:red;">
                <input type='button' value="Hit" id='hit-button'>
            </div>
            <div class='stats-area' style="background-color:red;">
            </div>
        </div>
    </div>
</div>
<?php if (!$data['game_id']) { ?>
<div class="important-notice-wrapper">
    <div class="important-notice-area">
        <br><h4>Notification</h4><br>
        You havan't started a game yet.<br>
        Want to begin?<br><br>
        <input type="button" id="important-notice-button-newgame" value="Start" class="btn btn-primary"/>
    </div>
</div>
<div class='result-notice you-won' id='you-won' style='display:none;'>
    <h1>You won!</h1>
</div>
<div class='result-notice you-lost' id='you-lost' style='display:none;'>
    <h1>You lost!</h1>
</div>
<div class='result-notice its-a-draw' id='its-a-draw' style='display:none;'>
    <h1>Its a draw!</h1>
</div>
<?php } ?>
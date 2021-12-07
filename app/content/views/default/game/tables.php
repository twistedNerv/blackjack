<div class="col-sm-12 "> 
    <div class="row game-table"> 
        <div class="col-sm-2"></div>
        <div class="col-sm-8 text-center"><h2>Choose a table</h2></div> 
        <div class="col-sm-2"></div>
        
        <div class="col-sm-12"> 
            <div class="row">
                <?php foreach ($data['items'] as $single_item) { ?>
                    <a href="<?=URL?>game/main/<?=$single_item['id']?>" class="col-sm-3 text-left board-section table-choose"> 
                        <h4><?=$single_item['table_name']?></h4>
                        <hr>
                        Number of decks: <strong><?=$single_item['decks_num']?></strong><br>
                        Dealer stands at 17: <strong><?= ($single_item['dealer_stops_17'] == 1) ? "Yes" : "No"?></strong><br>
                        Blackjack ratio: <strong><?=$single_item['ratio']?></strong><br>
                        Double down allowed: <strong><?= ($single_item['double_bet'] == 1) ? "Yes" : "No"?></strong><br>
                        Split allowed: <strong><?= ($single_item['split'] == 1) ? "Yes" : "No"?></strong><br>
                        Surender allowed: <strong><?= ($single_item['surender'] == 1) ? "Yes" : "No"?></strong><br>
                        Insurance allowed: <strong><?= ($single_item['insurance'] == 1) ? "Yes" : "No"?></strong><br>
                        Min. bet: <strong><?= $single_item['min_bet'] ?></strong><br>
                        Max. bet: <strong><?= $single_item['max_bet'] ?></strong><br>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

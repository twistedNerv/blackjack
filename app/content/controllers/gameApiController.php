<?php

class gameApiController extends controller {

    function __construct() {
        parent::__construct();
        $this->tools->checkPageRights(1);
    }

    public function displayAction() {
        echo "<pre>";
//        var_dump($this->session->get('activeUser'));
//        var_dump($this->session->get('activeDeck'));
        var_dump($this->session->get('hand'));
    }
    
    public function cleanStartAction($gametable = null) {
        $activeValues = $this->session->get('activeValues');
        $activeValues = [
            'game_id' => '',
            'balance' => $this->session->get('activeUser')['balance'],
            'bet' => 0,
            'card_count' => 0,
            'bs_error_count' => 0
        ];
        $this->session->set('activeValues', $activeValues);
        $this->session->set('hand', []);
        $this->session->set('activeDeck', []);
        
        $gameModel = $this->loadModel('game');
        $cardModel = $this->loadModel('card');
        $this->session->set('activeDeck', $cardModel->newDeck());
        $gameModel->setStart_dt(date('d.m.Y H:i:s'));
        $gameModel->setBalance_start($this->session->get('activeUser')['balance']);
        $gameModel->setTable_id($gametable);
        $gameModel->setUser_id($this->session->get('activeUser')['id']);
        $gameModel->setActive(1);
        $gameModel->flush();
        $this->tools->log("gameApi/cleanStart", "New game on table_id: $gametable created.");
        $game_id = $gameModel->db->lastInsertId();
        $activeValues = [
            'game_id' => $game_id,
            'balance' => $this->session->get('activeUser')['balance'],
            'bet' => 0,
            'card_count' => $this->session->get('activeValues')['card_count'],
            'bs_error_count' => 0
        ];
        $this->session->set('activeValues', $activeValues);
        echo json_encode($this->prepareHands());
    }

    public function startAction($gametable = null, $gameid = null) {
        if (!$gametable) {
            return false;
        }
        $cardModel = $this->loadModel('card');
        $gameModel = $this->loadModel('game');
        $gameModel->getOneBy('id', $gameid);
        $gameModel->setBalance_end($this->session->get('activeUser')['balance']);
        $gameModel->setEnd_dt(date('d.m.Y H:i:s'));
        $gameModel->setRoi(0);
        $gameModel->setBs_errors(0);
        $gameModel->setRounds(0);
        $gameModel->flush();
        $this->tools->log("gameApi/start", "New round on table_id: $gametable with game_id: $gameid updated.");
        $activeValues = [
            'game_id' => $gameid,
            'balance' => $this->session->get('activeUser')['balance'],
            'bet' => 0,
            'card_count' => $this->session->get('activeValues')['card_count'],
            'bs_error_count' => 0
        ];
        $this->session->set('activeValues', $activeValues);
        echo json_encode($this->prepareHands());
    }

    public function hitAction($gametable = null, $game_id = null) {
        if (!$gametable)
            return false;

        $cardModel = $this->loadModel('card');
        $hand = $this->session->get('hand');
        $player_cards_num = count($hand['active']['player']);
        $hand['active']['player'][$player_cards_num] = $this->drawCard();
        $this->session->set('hand', $hand);
        $result[0][0] = $this->prepareCardHtml('player', $player_cards_num, $hand['active']['player'][$player_cards_num]->image);
        $result[1][0] = $this->checkWinner();
        $result[2] = [];
        $result[3] = $this->session->get('activeValues');
        echo json_encode($result);
    }

    public function standAction($gametable = null, $game_id = null) {
        if (!$gametable)
            return false;

        $cardModel = $this->loadModel('card');
        $winner = false;
        $dealer_sum = $this->sumHand('dealer');
        $player_sum = $this->sumHand('player');
        if ($dealer_sum == 21 || $dealer_sum >= 17) {
            $result[0] = [];
            if ($dealer_sum > $player_sum) {
                $winner = 'dealer';
            } else if ($dealer_sum == $player_sum) {
                $winner = 'draw';
            } else {
                $winner = 'player';
            }
        } else {
            $i = 0;
            while (!$winner) {
                $hand = $this->session->get('hand');
                $dealer_cards_num = count($hand['active']['dealer']);
                $hand['active']['dealer'][$dealer_cards_num] = $this->drawCard();
                $this->session->set('hand', $hand);
                $result[0][$i] = $this->prepareCardHtml('dealer', $dealer_cards_num, $hand['active']['dealer'][$dealer_cards_num]->image);
                $i++;
                $winner = $this->checkWinner(false, true);
            }
        }
        $result[1][0] = $winner;
        $result[2] = $this->prepareCardHtml('dealer', 1, $this->session->get('hand')['active']['dealer'][1]->image);
        $result[3] = $this->session->get('activeValues');
        //echo "<pre>";var_dump($this->session->get('hand')['active']['dealer']);
        //echo "<pre>"; var_dump($result);
        echo json_encode($result);
    }
    
    private function sumHand($role = 'player') {
        $result = 0;
        $aces = 0;
        foreach ($this->session->get('hand')['active'][$role] as $card) {
            $result += (int) $card->value;
            $aces += ($card->number == 'a') ? 1 : 0;
        }
        for ($i = 0; $i < $aces; $i++) {
            if ($result > 21) {
                $result -= 10;
            }
        }
        return $result;
    }

    private function checkWinner($start = false, $stand = false) {
        $dealer_sum = $this->sumHand('dealer');
        $player_sum = $this->sumHand('player');
        if ($start && $player_sum == 21)
            return 'blackjack';

        if ($player_sum > 21) {
            return 'dealer';
        } else if ($dealer_sum > 21 && $player_sum >= 17) {
            return 'player';
        }

        if ($stand && $dealer_sum >= 17) {
            if ($player_sum > $dealer_sum) {
                return 'player';
            } else if ($player_sum < $dealer_sum) {
                return 'dealer';
            } else {
                return 'draw';
            }
        }
        return false;
    }

    private function drawCard() {
        $deck = $this->session->get('activeDeck');
        $random_card = array_rand($deck);
        $card = $deck[$random_card];
        $this->cardCounter($card->value);
        unset($deck[$random_card]);
        $this->session->set('activeDeck', $deck);
        return $card;
    }

    private function prepareCardHtml($role = 'player', $index = '', $image = '') {
        $rotation = mt_rand(-5,5);
        $image_path = URL . 'public/default/images/cards/' . $image;
        $offset = $index * 30 + 10;
        return '<div id="' . $role . '-card-' . $index . '" 
                    class="the-card" 
                    style=" left:' . $offset . 'px;
                            background-image: url(' . "'" . $image_path . "'" . ');
                            transform:rotate(' . $rotation . 'deg);
                "></div>';
    }
    
    private function cardCounter($card_value) {
        if ($card_value >= 10) {
            $new_value = -1;
        } else if ($card_value <= 6) {
            $new_value = 1;
        } else {
            $new_value = 0;
        }
        $active_values = $this->session->get('activeValues');
        $active_values['card_count'] += $new_value;
        $this->session->set('activeValues', $active_values);
        return $active_values['card_count'];
    }

    private function updateUserBalance($amount) {
        $active_user = $this->session->get('activeUser');
        $active_user['balance'] += $amount;
        $userModel = $this->loadModel('user');
        $userModel->setBalance($active_user['balance']);
        $userModel->flush();
        $this->session->set('activeUser', $active_user);
        $this->tools->log("gameApi/updateUserBalance", "User balance update. Amount: $amount - new value: " . $active_user['balance']);
    }

    private function prepareHands() {
        
        $hand = [
            'active' => [
                'dealer' => [
                    0 => $this->drawCard(),
                    1 => $this->drawCard()
                ],
                'player' => [
                    0 => $this->drawCard(),
                    1 => $this->drawCard()
                ]
            ],
            'previous' => [
                'dealer' => [],
                'player' => []
            ]
        ];
        $this->session->set('hand', $hand);
        $result[0][0] = $this->prepareCardHtml('dealer', 0, $hand['active']['dealer'][0]->image);
        $result[0][0] .= $this->prepareCardHtml('dealer', 1, 'back_black.png');
        $result[0][1] = $this->prepareCardHtml('player', 0, $hand['active']['player'][0]->image);
        $result[0][1] .= $this->prepareCardHtml('player', 1, $hand['active']['player'][1]->image);
        $result[1][0] = $this->checkWinner(true);
        $result[2] = [];
        $result[3] = $this->session->get('activeValues');    
        return $result;
    }
}

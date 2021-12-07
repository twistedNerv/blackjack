<?php

class cardModel extends model {
    
    public $id;
    public $number;
    public $color;
    public $value;
    public $image;
    public $heads = [
        'j' => 'jack',
        'q' => 'queen',
        'k' => 'king',
        'a' => 'ace'
    ];
    public $card_colors = [
        0 => 'spades', 
        1 => 'hearts', 
        2 => 'diamonds', 
        3 => 'clubs'
    ];

    function __construct() {
        parent::__construct();
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    
    public function getNumber() {
        return $this->number;
    }

    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }
    
    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
        return $this;
    }
    
    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }
    
    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }
    
    public function newDeck() {
        $new_deck = [];
        foreach ($this->card_colors as $single_color) {
            for ($i = 2; $i <= 10; $i++) {
                array_push($new_deck, $this->createCard(null, $i, $single_color, $i, $i . "_of_" . $single_color . ".png"));
            }
            foreach ($this->heads as $key => $name) {
                $value = ($key == 'a') ? 11 : 10;
                array_push($new_deck, $this->createCard(null, $key, $single_color, $value, $name . "_of_" . $single_color . ".png"));
            }
        }
        return $new_deck;
    }
    
    private function createCard($id = null, $number = null, $color = null, $value = null, $image = null) {
        $objCard = new cardModel();
        unset($objCard->db);
        unset($objCard->heads);
        unset($objCard->card_colors);
        unset($objCard->tools);
        $objCard->setNumber($number);
        $objCard->setColor($color);
        $objCard->setValue($value);
        $objCard->setImage($image);
        return $objCard;
    }

}
<?php

class Archer extends Character {

    private $arrow = 20;
    private $focus = 1;
    
    public function __construct($pseudo) {
        $this->pseudo = $pseudo;
        $this->atk = 15;
    }

    public function action($target) {
        if($this->focus == 2){
            return $this->doubleAttack($target);
        }elseif($this->focus == 3){
            return $this->focusAttack($target);
        }else{
            $choice = rand(1, 3);
            if($this->arrow <= 0) {
                return $this->dagger($target);
            } elseif ($choice == 1 ) {
                return $this->attack($target);
            } elseif ($choice == 2) {
                $this->focus = 2;
                $status = "$this->pseudo se concentre pour tirer 2 fleches...";
                return $status;
            } elseif ($choice == 3) {
                $this->focus = 3;
                $status = "$this->pseudo se concentre pour un tire précis...";
                return $status;
            }
        }
    }

    public function dagger($target) {
        $damage = 5;
        $target->setHP($damage);
        $target->isAlive();
        $status = "$this->pseudo attaque avec une dague $target->pseudo qui a $target->lifePoint points de vie!";
        return $status;
    }

    public function attack($target) {
        $this->arrow -= 1;
        $damage = $this->atk;
        $target->setHP($damage);
        $target->isAlive();
        $status = "$this->pseudo tire sur $target->pseudo qui a $target->lifePoint points de vie!";
        return $status;
    }

    public function focusAttack($target) {
        $rand = rand(15, 30)/10;
        $this->arrow -= 1;
        $this->focus = 1;
        $damage = $this->atk * $rand;
        $target->setHP($damage);
        $target->isAlive();
        $status = "$this->pseudo tire précis sur $target->pseudo qui a $target->lifePoint points de vie!";
        return $status;
    }

    public function doubleAttack($target) {
        $this->arrow -= 2;
        $this->focus = 1;
        $damage = $this->atk * 2;
        $target->setHP($damage);
        $target->isAlive();
        $status = "$this->pseudo tire double sur $target->pseudo qui a $target->lifePoint points de vie!";
        return $status;
    }
     
    public function setHP($damage) {
        $this->lifePoint -= $damage;
        return;
    }
}

// vise presise 2tour mais rand 1,5 3* les degat
<?php

namespace classes;

class Druide extends Character
{
    //compteur pour l'attaque de la forêt 
    private $count = 0;

    public function attack(Character $target)
    {
        $rand = rand(1, 10);

        if ($rand <= 3 && $this->count == 0) {
            // Une moyenne chance (3/10) d'invoquer la force de la forêt (dégt*1.5 pour 3 tour).
            //Il ne répètera pas cette action tant qu'il est sous sont effet.
            // si l'attaque est en cours impossible de la refaire
            return $this->more();

        } elseif ($rand == 4) {
            //Une faible chance (1/10) de soigner tous ses points de vie.
            return $this->lifeAgain();
        } else {
            //Une grande chance (6/10) de donner un coup de bâton.
            return $this->stickHit($target);
        }
    }

    //fonction privée coup de bâton
    private function stickHit(Character $target)
    {
        if ($this->count > 0) {
            $attack = 3 * 1.5;
            $target->setLifePoints($attack);
            $this->count-=1;
            $status = "{$this->name} attaque {$target->name} avec un coup de bâton super puissant. Il reste {$target->getLifePoints()} à {$target->name} !";
            return $status;
        } else {
            $attack = 3;
            $target->setLifePoints($attack);
            $status = "{$this->name} attaque {$target->name} avec un coup de bâton. Il reste {$target->getLifePoints()} à {$target->name} !";
            return $status;
        }
    }

    //fonction privée pour regagner tous les points de vie 
    private function lifeAgain()
    {
        $this->lifePoints = 100;
        $status = "{$this->name} à re gagné tous ses points de vie,c'est-à-dire {$this->getLifePoints()} points !";
        return $status;
    }

    //fonction privée pour multiplier ses points d'attque
    private function more()
    {
        // multiplier par 1.5 pendant 3 tours 
        $this->count=3;
        $status="{$this->name} charge son attaque de la forêt";
        return $status;
    }
}

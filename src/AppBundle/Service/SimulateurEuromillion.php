<?php
/**
 * Created by PhpStorm.
 * User: answe
 * Date: 03/11/2017
 * Time: 12:52
 */

namespace AppBundle\Service;


use AppBundle\Entity\Grille;
use function array_intersect;
use Doctrine\Common\Collections\ArrayCollection;
use function in_array;

class SimulateurEuromillion
{

    const PRIX_GRILLE = 2.5;
    const PRIZE_POOL_MIN=17000000;
    const PRIZE_POOL_MAX=190000000;
    private $numeroEuromillion;
private $nbAnnees;
private $nbTirages;
private $gagnant=false;
private $gains=0;
    public function __construct ()
    {
        $this->numeroEuromillion = new NumerosEuromillions();
        
    }

    public function simuler (array $tabNums,array $tabEtoiles, $nbTirage)
    {
        $this->nbTirages=$nbTirage*52*2;
        $this->nbAnnees=$nbTirage;

dump($this->nbTirages);
        $fin=false;
        $nbTirageSimu=0;

        while(!$fin){
            $tabTirage=$this->numeroEuromillion->tirage();
           // dump($tabTirage);

            $interNum=array_intersect($tabTirage["5num"],$tabNums);
            $interEtoile=array_intersect($tabTirage["2etoiles"],$tabEtoiles);

            $countEtoile=count($interEtoile);
            $countNum=count($interNum);
           $nbTirageSimu++;
           //
            if($countEtoile==NumerosEuromillions::NB_BON_ETOILE and $countNum==NumerosEuromillions::NB_BON_NUMERO  ){
                $this->gagnant=true;
                $fin=true;
                dump($nbTirageSimu);
                 dump($tabNums); dump($interNum);

                dump($tabEtoiles); dump($interEtoile);

            }elseif ($nbTirageSimu==$this->nbTirages ){
                dump($nbTirageSimu);
                dump($tabNums); dump($interNum);

                dump($tabEtoiles); dump($interEtoile);
                $fin=true;
            }


        }
        dump($this);
     return $this;

    }

    /**
     * @return int
     */
    public function getGains ()
    {
        return $this->gains;
    }

    /**
     * @return bool
     */
    public function isGagnant ()
    {
        return $this->gagnant;
    }

    /**
     * @return mixed
     */
    public function getNbAnnees ()
    {
        return $this->nbAnnees;
    }

    /**
     * @return mixed
     */
    public function getNbTirages ()
    {
        return $this->nbTirages;
    }

    /**
     * @param mixed $nbTirages
     */
    public function setNbTirages ($nbTirages)
    {
        $this->nbTirages = $nbTirages;
    }

    /**
     * @param mixed $nbAnnees
     */
    public function setNbAnnees ($nbAnnees)
    {
        $this->nbAnnees = $nbAnnees;
    }


    public function getNumeroEuromillion(){
        return $this->numeroEuromillion;
    }

    public function estimationGains($prizePool,$nbBonNum,$nbBonEtoile){

    }
}
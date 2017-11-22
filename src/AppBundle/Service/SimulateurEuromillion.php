<?php
/**
 * Created by PhpStorm.
 * User: answe
 * Date: 03/11/2017
 * Time: 12:52
 */

namespace AppBundle\Service;


use AppBundle\Entity\Grille;
use Doctrine\Common\Collections\ArrayCollection;
use function in_array;

class SimulateurEuromillion
{

    const PRIX_GRILLE = 2.5;
    private $numeroEuromillion;


    public function __construct ()
    {

        
    }

    public function simuler (array $tabNums,array $tabEtoiles)
    {
        $this->numeroEuromillion = new NumerosEuromillions();


        $gagnant=false;
        $nbTirage=0;
      //  dump($tabNums);dump($tabEtoiles);
        while(!$gagnant){
            $tabTirage=$this->numeroEuromillion->tirage();
           // dump($tabTirage);
            $countNum=0;
            $countEtoile=0;
            foreach($tabNums as $num){
                if(in_array($num, $tabTirage["5num"])){
                    $countNum++;
                }
            }
            foreach($tabEtoiles as $etoile){
                if(in_array($etoile, $tabTirage["2etoiles"])){
                    $countEtoile++;
                }

            }

           ++$nbTirage;
            if($countEtoile==2 and $countNum==5){
                $gagnant=true;
                dump($nbTirage);
            }

        }
     // return $tirage= $this->numeroEuromillion->tirage();

    }


    public function getNumeroEuromillion(){
        return $this->numeroEuromillion;
    }
}
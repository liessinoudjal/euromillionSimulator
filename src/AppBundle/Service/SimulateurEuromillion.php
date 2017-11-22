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
    private $numeroEuromillion;


    public function __construct ()
    {

        
    }

    public function simuler (array $tabNums,array $tabEtoiles, $nbTirage)
    {
        $this->numeroEuromillion = new NumerosEuromillions();

dump($nbTirage);die;
        $gagnant=false;
        $nbTirage=0;

        while(!$gagnant){
            $tabTirage=$this->numeroEuromillion->tirage();
           // dump($tabTirage);

            $interNum=array_intersect($tabTirage["5num"],$tabNums);
            $interEtoile=array_intersect($tabTirage["2etoiles"],$tabEtoiles);
           // dump($tabNums); dump($interNum);

            //dump($tabEtoiles); dump($interEtoile);
            /*  foreach($tabNums as $num){


                /*if(in_array($num, $tabTirage["5num"])){
                      $countNum++;
                  }
            }*/
            /*  foreach($tabEtoiles as $etoile){
            /*  if(in_array($etoile, $tabTirage["2etoiles"])){
                   $countEtoile++;
               }

            }*/
            $countEtoile=count($interEtoile);
            $countNum=count($interNum);
           ++$nbTirage;

            if($countEtoile==NumerosEuromillions::NB_BON_ETOILE and $countNum==NumerosEuromillions::NB_BON_NUMERO){
                $gagnant=true;
                dump($nbTirage);die;

            }
          /*  if($nbTirage==100000){
                dump($nbTirage);   die;
            }*/

        }
     // return $tirage= $this->numeroEuromillion->tirage();

    }


    public function getNumeroEuromillion(){
        return $this->numeroEuromillion;
    }
}
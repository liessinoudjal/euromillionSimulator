<?php
/**
 * Created by PhpStorm.
 * User: answe
 * Date: 03/11/2017
 * Time: 13:35
 */

namespace AppBundle\Service;


use function array_shift;
use Doctrine\Common\Collections\ArrayCollection;
use function shuffle;

class NumerosEuromillions
{
    const NB_NUMERO = 50;
    const NB_ETOILE = 12;
    const NB_BON_NUMERO = 5;
    const NB_BON_ETOILE = 2;
    private $numeros;
    private $etoiles;
    private $tabTirage;

    public function __construct(){
        $this->numeros = new ArrayCollection();
        $this->etoiles = new ArrayCollection();
        $this->tabTirage= [];
        for ($i = 1; $i <= self::NB_NUMERO; $i++) {
            $this->numeros->add($i);
        }
        for ($j = 1; $j <= self::NB_ETOILE; $j++) {
            $this->etoiles->add($j);
        }
    }


    /**
     * @return array
     */
    public function tirage ()
    {
        if(count($this->tabTirage)>0){
            $this->tabTirage=[];
        }
        $tabNum=$this->numeros->toArray();
      shuffle( $tabNum );
      $tabEtoile=$this->etoiles->toArray();
        shuffle( $tabEtoile );

        for ($i=0;$i<self::NB_BON_NUMERO;$i++){
            $this->tabTirage["5num"][]=array_shift($tabNum);
            if($i<self::NB_BON_ETOILE){
                $this->tabTirage["2etoiles"][]=array_shift($tabEtoile);
            }
        }
        return $this->tabTirage;
    }


    /**
     * @return mixed
     */
    public function getNumeros()
    {
        return $this->numeros;
    }

    /**
     * @return mixed
     */
    public function getEtoiles ()
    {
        return $this->etoiles;
    }

}
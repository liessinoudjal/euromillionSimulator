<?php
/**
 * Created by PhpStorm.
 * User: answe
 * Date: 03/11/2017
 * Time: 13:35
 */

namespace AppBundle\Service;


use Doctrine\Common\Collections\ArrayCollection;
use function shuffle;

class NumerosEuromillions
{
    const NB_NUMERO = 50;
    const NB_ETOILE = 12;
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
        for ($i = 1; $i <= self::NB_ETOILE; $i++) {
            $this->etoiles->add($i);
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

        for ($i=0;$i<5;$i++){
            $this->tabTirage["5num"][]=$tabNum[$i];
            if($i<2){
                $this->tabTirage["2etoiles"][]=$tabEtoile[$i];
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
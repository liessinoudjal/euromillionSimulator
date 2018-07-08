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
use function array_key_exists;
use Doctrine\Common\Collections\ArrayCollection;
use function in_array;
use const null;
use const true;

class SimulateurEuromillion
{

    const PRIX_GRILLE = 2.5;
    const PRIZE_POOL_MIN = 17000000;
    const PRIZE_POOL_MAX = 190000000;
    private $prizePool = 0;
    private $tabGains = [

        "5,1" => 432260.99,
        "5,0" => 78142.57,
        "4,2" => 4498.49,
        "4,1" => 203.92,
        "3,2" => 105.22,
        "4,0" => 62.81,
        "2,2" => 19.92,
        "3,1" => 14.62,
        "3,0" => 12.2,
        "1,2" => 10.67,
        "2,1" => 8.04,
        "2,0" => 4.08
    ];

   private $rang1=0,$rang2=0,$rang3=0,$rang4=0,$rang5=0,$rang6=0,$rang7=0,$rang8=0,$rang9=0,$rang10=0,$rang11=0,$rang12=0,$rang13=0;


    private $numeroEuromillion;
    private $nbAnnees;
    private $nbTirages;



    /**
     * @return mixed
     */
    public function getBenef ()
    {
        return $this->benef;
    }
    private $gagnant = false;
    private $gains = 0;
    private $miseTotale=0;
    private $benef;
    public function __construct ()
    {
        $this->numeroEuromillion = new NumerosEuromillions();

    }

    /**
     * @return array
     */
    public function getTabGains ()
    {
        return $this->tabGains;
    }

    /**
     * @return int
     */
    public function getMiseTotale ()
    {
        return $this->miseTotale;
    }

    /**
     * @param array $tabNums
     * @param array $tabEtoiles
     * @param $nbTirage
     * @return $this
     */
    public function simuler (array $tabNums, array $tabEtoiles, $nbTirage)
    {
        $this->nbTirages = $nbTirage * 52 * 2;
        $this->nbAnnees = $nbTirage;

      //  dump($this->nbTirages);
        $fin = false;
        $nbTirageSimu = 0;

        while (!$fin) {
            $nbTour= mt_rand(1,15);
            $this->prizePool=self::PRIZE_POOL_MIN;
            for($i=0;$i<$nbTour;$i++){
                if($this->prizePool>=self::PRIZE_POOL_MAX){
                    $this->prizePool=self::PRIZE_POOL_MAX;
                }else{
                    $this->prizePool*=1.15;
                }
                $tabTirage = $this->numeroEuromillion->tirage();
                // dump($tabTirage);

                $interNum = array_intersect($tabTirage["5num"], $tabNums);
                $interEtoile = array_intersect($tabTirage["2etoiles"], $tabEtoiles);

                $countEtoile = count($interEtoile);
                $countNum = count($interNum);
                $this->estimationGains($countNum, $countEtoile);

                $nbTirageSimu++;

                //
                if ($countEtoile == NumerosEuromillions::NB_BON_ETOILE and $countNum == NumerosEuromillions::NB_BON_NUMERO) {
                    $this->gagnant = true;
                    $fin = true;
                  //  dump($nbTirageSimu);
                 //   dump($tabNums);
                  //  dump($interNum);

                  //  dump($tabEtoiles);
                 //   dump($interEtoile);
                    $this->miseTotale= $nbTirageSimu*self::PRIX_GRILLE;

                } elseif ($nbTirageSimu == $this->nbTirages) {
                  //  dump($nbTirageSimu);
                  //  dump($tabNums);
                  //  dump($interNum);

                  //  dump($tabEtoiles);
                  //  dump($interEtoile);
                  //  dump($this->gains);
                    $this->miseTotale= $nbTirageSimu*self::PRIX_GRILLE;
                    $fin = true;
                }
            }



        }

        $this->benef=$this->gains-$this->miseTotale;

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

    /**
     * @param int $prizePool
     */
    public function setPrizePool ($prizePool)
    {
        $this->prizePool = $prizePool;
    }

    /**
     * @return int
     */
    public function getPrizePool ()
    {
        return $this->prizePool;
    }

    public function getNumeroEuromillion ()
    {
        return $this->numeroEuromillion;
    }

    public function estimationGains ($nbBonNum, $nbBonEtoile)
    {
        $key = "$nbBonNum,$nbBonEtoile";
        if (array_key_exists($key, $this->tabGains)) {


            if ($nbBonNum == NumerosEuromillions::NB_BON_NUMERO and $nbBonEtoile == NumerosEuromillions::NB_BON_ETOILE) {
                $this->gains += $this->getPrizePool();

            }else{
                $this->gains += $this->tabGains[$key];

            }
            $this->incrementerRang($key);
        }
    }

    public function incrementerRang($key){
        switch ($key){
            case "5,2":
                $this->rang1++;break;
            case "5,1":
                $this->rang2++;break;
            case "5,0":
                $this->rang3++;break;
            case "4,2":
                $this->rang4++;break;
            case "4,1":
                $this->rang5++;break;
            case "3,2":
                $this->rang6++;break;
            case "4,0":
                $this->rang7++;break;
            case "2,2":
                $this->rang8++;break;
            case "3,1":
                $this->rang9++;break;
            case "3,0":
                $this->rang10++;break;
            case "1,2":
                $this->rang11++;break;
            case "2,1":
                $this->rang12++;break;
            case "2,0":
                $this->rang13++;break;
        }
    }
    /**
     * @return int
     */
    public function getRang1 ()
    {
        return $this->rang1;
    }

    /**
     * @return int
     */
    public function getRang2 ()
    {
        return $this->rang2;
    }

    /**
     * @return int
     */
    public function getRang3 ()
    {
        return $this->rang3;
    }

    /**
     * @return int
     */
    public function getRang4 ()
    {
        return $this->rang4;
    }

    /**
     * @return int
     */
    public function getRang5 ()
    {
        return $this->rang5;
    }

    /**
     * @return int
     */
    public function getRang6 ()
    {
        return $this->rang6;
    }

    /**
     * @return int
     */
    public function getRang7 ()
    {
        return $this->rang7;
    }

    /**
     * @return int
     */
    public function getRang8 ()
    {
        return $this->rang8;
    }

    /**
     * @return int
     */
    public function getRang9 ()
    {
        return $this->rang9;
    }

    /**
     * @return int
     */
    public function getRang10 ()
    {
        return $this->rang10;
    }

    /**
     * @return int
     */
    public function getRang11 ()
    {
        return $this->rang11;
    }

    /**
     * @return int
     */
    public function getRang12 ()
    {
        return $this->rang12;
    }

    /**
     * @return int
     */
    public function getRang13 ()
    {
        return $this->rang13;
    }
}
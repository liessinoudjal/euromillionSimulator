<?php

namespace AppBundle\Entity;




use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Grille
{
    /**
     * @Assert\NotBlank(message="champs requis!")
     *  @Assert\Range(
     *      min = 1,
     *      max = 100000,
     *      minMessage = "Vous devez entrer un chiffre entre 1 et 100000",
     *      maxMessage = "Vous devez entrer un chiffre entre 1 et 100000"
     * )
     */
    private $nbTirage;
    /**
     * @Assert\NotBlank(message="champs requis!")
     *  @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Vous devez entrer un chiffre entre 1 et 50",
     *      maxMessage = "Vous devez entrer un chiffre entre 1 et 50"
     * )
     */
    private $num1;
    /**
     * @Assert\NotBlank(message="champs requis!")
     *  @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Vous devez entrer un chiffre entre 1 et 50",
     *      maxMessage = "Vous devez entrer un chiffre entre 1 et 50"
     * )
     */
    private $num2;
    /**
     * @Assert\NotBlank(message="champs requis!")
     *  @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Vous devez entrer un chiffre entre 1 et 50",
     *      maxMessage = "Vous devez entrer un chiffre entre 1 et 50"
     * )
     */
    private $num3;
    /**
     * @Assert\NotBlank(message="champs requis!")
     *  @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Vous devez entrer un chiffre entre 1 et 50",
     *      maxMessage = "Vous devez entrer un chiffre entre 1 et 50"
     * )
     */
    private $num4;
    /**
     * @Assert\NotBlank(message="champs requis!")
     *  @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Vous devez entrer un chiffre entre 1 et 50",
     *      maxMessage = "Vous devez entrer un chiffre entre 1 et 50"
     * )
     */
    private $num5;
    /**
     * @Assert\NotBlank(message="champs requis!")
     *  @Assert\Range(
     *      min = 1,
     *      max = 12,
     *      minMessage = "Vous devez entrer un chiffre entre 1 et 12",
     *      maxMessage = "Vous devez entrer un chiffre entre 1 et 12"
     * )
     */
    private $etoile1;
    /**
     * @Assert\NotBlank(message="champs requis!")
     *  @Assert\Range(
     *      min = 1,
     *      max = 12,
     *      minMessage = "Vous devez entrer un chiffre entre 1 et 12",
     *      maxMessage = "Vous devez entrer un chiffre entre 1 et 12"
     * )
     */
    private $etoile2;

    private $grille;
    private $grilleEtoile;

    public function __construct(){
        $this->grille=  new ArrayCollection();
        $this->grilleEtoile=  new ArrayCollection();
    }
    public function __toString(){
        return "{nbTirage:$this->nbTirage,num1:$this->num1,num2:$this->num2,num3:$this->num3,num4:$this->num4,num5:$this->num5,etoile1:$this->etoile1,etoile2:$this->etoile2}";
    }

    public function getNbTirage()
    {
        return $this->nbTirage;
    }

    /**
     * @param int $num
     * @return $this
     */
    public function setNbTirage(int $num)
    {
        $this->nbTirage = $num;

        return $this;
    }

    public function getNum1()
    {
        return $this->num1;
    }

    /**
     * @param int $num
     * @return $this
     */
    public function setNum1(int $num)
    {
        $this->num1 = $num;
        $this->grille->add($num);
        return $this;
    }
    public function getNum2()
    {
        return $this->num2;
    }

    /**
     * @param int $num
     * @return $this
     */
    public function setNum2(int $num)
    {
        $this->num2 = $num;
        $this->grille->add($num);
        return $this;
    }

    public function getNum3()
    {
        return $this->num3;
    }

    /**
     * @param int $num
     * @return $this
     */
    public function setNum3(int $num)
    {
        $this->num3 = $num;
        $this->grille->add($num);
        return $this;
    }

    public function getNum4()
    {
        return $this->num4;
    }

    /**
     * @param int $num
     * @return $this
     */
    public function setNum4(int $num)
    {
        $this->num4 = $num;
        $this->grille->add($num);
        return $this;
    }

    public function getNum5()
    {
        return $this->num5;
    }

    /**
     * @param int $num
     * @return $this
     */
    public function setNum5(int $num)
    {
        $this->num5 = $num;
        $this->grille->add($num);
        return $this;
    }

    public function getEtoile1()
{
    return $this->etoile1;
}

    /**
     * @param int $num
     * @return $this
     */
    public function setEtoile1(int $num)
    {
        $this->etoile1 = $num;
        $this->grilleEtoile->add($num);
        return $this;
    }

    public function getEtoile2()
    {
        return $this->etoile2;
    }

    /**
     * @param int $num
     * @return $this
     */
    public function setEtoile2(int $num)
    {
        $this->etoile2 = $num;
        $this->grilleEtoile->add($num);
        return $this;
    }

    /**
     * @return array|null
     */
    public function getNums(){
        if(!$this->grille->isEmpty())
            return $this->grille->toArray();
        else
            return null;
    }

    /**
     * @return array|null
     */
    public function getEtoiles(){
        if(!$this->grilleEtoile->isEmpty())
            return $this->grilleEtoile->toArray();
        else
            return null;
    }
     /**
     * @return array|null
     */
    public function getGrille(){
        if(!$this->grilleEtoile->isEmpty() and !$this->grille->isEmpty() )
            return  array_merge ([$this->getNbTirage()], $this->grille->toArray(),$this->grilleEtoile->toArray());
        else
            return null;
    }


    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        // check if the name is actually a fake name
        if ($this->num1 == $this->num2 OR $this->num1 == $this->num3 OR $this->num1 == $this->num4 OR $this->num1 == $this->num5) {
            $context->buildViolation('vos numeros doivent être différents')
                ->atPath('num1')
                ->addViolation();
        }
        if($this->num2 == $this->num3 or $this->num2 == $this->num4 or $this->num2 == $this->num5){
            $context->buildViolation('Vos numeros doivent être différents')
                ->atPath('num2')
                ->addViolation();
        }
        if($this->num3== $this->num4 or $this->num3 == $this->num5 ){
            $context->buildViolation('Vos numeros doivent être différents')
                ->atPath('num3')
                ->addViolation();
        }
        if($this->num4== $this->num5  ){
            $context->buildViolation('Vos numeros doivent être différents')
                ->atPath('num4')
                ->addViolation();
        }
        if($this->etoile1== $this->etoile2  ){
            $context->buildViolation('Vos étoiles doivent être différentes')
                ->atPath('etoile1')
                ->addViolation();
        }
    }
}
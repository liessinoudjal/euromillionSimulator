<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Grille;
use AppBundle\Form\GrilleType;
use AppBundle\Service\SimulateurEuromillion;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method({"GET", "POST"})
     */
    public function indexAction (Request $request)
    {




        return $this->render('default/index.html.twig', [

        ]);
    }

    /**
     * @Route("/euromillion", name="euromillion")
     * @Method({"POST","GET"})
     */
    public function euromillionAction (Request $request)
    {

        $grille = new Grille();
        $form = $this->createForm(GrilleType::class, $grille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $grille = $form->getData();

            $simulateurEuro = new SimulateurEuromillion();

            $simulationEuromillion=$simulateurEuro->simuler($grille->getNums(),$grille->getEtoiles(),$grille->getNbTirage());

             return $this->render('default/euromillionResult.html.twig',[
               'simulationEuromillion'=>$simulationEuromillion,
             ]);

        }

        return $this->render('default/euromillion.html.twig', [

            'form' => $form->createView(),
        ]);
    }
}

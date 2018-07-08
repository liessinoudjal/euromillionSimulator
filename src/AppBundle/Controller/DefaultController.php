<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Grille;
use AppBundle\Form\GrilleType;
use AppBundle\Service\SimulateurEuromillion;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
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
         //  dump($grille);die;
           // $grille = $form->getData();
        
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

     /**
     * @Route("/api/euromillion/{nbTirage}/{num1}/{num2}/{num3}/{num4}/{num5}/{etoile1}/{etoile2}", name="apiEuromillion")
     * @Method({"GET"})
     */
    public function apiEuromillionAction (Request $request, int $nbTirage,int $num1,int $num2, int $num3, int $num4, int $num5, int $etoile1, int $etoile2)
    {
             $grille = new Grille();
       //  dump($request->attributes->get('nbTirage'));
       // $grillejson=json_encode($request->attributes->get('grille'));
        $grille->setNbTirage($request->attributes->get('nbTirage'))
                ->setNum1($request->attributes->get('num1'))
                ->setNum2($request->attributes->get('num2'))
                ->setNum3($request->attributes->get('num3'))
                ->setNum4($request->attributes->get('num4'))
                ->setNum5($request->attributes->get('num5'))
                ->setEtoile1($request->attributes->get('etoile1'))
                ->setEtoile2($request->attributes->get('etoile2'));
            //    dump($grille);
      // return new Response( $grille,200,['content-type'=>'application/json']);
      // 
            $simulateurEuro = new SimulateurEuromillion();

            $simulationEuromillion=$simulateurEuro->simuler($grille->getNums(),$grille->getEtoiles(),$grille->getNbTirage());
       return $this->json($simulationEuromillion);
    }
}

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

        $grille = new Grille();
        $form = $this->createForm(GrilleType::class, $grille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $grille = $form->getData();

            $simulateurEuro = new SimulateurEuromillion();

            $simulation=$simulateurEuro->simuler($grille->getNums(),$grille->getEtoiles());

            return $this->render('default/index.html.twig');
            //  return $this->redirectToRoute('beneficiaire_index');
        }

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }
}

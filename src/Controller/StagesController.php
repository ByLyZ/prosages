<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FormationsRepository;
use App\Entity\Formations;
use App\Repository\StagesRepository;
use App\Entity\Stages;
use App\Repository\EntreprisesRepository;
use App\Entity\Entreprises;
use App\Form\StageType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class StagesController extends AbstractController
{
    /**
     * @Route("/profile/stages/ajouter/", name="stages_ajouter")
     */
    public function ajouterStage(Request $request, EntityManagerInterface $manager): Response
    {
        $stage=new Stages();

        $formulaireStage= $this->createForm(StageType::class, $stage);

        $formulaireStage->handleRequest($request);
        
        if($formulaireStage->isSubmitted() && $formulaireStage->isValid())
        {
            $manager->persist($stage);
            $manager->flush();

            return $this->redirectToRoute('accueil');
        }

        return $this->render('stages/stageAjouter.html.twig',['vueFormulaire' => $formulaireStage->createView()]);
    }

    /**
     * @Route("/stages/{id}", name="stages")
     */
    public function index(Stages $stages): Response
    {
        return $this->render('stages/index.html.twig', [
            'controller_name' => 'StagesController',
            'stages'=>$stages,
        ]);
    }
}
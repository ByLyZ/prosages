<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FormationsRepository;
use App\Entity\Formations;
use App\Repository\StagesRepository;
use App\Entity\Stages;

class FormationsController extends AbstractController
{
    /**
     * @Route("/formations", name="formations")
     */
    public function index(FormationsRepository $repositoryFormations): Response
    {
        $formations = $repositoryFormations->findAll();

        return $this->render('formations/index.html.twig', ['formations' => $formations]);
    }

    /**
     * @Route("/formations/stages/{nom}", name="formations_stages")
     */
    public function filtre(StagesRepository $repositoryStages,$nom): Response
    {
        $stages = $repositoryStages->findByStageParFormation($nom);

        return $this->render('formations/formationStage.html.twig', ['stages' => $stages, 'nom' => $nom]);
    }
}

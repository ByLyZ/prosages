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

        return $this->render('formations/index.html.twig', [
            'controller_name' => 'FormationsController', 'formations' => $formations
        ]);
    }

    /**
     * @Route("/formations/stages/{id}", name="formations_stages")
     */
    public function filtre(Formations $formations): Response
    {
        $stages = $formations->getStages();

        return $this->render('formations/formationStage.html.twig', ['controller_name' => 'EntreprisesController','stages' => $stages, 'formation' => $formations]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StagesRepository;
use App\Entity\Stages;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(StagesRepository $repositoryStages): Response
    {
        $stages = $repositoryStages->AfficherToutStage();

        return $this->render('accueil/index.html.twig', ['controller_name' => 'AccueilController','stages' => $stages]);
    }
}

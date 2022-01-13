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

class StagesController extends AbstractController
{
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
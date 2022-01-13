<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EntreprisesRepository;
use App\Entity\Entreprises;

class EntreprisesController extends AbstractController
{
    /**
     * @Route("/entreprises", name="entreprises")
     */
    public function index(): Response
    {
        $repositoryEntreprises = $this->getDoctrine()->getRepository(Entreprises::class);
        $entreprises = $repositoryEntreprises->findAll();

        return $this->render('entreprises/index.html.twig', [
            'controller_name' => 'EntreprisesController', 'entreprises' => $entreprises
        ]);
    }
}

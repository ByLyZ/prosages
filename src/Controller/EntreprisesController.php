<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EntreprisesRepository;
use App\Entity\Entreprises;
use App\Repository\StagesRepository;
use App\Entity\Stages;

class EntreprisesController extends AbstractController
{
    /**
     * @Route("/entreprises", name="entreprises")
     */
    public function index(EntreprisesRepository $repositoryEntreprises): Response
    {
        $entreprises = $repositoryEntreprises->findAll();

        return $this->render('entreprises/index.html.twig', [
            'controller_name' => 'EntreprisesController', 'entreprises' => $entreprises
        ]);
    }

//    /**
//     * @Route("/entreprises/stages/{id}", name="entreprises_stages")
//     */
/*    public function filtre(Entreprises $entreprises, StagesRepository $repositoryStages): Response
    {
        $stages = $repositoryStages->findBy(['entreprise' => $entreprises->getId()]);

        return $this->render('entreprises/entrepriseStage.html.twig', ['controller_name' => 'EntreprisesController','stages' => $stages, 'entreprise' => $entreprises]);
    }
*/

    /**
     * @Route("/entreprises/stages/{nom}", name="entreprises_stages")
     */
    public function filtre(StagesRepository $repositoryStages,$nom): Response
    {
        $stages = $repositoryStages->findByStageParNomEntreprise($nom);

        return $this->render('entreprises/entrepriseStage.html.twig', ['stages' => $stages, 'nom' => $nom]);
    }

    /**
     * @Route("/entreprises/ajouter/", name="entreprises_ajouter")
     */
    public function ajouterEntreprise()
    {
        $entreprise=new Entreprises();

        $formulaireEntreprise= $this->createFormBuilder($entreprise)
        ->add('nom')
        ->add('adresse')
        ->add('lienInternet')
        ->add('activite')
        ->getForm();

        return $this->render('entreprises/entrepriseAjouter.html.twig',['vueFormulaire' => $formulaireEntreprise->createView()]);
    }
}

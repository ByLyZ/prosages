<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EntreprisesRepository;
use App\Entity\Entreprises;
use App\Repository\StagesRepository;
use App\Entity\Stages;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\EntrepriseType;

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
    public function ajouterEntreprise(Request $request, EntityManagerInterface $manager)
    {
        $entreprise=new Entreprises();

        $formulaireEntreprise= $this->createForm(EntrepriseType::class, $entreprise);

        $formulaireEntreprise->handleRequest($request);
        
        if($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid())
        {
            $manager->persist($entreprise);
            $manager->flush();

            return $this->redirectToRoute('entreprises');
        }

        return $this->render('entreprises/entrepriseAjouter.html.twig',['vueFormulaire' => $formulaireEntreprise->createView(), 'action'=>"ajouter"]);
    }

    /**
     * @Route("/entreprises/modifier/{id}", name="entreprises_modifier")
     */
    public function modifierEntreprise(Request $request, EntityManagerInterface $manager, Entreprises $entreprise)
    {

        $formulaireEntreprise= $this->createForm(EntrepriseType::class, $entreprise);

        $formulaireEntreprise->handleRequest($request);
        
        if($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid())
        {
            $manager->persist($entreprise);
            $manager->flush();

            return $this->redirectToRoute('entreprises');
        }

        return $this->render('entreprises/entrepriseAjouter.html.twig',['vueFormulaire' => $formulaireEntreprise->createView(), 'action'=>"modifier"]);
    }
}

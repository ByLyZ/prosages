<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StagesRepository;
use App\Entity\Stages;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\UserType;
use App\Entity\User;

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
        /**
     * @Route("/inscription", name="ajouter_user")
     */
    public function ajouterUser(Request $request, EntityManagerInterface $manager): Response
    {
        $user=new User();

        $formulaireUser = $this->createForm(UserType::class, $user);

        $formulaireUser->handleRequest($request);
        
        if($formulaireUser->isSubmitted() && $formulaireUser->isValid())
        {
            //$manager->persist($user);
            //$manager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/userAjouter.html.twig',['vueFormulaire' => $formulaireUser->createView()]);
    }
}

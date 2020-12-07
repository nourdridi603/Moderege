<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\Enqueteur;
use App\Form\UtilisateurType;
use App\Form\EnqueteurType;
use App\Repository\UtilisateurRepository;
use App\Repository\EnqueteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * @Route("/utilisateur/inscription",name="addUtilisateur")
     */
    public function inscription(Request $req){
        $utilisateur=new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();
           // return $this->redirectToRoute('inscription',['id'=>$utilisateur->getId()]);
        }
        if($form->isSubmitted() && $form->isValid() && $form->get('save_enqueteur')->isClicked()){
            return $this->redirectToRoute('addEnqueteur',['id'=>$utilisateur]);
        }
        if($form->isSubmitted() && $form->isValid() && $form->get('save_sonde')->isClicked()){
            return $this->redirectToRoute('addUtilisateur');
        }        
        return $this->render('Utilisateur/inscription.html.twig', [
            'form' => $form->createView(),
            
        ]);

       
    }

    /**
     * @Route("/utilisateur/inscription/{id}",name="addEnqueteur")
     */
public function inscriptionEnqueteur(Utilisateur $utilisateur,Request $req){
    $enqueteur=new Enqueteur();

    $enqueteur->setNom($utilisateur->getNom());
    $enqueteur->setPrenom($utilisateur->getPrenom());
    $enqueteur->setDateNaissance($utilisateur->getDateNaissance());
    $enqueteur->setEmail($utilisateur->getEmail());
    $enqueteur->setTel($utilisateur->getTel());
    $enqueteur->setMotDePasse($utilisateur->getMotDePasse());
    $enqueteur->setGenre($utilisateur->getGenre());
    $enqueteur->setCin($utilisateur->getCin());
    $form = $this->createForm(EnqueteurType::class, $enqueteur);
    $form->handleRequest($req);
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($enqueteur);
        $entityManager->flush();
    }
        return $this->render('Enqueteur/inscription.html.twig', [
            'id' => $utilisateur,
            'form' => $form->createView(),
            
        ]);
}
/**
 * @Route("utilisateur/{id}",name="updateutilisateur")
 */
public function updateUtilisateur(Utilisateur $utilisateur,Request $req){
    $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sondage_index');
        }
        

        return $this->render('Utilisateur/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
 * @Route("enqueteur/{id}",name="updateEnqueteur")
 */
public function updateEnqueteur(Enqueteur $enqueteur,Request $req){
    $form = $this->createForm(EnqueteurType::class, $enqueteur);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('updateEnqueteur');
        }
        

        return $this->render('Enqueteur/edit.html.twig', [
            'enqueteur' => $enqueteur,
            'form' => $form->createView(),
        ]);
    }

}



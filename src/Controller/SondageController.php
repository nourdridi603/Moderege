<?php

namespace App\Controller;

use App\Entity\Sondage;
use App\Entity\Question;
use App\Form\SondageType;
use App\Repository\SondageRepository;
use App\Repository\SujetRepository;
use App\Repository\EnqueteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sondage")
 */
class SondageController extends AbstractController
{
    /**
     * @Route("/", name="sondage_index", methods={"GET"})
     */
    public function index(SondageRepository $sondageRepository): Response
    {
        $sondages=$sondageRepository->findAll();
        foreach($sondages as $son)
        {    
            $em1=$this->getDoctrine()->getManager();
            $NbrQuestion =count($em1->getRepository(Question::class)->findByNbrSondage($son->getId()));
            $son->setNbQuestion($NbrQuestion);
            $em1->flush();
        }
        
        return $this->render('sondage/index.html.twig', [
            'sondages' => $sondages
        ]);
    }
    /**
     * @Route("/sondages",name="listesondage",methods="GET")
     */
    public function getSondages(){
        $repo=$this->getDoctrine()->getRepository(Sondage::class);
        $sondages=$repo->findAll();
        
        
        foreach($sondages as $son)
        {    
            $em1=$this->getDoctrine()->getManager();
            $NbrSondage =count($em1->getRepository(Question::class)->findByNbrSondage($son->getId()));
            $son->setNbQuestion($NbrSondage );
            $em1->flush();
        }
        


        return $this->render('sondage/liste_sondage.html.twig',[
            'sondages'=>$sondages
            
        ]);
    }

    /**
     * @Route("/new/{idEnqueteur}/{idSujet}", name="sondage_new", methods={"GET","POST"})
     */
    public function new($idEnqueteur, $idSujet,Request $request,SujetRepository $sujetRepository,EnqueteurRepository $enqueteurRepository): Response
    {
        $sondage = new Sondage();
        $form = $this->createForm(SondageType::class, $sondage);
        $form->handleRequest($request);
        $sujet=$sujetRepository->find($idSujet);
        $enqueteur=$enqueteurRepository->find($idEnqueteur);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $sondage->setSujet($sujet);
            $sondage->setEnqueteur($enqueteur);
            $entityManager->persist($sondage);
            $entityManager->flush();

            return $this->redirectToRoute('consulting',['idSondage'=>$sondage->getId() , 
                                                        'idEnqueteur'=>$idEnqueteur ]);
        }

        return $this->render('sondage/new.html.twig', [
            'sondage' => $sondage,
            'form' => $form->createView(),
            
        ]);
    }

    /**
     * @Route("/{id}", name="sondage_show", methods={"GET"})
     */
    public function show(Sondage $sondage): Response
    {
        return $this->render('sondage/show.html.twig', [
            'sondage' => $sondage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sondage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sondage $sondage): Response
    {
        $form = $this->createForm(SondageType::class, $sondage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sondage_index');
        }

        return $this->render('sondage/edit.html.twig', [
            'sondage' => $sondage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sondage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sondage $sondage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sondage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sondage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sondage_index');
    }
    /**
     * @Route("/sondagee/{id}",name="sondagee")
     * @param $id
     */
    public function getQuestion($id,SondageRepository $sondageRepository){

            $sondage=$sondageRepository->find($id);
            dd($sondage);

    }


    /**
     * @Route("consulting/{idEnqueteur}/{idSondage}", name="consulting", methods={"GET"})
     */
    public function consulting($idEnqueteur, $idSondage): Response
    {
        return $this->render('consulting/index.html.twig',['id'=>$idSondage,
                                                            'idEnqueteur'=> $idEnqueteur]);
    }
}

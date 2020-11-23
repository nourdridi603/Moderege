<?php

namespace App\Controller;

use App\Entity\Sondage;
use App\Form\SondageType;
use App\Repository\SondageRepository;
use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/creer/{id}", name="creersondage", methods={"GET"})
     * @param SondageRepository $sondageRepository
     * @param QuestionRepository $questionRepository
     * @return Response
     */
    public function index($id, SondageRepository $sondageRepository, QuestionRepository $questionRepository): Response
    {
        return $this->render('sondage/creersondage.html.twig', [
            'sondage' => $sondageRepository->find($id),


        ]);
    }

    /**
     * @Route("/sondageBlog", name="sondageBlog", methods={"GET"})
     * @param SondageRepository $sondageRepository
     * @param QuestionRepository $questionRepository
     * @return Response
     */
    public function sondage(SondageRepository $sondageRepository, QuestionRepository $questionRepository): Response
    {
        return $this->render('blog/sondage.html.twig', [
            'sondages' => $sondageRepository->findAll(),


        ]);
    }

    /**
     * @Route("/affichersondage/{id}", name="affichersondage", methods={"GET"})
     * @param SondageRepository $sondageRepository
     * @param QuestionRepository $questionRepository
     * @return Response
     */
    public function affichersondage($id,SondageRepository $sondageRepository, QuestionRepository $questionRepository): Response
    {

        return $this->render('sondage/ajouter.html.twig', [
            'sondagess' => $sondageRepository->find($id),


        ]);
    }


}

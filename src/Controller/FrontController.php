<?php

namespace App\Controller;

use App\Repository\CompetencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    public function __construct(CompetencesRepository $repoComp)
    {
        $this->repoComp = $repoComp;
     }

     
    /**
     * Undocumented function
     *
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('front/index.html.twig');
    }
    /**
     * à propos de moi page
     * 
     * @Route("/apdm", name="apdm_page")
     * @return Response
     */
    public function apdm(): Response
    {
        return $this->render('front/apdm.html.twig');

    }
    /**
     * présentation du bts
     * 
     *  @Route("/bts", name="bts_page")
     * @return Response
     */
    public function bts(): Response
    {
        return $this->render('front/bts.html.twig');
    }
    /**
     * contact
     * 
     *  @Route("/public", name="public_page")
     * @return Response
     */
    public function contact(): Response
    {
        return $this->render('front/public.html.twig');
    }
     /**
     * fonction qui affiche le tableau de compétence
     * 
     * @Route ("/tableauCompetence", name="tableauComp_page")
     * @return Response
     */
    public function tbCompetence(): Response
    {
        $competences = $this->repoComp->findAll();

        return $this->render("front/tableau_comp.html.twig", [
            'competences' => $competences
        ]);
    }
}

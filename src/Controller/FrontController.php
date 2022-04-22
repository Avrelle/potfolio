<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
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
     *  @Route("/contact", name="contact_page")
     * @return Response
     */
    public function contact(): Response
    {
        return $this->render('front/contact.html.twig');
    }
}

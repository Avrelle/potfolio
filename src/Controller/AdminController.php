<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Competences;
use App\Form\CategorieFormType;
use App\Form\CompetenceFormType;
use App\Repository\CategorieRepository;
use App\Repository\CompetencesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    
    public function __construct(EntityManagerInterface $em,CompetencesRepository $repoComp, CategorieRepository $repoCat)
    {
        $this->em = $em;
        $this->repoComp = $repoComp;
        $this->repoCat =$repoCat;
    }
    /**
     * fonction qui affiche la page admin
     * 
     * @Route("/", name="admin") 
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * fonction qui liste les compétences
     * 
     * @Route ("/competences", name="admin.competence.liste")
     * @return Response
     */
    public function indexCompetence(): Response
    {
        $competences = $this->repoComp->findAll();

        return $this->render("admin/competence/index.html.twig", [
            'competences' => $competences
        ]);
    }
    
   

    /**
     * fonction qui créer comptences
     *
     * @Route ("/createComp", name="admin.competence.create")
     * @return Response
     */
    public function createCompetence(Request $request,): Response
    {
        $competence = new Competences();
        $form = $this->createForm(CompetenceFormType::class, $competence);
        $form -> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($competence);
            $this->em->flush();

            return $this->redirectToRoute('admin.competence.liste');
        }
        
        return $this->render("admin/competence/create.html.twig",
        [
            'form' => $form->createView(),
        ]);
    }

   
     /**
     * fonction qui edit comptences
     *
     * @Route ("/editComp/{id}", name="admin.competence.edit")
     * @return Response
     */
    public function editCompetence($id, Request $request,): Response
    {
        $competence = $this->repoComp->find(['id'=> $id]);
        $form = $this->createForm(CompetenceFormType::class, $competence);
        $form -> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
            $this->addFlash('success', 'Competence modifié !');

            return $this->redirectToRoute('admin.competence.liste');
        }
        
        return $this->render("admin/competence/create.html.twig",
        [
            'form' => $form->createView(),
        ]);
    }

      /**
     * fonction qui supprime compétences
     *
     * @Route ("/deleteComp/{id}", name="admin.competence.delete")
     * @return Response
     */

    public function deleteCompetence(Request $request, Competences $competence, int $id): Response
    {
        if ($this->isCsrfTokenValid('delete' . $competence->getId(), $request->get('_token')))
        {   
            $this->em->remove($competence);
            $this->em->flush();
            $this->addFlash('success', 'Competence supprimé !');

           
        }
        
        return $this->redirectToRoute('admin.competence.liste');
    }

         
    /**
     * page qui affiche la liste des catégories
     * 
     * @Route("/categorie", name="admin.categorie.show")
     * @return Response
     */
    public function indexCategorie(): Response
    {
        $categories = $this->repoCat->findAll();
        
        return $this->render("admin/categorie/index.html.twig",[
            "categories" => $categories
        ]);

    }
     /**
     * fonction qui créer categorie
     *
     * @Route ("/createCat", name="admin.categorie.create")
     * @return Response
     */
    public function createCategorie(Request $request,): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieFormType::class, $categorie);
        $form -> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($categorie);
            $this->em->flush();

            return $this->redirectToRoute('admin.categorie.show');
        }
        
        return $this->render("admin/categorie/create.html.twig",
        [
            'form' => $form->createView(),
        ]);
    }

     /**
     * fonction qui edit Categorie
     *
     * @Route ("/editCat/{id}", name="admin.categorie.edit")
     * @return Response
     */
    public function editCategorie($id, Request $request,): Response
    {
        $categorie = $this->repoCat->find(['id'=> $id]);
        $form = $this->createForm(CategorieFormType::class, $categorie);
        $form -> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
            $this->addFlash('success', 'Categorie modifié !');

            return $this->redirectToRoute('admin.categorie.show');
        }
        
        return $this->render("admin/categorie/create.html.twig",
        [
            'form' => $form->createView(),
        ]);
    }

     /**
     * fonction qui supprime categorie
     *
     * @Route ("/deleteCat/{id}", name="admin.categorie.delete")
     * @return Response
     */

    public function deleteCategorie($id, Request $request, Categorie $categorie): Response
    {

        if ($this->isCsrfTokenValid('delete' . $categorie->getId(), $request->get('_token')))
        {   
            $this->em->remove($categorie);
            $this->em->flush();
            $this->addFlash('success', 'Categorie supprimé !');

           
        }
        
        return $this->redirectToRoute('admin.categorie.show');
    }

}





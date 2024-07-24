<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

#[Route('/recette', name: 'app_recette')]
class RecetteController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(RecetteRepository $repository): Response
    {
        return $this->render('recette/index.html.twig', [
            'recetteTableau' => $repository->findAll(),
        ]);
    }
    #[Route('/create' , name : 'create')]
    public function create(Request $request,EntityManagerInterface $em):Response
    {
        $recette = new Recette();
        $slugger = new AsciiSlugger();
        $form = $this->createForm(RecetteType::class , $recette);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $recette->getSlug($slugger->slug($recette->getNom())->lower());
            $em->persist($recette);
            $em->flush();
        }
        return $this->render('recette/create.html.twig',[
            'form'=>$form
        ]);
    }


}

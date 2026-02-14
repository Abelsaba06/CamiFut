<?php

namespace App\Controller;

use App\Form\CamisetaFormType;
use App\Repository\CamisetaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CamisetaController extends AbstractController
{
    #[Route(path: "/crear/camiseta", name: "crearCamiseta")]
    public function crearCamiseta(Request $request, EntityManagerInterface $entityManager, CamisetaFormType $camisetaform): Response
    {
        $form = $this->createForm(CamisetaFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $camiseta = $form->getData();
            $entityManager->persist($camiseta);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('page/camisetes/creaciocamisetes.html.twig', [
            'controller_name' => 'CamisetaController',
            'camisetaform' => $form->createView()
        ]);
    }
    #[Route(path: '/camisetes', name: 'camisetes')]
    public function camisetes(CamisetaRepository $camisetaRepository): Response
    {
        $camisetas = $camisetaRepository->findAll();
        return $this->render('page/camisetes/camisetes.html.twig', [
            'camisetas' => $camisetas
        ]);
    }
    #[Route('/camiseta/{id}', name: 'camiseta')]
    public function index(int $id, CamisetaRepository $camisetaRepository): Response
    {
        $camiseta = $camisetaRepository->find($id);
        return $this->render('page/camisetes/detall.html.twig', [
            'camiseta' => $camiseta
        ]);
    }
}

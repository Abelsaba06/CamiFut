<?php

namespace App\Controller;

use App\Repository\CategoriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

final class PageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoriaRepository $categoriaRepository): Response
    {
        $categorias=$categoriaRepository->findAll();
        return $this->render('page/index.html.twig',['categorias'=>$categorias]);
    }
    
}

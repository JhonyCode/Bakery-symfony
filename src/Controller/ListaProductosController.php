<?php

namespace App\Controller;

use App\Entity\ListaProductos;
use App\Form\ListaProductosType;
use App\Repository\ListaProductosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/lista/productos')]
class ListaProductosController extends AbstractController
{
    #[Route('/', name: 'app_lista_productos_index', methods: ['GET'])]
    public function index(ListaProductosRepository $listaProductosRepository): Response
    {
        return $this->render('lista_productos/index.html.twig', [
            'lista_productos' => $listaProductosRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lista_productos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $listaProducto = new ListaProductos();
        $form = $this->createForm(ListaProductosType::class, $listaProducto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($listaProducto);
            $entityManager->flush();

            return $this->redirectToRoute('app_lista_productos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lista_productos/new.html.twig', [
            'lista_producto' => $listaProducto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lista_productos_show', methods: ['GET'])]
    public function show(ListaProductos $listaProducto): Response
    {
        return $this->render('lista_productos/show.html.twig', [
            'lista_producto' => $listaProducto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lista_productos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ListaProductos $listaProducto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ListaProductosType::class, $listaProducto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_lista_productos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lista_productos/edit.html.twig', [
            'lista_producto' => $listaProducto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lista_productos_delete', methods: ['POST'])]
    public function delete(Request $request, ListaProductos $listaProducto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listaProducto->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($listaProducto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_lista_productos_index', [], Response::HTTP_SEE_OTHER);
    }
}

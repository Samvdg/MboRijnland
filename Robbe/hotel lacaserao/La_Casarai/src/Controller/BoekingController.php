<?php

namespace App\Controller;

use App\Entity\Boeking;
use App\Form\BoekingType;
use App\Repository\BoekingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/boeking")
 */
class BoekingController extends AbstractController
{
    /**
     * @Route("/", name="boeking_index", methods={"GET"})
     */
    public function index(BoekingRepository $boekingRepository): Response
    {
        return $this->render('boeking/index.html.twig', [
            'boekings' => $boekingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="boeking_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $boeking = new Boeking();
        $form = $this->createForm(BoekingType::class, $boeking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($boeking);
            $entityManager->flush();

            return $this->redirectToRoute('boeking_index');
        }

        return $this->render('boeking/new.html.twig', [
            'boeking' => $boeking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="boeking_show", methods={"GET"})
     */
    public function show(Boeking $boeking): Response
    {
        return $this->render('boeking/show.html.twig', [
            'boeking' => $boeking,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="boeking_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Boeking $boeking): Response
    {
        $form = $this->createForm(BoekingType::class, $boeking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('boeking_index', [
                'id' => $boeking->getId(),
            ]);
        }

        return $this->render('boeking/edit.html.twig', [
            'boeking' => $boeking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="boeking_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Boeking $boeking): Response
    {
        if ($this->isCsrfTokenValid('delete'.$boeking->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($boeking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('boeking_index');
    }

    public function getFreeRooms
}

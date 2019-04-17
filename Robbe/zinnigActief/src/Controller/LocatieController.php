<?php

namespace App\Controller;

use App\Entity\Locatie;
use App\Form\LocatieType;
use App\Repository\LocatieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/locatie")
 */
class LocatieController extends AbstractController
{
    /**
     * @Route("/", name="locatie_index", methods={"GET"})
     */
    public function index(LocatieRepository $locatieRepository): Response
    {
        return $this->render('locatie/index.html.twig', [
            'locaties' => $locatieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="locatie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $locatie = new Locatie();
        $form = $this->createForm(LocatieType::class, $locatie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($locatie);
            $entityManager->flush();

            return $this->redirectToRoute('locatie_index');
        }

        return $this->render('locatie/new.html.twig', [
            'locatie' => $locatie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="locatie_show", methods={"GET"})
     */
    public function show(Locatie $locatie): Response
    {
        return $this->render('locatie/show.html.twig', [
            'locatie' => $locatie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="locatie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Locatie $locatie): Response
    {
        $form = $this->createForm(LocatieType::class, $locatie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('locatie_index', [
                'id' => $locatie->getId(),
            ]);
        }

        return $this->render('locatie/edit.html.twig', [
            'locatie' => $locatie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="locatie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Locatie $locatie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$locatie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($locatie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('locatie_index');
    }
}

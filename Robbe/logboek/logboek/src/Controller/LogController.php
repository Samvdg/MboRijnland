<?php

namespace App\Controller;

use App\Entity\Log;
use App\Form\LogType;
use App\Repository\LogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/log")
 */
class LogController extends AbstractController
{
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/", name="log_index", methods={"GET"})
     */
    public function index(LogRepository $logRepository): Response
    {
        if ($this->security->isGranted('ROLE_ADMIN')){
            $logs = $logRepository->findAll();

        } elseif($this->security->isGranted('ROLE_DRIVER') || $this->security->isGranted('ROLE_USER')) {
            $logs = $logRepository->findAlmostAll($this->getUser()->getId());
        }
        return $this->render('log/index.html.twig',[
            'logs' => $logs,
        ]);
    }

    /**
     * @Route("/new", name="log_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $log = new Log();
        $form = $this->createForm(LogType::class, $log);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($log);
            $entityManager->flush();

            return $this->redirectToRoute('log_index');
        }

        return $this->render('log/new.html.twig', [
            'log' => $log,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="log_show", methods={"GET"})
     */
    public function show(Log $log): Response
    {
        return $this->render('log/show.html.twig', [
            'log' => $log,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="log_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Log $log): Response
    {
        $form = $this->createForm(LogType::class, $log);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('log_index', [
                'id' => $log->getId(),
            ]);
        }

        return $this->render('log/edit.html.twig', [
            'log' => $log,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="log_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Log $log): Response
    {
        if ($this->isCsrfTokenValid('delete'.$log->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($log);
            $entityManager->flush();
        }

        return $this->redirectToRoute('log_index');
    }
}


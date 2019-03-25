<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LogboekController extends AbstractController
{
    /**
     * @Route("/logboek", name="logboek")
     */
    public function index()
    {
        return $this->render('logboek/index.html.twig', [
            'controller_name' => 'LogboekController',
        ]);
    }
}

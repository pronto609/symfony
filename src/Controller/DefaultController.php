<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/lox/{var}', name: 'app_default', methods: 'GET')]
    public function index($var): Response
    {
//        return new Response($var);
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'var' => $var
        ]);
    }
}

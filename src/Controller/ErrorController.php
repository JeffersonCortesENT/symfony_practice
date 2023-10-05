<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    /**
     * @Route("/error_404", name="app_error_404")
     */
    public function pageNotFound(): Response
    {
        return $this->render('error/404.html.twig', [
            'controller_name' => 'ErrorController',
        ])->setStatusCode(Response::HTTP_NOT_FOUND);
    }

    /**
     * @Route("/error_500", name="app_error_500")
     */
    public function internalServerError(): Response
    {
      return $this->render('error/500.html.twig', [])->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

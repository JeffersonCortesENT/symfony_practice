<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/", name="view_index")
     */
    public function index(): Response
    {
        return $this->render('view/index.html.twig', [
            'controller_name' => 'ViewController',
        ]);
    }

    /**
     * @Route("/number", name="view_number")
     */
    public function number(LoggerInterface $logger): Response
    {
      $number = random_int(0, 100);

      return $this->numberView($number, $logger);
    }

    /**
     * @Route("/number/{max}", name="view_number_max")
     */
    public function number_max(int $max, LoggerInterface $logger): Response
    {
      $number = random_int(0, $max);

      return $this->numberView($number, $logger);
    }

    private function numberView(int $number, LoggerInterface $logger): Response
    {
      $logger->info('Recorded Number: '. $number);

      return $this->render('view/number.html.twig', [
        'number' => $number
      ]);
    }
}

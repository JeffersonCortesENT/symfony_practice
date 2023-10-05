<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ParamConverterExceptionListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof BadRequestHttpException) {
            // Handle the BadRequestHttpException here
            $response = new Response('Bad Request!', 400);
            $event->setResponse($response);
        } elseif ($exception instanceof NotFoundHttpException) {
          // Handle the NotFoundHttpException here
          $response = new Response('Not Found!', 404);
          $event->setResponse($response);
        }
    }
}


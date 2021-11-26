<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\ErrorHandler\Exception\FlattenException;

class CatchErrorsController extends AbstractController
{
    public function show(FlattenException $exception): Response
    {
        return $this->json([
            'message' => $exception->getStatusText()
        ], $exception->getStatusCode());
    }

}
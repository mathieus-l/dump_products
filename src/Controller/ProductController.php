<?php

namespace App\Controller;

use App\Entity\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product", methods={"GET"})
     */
    public function index(): Response
    {

	$em = $this->getDoctrine()->getManager();
        
        $products = $em->getRepository(Product::class)->findAll();
        
        return $this->json([
            'products' => $products,
        ]);
    }
}

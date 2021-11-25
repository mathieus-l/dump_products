<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="products", methods={"GET"})
     */
    public function list(): Response
    {

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository(Product::class)->findAllAsArray();
        return $this->json(
            $products,
        );
    }
    /**
     * @Route("/product/{product_id}", name="product", methods={"POST"})
     */
    public function read(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('product_id');
        $product = $em->getRepository(Product::class)->findAsArray($id);
        return $this->json([
            'product' => $product,
        ]);
    }
    /**
     * @Route("/product_add", name="product_add", methods={"POST"})
     */
    public function add(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $product = new Product();
        $product->setName($request->request->get('name'));
        $product->setDescription($request->get('description'));
        $product->setPrice($request->get('price'));
        $product->setModelYear($request->get('model_year'));
        $em->persist($product);
        $em->flush();
        return $this->json([
            'id' => $product->getId(),
        ]);
    }
    /**
     * @Route("/product_edit_field/{product_id}/",
     *       name="product_edit", methods={"PUT"})
     */
    public function editName(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($request->get('product_id'));
        $product->setName($request->get('name'));
        $product->setDescription($request->get('description'));
        $product->setPrice($request->get('price'));
        $product->setModelYear($request->get('model_year'));
        $em->persist($product);
        $em->flush();
        return $this->json([
            'id' => $product->getId(),
        ]);
    }
}

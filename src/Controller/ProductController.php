<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="products", methods={"GET"})
     */
    public function list(): Response
    {

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository(Product::class)->findAllAsArray();
        return $this->json([
            'products' => $products,
        ]);
    }
    /**
     * @Route("/product/{product_id}", name="product", methods={"GET"})
     */
    public function read(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('product_id');
        $product = $em->getRepository(Product::class)->findAsArray($id);
        if (empty($product)) {
            throw $this->createNotFoundException('Product with id: ' . $id . ' does not exist');
        }
        return $this->json([
            'product' => $product,
        ]);
    }
    /**
     * @Route("/product_add", name="product_add", methods={"PUT"})
     */
    public function add(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $product = new Product();
        $data = json_decode($request->getContent(), true);
        if ($data == null) {
            throw $this->createNotFoundException('Not valid Json input datas');
        }
        if (
            !array_key_exists('name', $data) ||
            !array_key_exists('description', $data)     ||
            !array_key_exists('price', $data) ||
            !array_key_exists('model_year', $data)
        ) {
            throw $this->createNotFoundException('Not all needed parameters (name, description, price, model_year)');
        }
        $product->setName($data['name']);
            $product->setDescription($data['description']);
        $product->setPrice($data['price']);
        $product->setModelYear($data['model_year']);
        $em->persist($product);
        $em->flush();
        return $this->json([
            'id' => $product->getId(),
        ]);
    }
    /**
     * @Route("/product_edit/{product_id}/",
     *       name="product_edit", methods={"PUT"})
     */
    public function editProduct(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($request->get('product_id'));
        if (empty($product)) {
            throw $this->createNotFoundException('Product with id: ' . $id . ' does not exist');
        }
        $data = json_decode($request->getContent(), true);
        if ($data == null) {
            throw $this->createNotFoundException('Not valid Json input datas');
        }
        if (array_key_exists('name', $data)) {
            $product->setName($data['name']);
        }
        if (array_key_exists('description', $data)) {
            $product->setDescription($data['description']);
        }
        if (array_key_exists('price', $data)) {
            $product->setPrice($data['price']);
        }
        if (array_key_exists('model_year', $data)) {
            $product->setModelYear($data['model_year']);
        }

        $em->persist($product);
        $em->flush();
        return $this->json([
            'id' => $product->getId(),
        ]);
    }
    /**
     * @Route("/product_remove/{product_id}/",
     *       name="product_remove", methods={"DELETE"})
     */
    public function removeProduct(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($request->get('product_id'));
        if (empty($product)) {
            throw $this->createNotFoundException('Product with id: ' . $id . ' does not exist');
        }

        $em->remove($product);
        $em->flush();
        return $this->json([
            'message' => 'product removed',
        ]);
    }
}

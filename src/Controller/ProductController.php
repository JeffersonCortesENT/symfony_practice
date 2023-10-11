<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/save", name="create_product")
     */
    public function createProduct(ValidatorInterface $validator): Response
    {
        $category = new Category();
        $category->setName('Computer Peripherals');

        $product = new Product();
        $product->setName('Keyboarders');
        $product->setDescription('Ergonomic and stylish!');
        $product->setPrice(499);

        // relates this product to the category
        $product->setCategory($category);

        $errors = $validator->validate($product);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($category);
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    /**
     * @Route("/product/{id}", name="get_product")
     */
    public function getProduct(int $id): Response
    {
        //Param Converter Version
        // try {
        //   return new Response('Check out this great product: '.$product->getName());
        // } catch (\Exception $oError) {
        //   return new Response($oError->getMessage());
        // }

        // $product = $this->getDoctrine()
        // ->getRepository(Product::class)
        // ->find($id);

        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findOneByIdJoinedToCategory($id);

        $category = $product->getCategory();

        if (!$product) {
          throw $this->createNotFoundException(
              'No product found for id '. $id
          );
        }

        //$categoryName = $product->getCategory()->getName();

        return new Response('Check out this great product: '.$product->getName(). ' on Category: '. $category->getName());
    }

    /**
     * @Route("/product/update/{id}")
     */
    public function update(int $id, ValidatorInterface $validator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            return new Response((string) 'No product found for id '. $id, 400);
        }

        $product->setName('New Product Name');
        $entityManager->flush();

        return $this->redirectToRoute('get_product', [
            'id' => $product->getId()
        ]);
    }

    /**
     * @Route("/product/delete/{id}")
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            return new Response((string) 'No product found for id '. $id, 400);
        }

        $oldId = $product->getId();

        $entityManager->remove($product);
        $entityManager->flush();

        return new Response('Product '. $oldId .' was deleted!');
    }

    /**
     * @Route("/product/greater_price/{price}")
     */
    public function getProductByMinPrice(int $price)
    {
      $entityManager = $this->getDoctrine()->getManager();
      $product = $entityManager->getRepository(Product::class)->findAllGreaterThanPrice($price);

      dd($product);
    }
}

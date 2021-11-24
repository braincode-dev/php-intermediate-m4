<?php

namespace App\Controllers;

use App\Database\config\EntityManagerBuilder;
use App\Database\Models\Product;

class ProductController
{
    private $entityManager;
    private $url;

    public function __construct($entityManager, $url)
    {
        $this->entityManager = $entityManager;
        $this->url = $url;
    }

    public function index()
    {
        $query = $this->entityManager
            ->getRepository(Product::class)
            ->createQueryBuilder('product');

        $result = $query->getQuery()
            ->getResult();

        return $this->view($result);
    }

    public function create($post)
    {
        $product = new Product();
        $this->save($product, $post);
    }

    public function update($post)
    {
        $product = $this->entityManager
            ->getRepository(Product::class)
            ->findOneBy(['id' => $post['id']]);
        $this->save($product, $post);
    }

    public function save($product, $request)
    {
        $product->setTitle($request['title'])
            ->setPrice($request['price'])
            ->setDescription($request['description']);

        $this->entityManager->persist($product);
        $this->entityManager->flush();
        $this->index();
    }

    public function remove($id)
    {
        $product = $this->entityManager
            ->getRepository(Product::class)
            ->findOneBy(['id' => $id]);

        $this->entityManager->remove($product);
        $this->entityManager->flush();

        header('Location: index.php');
    }

    public function getAllProducts($products)
    {
        $content = '';
        foreach ($products as $product) {
            $content = $content . sprintf("
            <div class='col-md-4 mb-4'>
                <div class='card'>
                  <div class='card-body'>
                    <h5 class='card-title'>%s</h5>
                    <h6 class='card-subtitle mb-2 text-muted'>%d$</h6>
                    <p class='card-text' style='min-height: 100px;'>%s...</p>
                    <button type='button' class='btn btn-primary card-link update-product' data-id='%d'>Update</button>
                    <a href='?remove=%d' class='card-link'>Remove</a>
                  </div>
                </div>
            </div>
            ",
                    $product->getTitle(),
                    $product->getPrice(),
                    mb_substr($product->getDescription(), 0, 150),
                    $product->getId(),
                    $product->getId(),
                    );
        }

        return $content;
    }

    public function view($products)
    {
        $index = file_get_contents('Views/index.html');
        echo str_replace(
            ['{PRODUCTS}'],
            [$this->getAllProducts($products)],
            $index,
            );
    }
}
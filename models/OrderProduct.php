<?php

require_once "repositories/ProductsRepository.php";
class OrderProduct{

    public $id;
    public $order_id;
    public $product_id;
    public $quantity;
    public $price;

    /**
    *
    */
    public function getProduct()
    {
        if ($this->product_id){
            $config = require "config.php";
            $pdo = Connection::make($config['database']);
            $productsRepository = new ProductRepository($pdo);

            $pdo = null;

            return $productsRepository->findById($this->product_id);
        }
    }
}
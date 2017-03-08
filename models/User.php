<?php

require_once "repositories/OrderRepository.php";
class User{
    public $id;
    public $name;
    public $phone_number;
    public $email;
    public $address;
    public $username;
    public $password;
    public $role_id;
    
    
    /**
    * get Shopping_cart_id ( orderid) of User
    */
    public function getShoppingCartId()
    {
        // Kiểm tra xem User hiện tại đã có order mà chưa hoàn thành ko ( giỏ hàng)
        // Nếu chưa thì thêm 1 order mới sau đó thêm 1 sản phẩm vào bảng order_product.
        // Nếu có rồi thì chỉ cần thêm sản phẩm vào order_product là được

        $config = require "config.php";
        $pdo = Connection::make($config['database']);
        $orderRepository = new OrderRepository($pdo);
        $pdo = null;

        $orders = $orderRepository->findByAttributeArray(["user_id" => $this->id, "is_completed" => 0]);

        if (count($orders) == 0){
            // Tạo ra 1 order mới.
            $orderRepository->insert([
                "user_id" => $this->id,
                "created_at" => date("Y-m-d H:i:s"),
                "is_delivered" => false,
                "is_completed" => false
            ]);

            $order = $orderRepository->findByAttributeArray(["user_id" => $this->id, "is_completed" => 0]);

            return $order->id;
        }

        return count($orders) > 1 ? $orders[0]->id : $orders->id;

    }
}
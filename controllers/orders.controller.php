<?php

require_once "models/User.php";
require_once "repositories/ProductsRepository.php";
require_once "repositories/OrderProductRepository.php";
require_once "repositories/OrderRepository.php";
class OrdersController
{

    /**
    *
    */
    public function __construct()
    {
        if (! $_SESSION['login']){
            return redirectWithErrorSession(route(), "Bạn phải đăng nhập thì mới thao tác được với giỏ hàng");
        }
    }

    protected $productsRepository;
    protected $orderproductRepository;
    protected $ordersRepository;


    /**
    *
    */
    protected function setOrderRepository()
    {
        $config = require "config.php";
        $pdo = Connection::make($config['database']);

        $this->ordersRepository = new OrderRepository($pdo);
    }


    /**
    *
    */
    protected function setProductsRepository()
    {
        $config = require "config.php";
        $pdo = Connection::make($config['database']);

        $this->productsRepository = new ProductRepository($pdo);
    }

    /**
    *
    */
    protected function setOrderProductRepository()
    {
        $config = require "config.php";
        $pdo = Connection::make($config['database']);

        $this->orderproductRepository = new OrderProductRepository($pdo);
    }


    public function insertShoppingCartItem()
    {
        if (!isset($_GET['id'])) {
            return redirectWithErrorSession(route("pages", "shoppingCart"), "Có lỗi khi thêm mới 1 sản phẩm vào giỏ hàng");
        }


        // Kiểm tra xem User hiện tại đã có order mà chưa hoàn thành ko ( giỏ hàng)
        // Nếu chưa thì thêm 1 order mới sau đó thêm 1 sản phẩm vào bảng order_product.
        // Nếu có rồi thì chỉ cần thêm sản phẩm vào order_product là được
        $productId = $_GET['id'];
        $this->setProductsRepository();
        $price = $this->productsRepository->findById($productId)->price;

        $user = unserialize($_SESSION['currentUser']);
        $shoppingCartId = $user->getShoppingCartId();

        // Kiểm tra xem trong giỏ hàng đã có sản phẩm này chưa
        // Nếu chưa có thì thêm mới 1 sản phẩm vào giỏ hàng
        // Còn nếu không thì cộng thêm 1 vào số lượng của sản phẩm trong giỏ hàng


        $this->setOrderProductRepository();
        $orderProduct = $this->orderproductRepository->findByAttributeArray([
            "order_id" => $shoppingCartId,
            "product_id" => $productId
        ]);

        if ($orderProduct){
            $this->orderproductRepository->update($orderProduct, [
                "quantity" => $orderProduct->quantity + 1
            ]);
        }else{

            $this->orderproductRepository->insert([
                "order_id" => $shoppingCartId,
                "product_id" => $productId,
                "price" => $price,
                "quantity" => 1
            ]);
        }


        return redirectWithMessageSession(route("pages", "shoppingCart"), "Thêm mới 1 sản phẩm vào giỏ hàng thành công");
    }

    /**
    *
    */
    public function removeShoppingCartItem()
    {
        if (!isset($_GET["order_id"])){
            return redirectWithErrorSession(route(), "Có lỗi xảy ra khi cập nhật giỏ hàng");
        }

        if (!isset($_GET["product_id"])){
            return redirectWithErrorSession(route(), "Có lỗi xảy ra khi cập nhật giỏ hàng");
        }

        $orderId = $_GET["order_id"];
        $productId = $_GET["product_id"];

        $this->setOrderProductRepository();

        if ($this->orderproductRepository->deleteByOrderIdAndProductID($orderId, $productId)){
            return redirectWithMessageSession(route("pages", "shoppingCart"), "Xóa sản phẩm khỏi giỏ hàng thành công");
        }

        return redirectWithErrorSession(route("pages", "shoppingCart"), "Xóa sản phẩm khỏi giỏ hàng thất bại");
    }


    /**
    *
    */
    public function update()
    {
        if (!$_POST['order_id']){
            return redirectWithErrorSession(route(), "Có lỗi xảy ra khi cập nhật giỏ hàng");
        }

        if (!$_POST['quantity']){
            return redirectWithErrorSession(route(), "Có lỗi xảy ra khi cập nhật giỏ hàng");
        }

        $orderId = $_POST['order_id'];
        $quantities = $_POST['quantity'];

        $this->setOrderProductRepository();

        if (count($quantities) > 0){
            foreach ($quantities as $productId => $quantity) {
                $orderProduct = $this->orderproductRepository->findByAttributeArray([
                   "order_id" => $orderId,
                    "product_id" => $productId
                ]);

                $this->orderproductRepository->update($orderProduct, [
                   "quantity" => $quantity
                ]);
            }
        }

        return redirectWithMessageSession(route("pages", "shoppingCart"), "Cập nhật giỏ hàng thành công");

    }


    /**
    *
    */
    public function order()
    {
        if (!$_GET['order_id']){
            return redirectWithErrorSession(route("pages", "shoppingCart"), "Có lỗi khi đặt hàng");
        }

        $orderId = $_GET['order_id'];

        $this->setOrderRepository();

        $this->ordersRepository->updateById($orderId, [
           "is_completed" => 1
        ]);

        return redirectWithMessageSession(route(), "Đặt hàng thành công");
    }
}
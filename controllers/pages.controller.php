<?php

require_once "repositories/ProductsRepository.php";
require_once "repositories/OrderProductRepository.php";
require_once "models/User.php";
class PagesController
{


    /**
     * @var MenuRepository
     */
    private $menuRepository;

    private $productRepository;

    private $orderProductRepository;

    public function __construct(MenuRepository $menuRepository)
    {


        $this->menuRepository = $menuRepository;
    }


    public function index()
    {
        $this->home();
    }


    /**
    *
    */
    protected function setProductRepository()
    {
        $config = require "config.php";
        $pdo = Connection::make($config['database']);
        $this->productRepository = new ProductRepository($pdo);
    }

    protected function setOrderProductRepository()
    {
        $config = require "config.php";
        $pdo = Connection::make($config['database']);
        $this->orderProductRepository = new OrderProductRepository($pdo);
    }


    /**
     *
     */
    public function home()
    {
        $title = "Trang chủ";

        $this->setProductRepository();
        $maleProductId = $this->menuRepository->findBy("name", "SANPHAMNAM")->id;
        $femaleProductId = $this->menuRepository->findBy("name", "SANPHAMNU")->id;

        $maleProducts = $this->productRepository->findBy("menu_id", $maleProductId);
        $femaleProducts = $this->productRepository->findBy("menu_id", $femaleProductId);


        // Lấy danh sách sản phẩm ở đây
        require "views/pages/home.view.php";
    }


    /**
     *
     */
    public function error()
    {
        require "views/pages/error.view.php";
    }


    /**
     *
     */
    public function maleProducts()
    {

        $title = "Sản phẩm Nam";

        $this->setProductRepository();
        $maleProductId = $this->menuRepository->findBy("name", "SANPHAMNAM")->id;

        $maleProducts = $this->productRepository->findBy("menu_id", $maleProductId);

        require "views/pages/male_products.view.php";
    }


    /**
     *
     */
    public function femaleProducts()
    {

        $title = "Sản phẩm Nữ";

        $this->setProductRepository();
        $femaleProductId = $this->menuRepository->findBy("name", "SANPHAMNU")->id;

        $femaleProducts = $this->productRepository->findBy("menu_id", $femaleProductId);

        require "views/pages/female_products.view.php";
    }

    /**
     *
     */
    public function shoppingCart()
    {
        if (! $_SESSION['login']){
            return redirectWithErrorSession(route(), "Bạn phải đăng nhập thì mới vào xem được giỏ hàng");
        }

        // Kiểm tra xem User hiện tại đã có order mà chưa hoàn thành ko ( giỏ hàng)
        $user = unserialize($_SESSION['currentUser']);
        $shoppingCartId = $user->getShoppingCartId();

        $this->setOrderProductRepository();
        $shoppingCartItems = $this->orderProductRepository->findByAttributeArray([
            "order_id" => $shoppingCartId
        ]);

        if (!is_array($shoppingCartItems)){
            $shoppingCartItems = [$shoppingCartItems];
        }

        require "views/pages/shopping_cart.view.php";
    }

    /**
     *
     */
    public function showProduct()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->setProductRepository();

            $product = $this->productRepository->findById($id);

            if (! $product) {
                $_SESSION['error'] = "Không tồn tại sản phẩm mà bạn cần tìm";
            }
        }else{
            $_SESSION['error'] = "Không tồn tại sản phẩm mà bạn cần tìm";
        }

        return require "views/pages/detail_products.view.php";

    }

}
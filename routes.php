<?php
require_once "repositories/MenuRepository.php";
require_once "repositories/MenuTypeRepository.php";
require_once "repositories/UserRepository.php";
require_once "repositories/ProductsRepository.php";
require_once "repositories/OrderRepository.php";
require_once "repositories/OrderProductRepository.php";

function call($controller, $action, $role = null)
{
    global $pdo;

    if ($role == 'admin') {

        // Kiểm tra xem user hiện tại có quyền admin không
        if(Utils::getUser()->role_id != 1){
            return redirectWithErrorSession(route(), "Bạn không có quyền truy cập! vui lòng liên hệ admin của hệ thống");
        }

        require "controllers/admin/" . $controller . ".controller.php";
    } else {
        require "controllers/" . $controller . ".controller.php";
    }

    switch ($controller) {
        case 'pages':
            $menuRepository = new MenuRepository($pdo);
            $controller = new PagesController($menuRepository);

            break;

        case 'menu_types':
            $menuTypeRepository = new MenuTypeRepository($pdo);
            $controller = new MenuTypesController($menuTypeRepository);
            break;

        case 'menus':
            $menuRepository = new MenuRepository($pdo);
            $menuTypeRepository = new MenuTypeRepository($pdo);
            $controller = new MenusController($menuRepository, $menuTypeRepository);

            break;

        case 'auth':
            $userRepository = new UserRepository($pdo);
            $controller = new AuthController($userRepository);
            break;

        case 'admin':

            $controller = new AdminController();

            break;

        case 'products':
            $menuRepository = new MenuRepository($pdo);
            $productsRepository = new ProductRepository($pdo);

            $controller = new ProductsController($productsRepository, $menuRepository);

            break;


        case 'orders':
            $controller = new OrdersController();
            break;

        case 'admin.orders':
            $ordersRepository = new OrderRepository($pdo);
            $orderProductRepository = new OrderProductRepository($pdo);


            $controller = new AdminOrderController($ordersRepository, $orderProductRepository);
            break;
    }

    $controller->$action();
}


//<editor-fold desc="Get query string paramater ( role, controller, action)">
if (isset($_GET['role'])) {
    $role = $_GET['role'];
}

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'index';
    }
} else {
    $controller = 'pages';
    $action = 'index';
}
//</editor-fold>

//<editor-fold desc="Register all routes">
$controllers = [
    'pages' => ['index', 'home', 'error', 'shoppingCart', 'maleProducts', 'femaleProducts', 'showProduct'],
    'orders' => ['insertShoppingCartItem', 'removeShoppingCartItem', 'update', 'order'],
    'menu_types' => ['index', 'store', 'update', 'edit', 'destroy'],
    'menus' => ['index', 'store', 'update', 'edit', 'destroy'],
    'admin' => ['changePassword', 'showChangePasswordForm'],
    'auth' => ['login', 'register', 'showLoginForm', 'showRegistrationForm', 'logout'],
    'products' => ['index', 'store', 'update', 'edit', 'destroy', 'create'],
    'admin.orders' => ['index', 'destroy', 'deliveredToggle', 'show']
];
//</editor-fold>

if (array_key_exists($controller, $controllers) && in_array($action, $controllers[$controller])) {
    call($controller, $action, isset($role) ? $role : null);
} else {
    call('pages', 'error');
}
<?php


class AdminOrderController
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var OrderProductRepository
     */
    private $orderProductRepository;

    /**
     *
     */
    public function __construct(OrderRepository $orderRepository, OrderProductRepository $orderProductRepository)
    {

        $this->orderRepository = $orderRepository;
        $this->orderProductRepository = $orderProductRepository;
    }

    public function index()
    {
        $title = "Quản lý đặt hàng";

        $orders = $this->orderRepository->all();


        require "views/admin/orders/index.view.php";
    }


    /**
     *
     */
    public function destroy()
    {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $this->orderRepository->destroy($id);
            return redirectWithMessageSession(route("admin.orders", "index", "admin"), "Xóa thành công");
        }

        return redirectWithErrorSession(route("admin.orders", "index", "admin"), "Xảy ra lỗi khi xóa");
    }

    /**
     *
     */
    public function deliveredToggle()
    {
        if (!$_GET['id']) {
            return redirectWithErrorSession(route("admin.orders", "index", "admin"), "Xảy ra lỗi khi thao tác");
        }

        $id = $_GET['id'];

        $order = $this->orderRepository->findById($id);


        if ($order) {

            $this->orderRepository->updateById($id, [
                "is_delivered" => !$order->is_delivered
            ]);
            return redirectWithMessageSession(route("admin.orders", "index", "admin"), "Chuyển trạng thái thành công");
        }

        return redirectWithErrorSession(route("admin.orders", "index", "admin"), "Xảy ra lỗi khi thao tác");
    }

    /**
     *
     */
    public function show()
    {
        if (!isset($_GET['id'])) {
            return redirectWithErrorSession(route("admin.orders", "index", "admin"), "Xảy ra lỗi khi thao tác");
        }

        $id = $_GET['id'];

        $order = $this->orderRepository->findById($id);

        if (!$order) {
            return redirectWithErrorSession(route("admin.orders", "index", "admin"), "Xảy ra lỗi khi thao tác");
        }

        $orderItems = $this->orderProductRepository->findByAttributeArray([
            "order_id" => $id
        ]);

        if (!is_array($order)){
            $orderItems = [$orderItems];
        }

        return require "views/admin/orders/show.view.php";
    }
}
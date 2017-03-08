<?php

class ProductsController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var MenuRepository
     */
    private $menuRepository;


    /**
     * ProductsController constructor.
     * @param ProductRepository $productRepository
     * @param MenuRepository $menuRepository
     */
    public function __construct(ProductRepository $productRepository, MenuRepository $menuRepository)
    {
        $this->productRepository = $productRepository;
        $this->menuRepository = $menuRepository;
    }

    public function index()
    {
        $id = isset($_GET['menuId']) ? $_GET['menuId'] : false;

        if ($id) {
            $products = $this->productRepository->findBy('menu_id', $id, 'int');
        } else {
            $products = $this->productRepository->all();
        }
        $menus = $this->menuRepository->menuList();

        $title = "Danh mục Sản phẩm";

        require "views/admin/products/index.view.php";
    }

    /**
     *
     */
    public function create()
    {
        $title = "Thêm mới Sản phẩm";
        $menus = $this->menuRepository->menuList();

        require "views/admin/products/form.view.php";
    }

    /**
     *
     */
    public function store()
    {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $menu_id = $_POST['menu_id'];
        $description = $_POST['description'];

        $image = $this->UploadFile();

        if (!$name) redirectWithErrorSession("?role=admin&controller=products&action=create", "Tên sản phẩm không được để trống");
        if (!$price) redirectWithErrorSession("?role=admin&controller=products&action=create", "Giá sản phẩm không được để trống");

        $this->productRepository->create(['name' => $name, 'price' => $price, 'menu_id' => $menu_id, 'description' => $description, 'image' => $image]);
        redirectWithMessageSession("?role=admin&controller=products&action=index", "Thêm mới sản phẩm thành công");
    }


    public function edit()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';

        if (!$id) redirectWithErrorSession("?role=admin&controller=products&action=index", "Không tồn tại sản phẩm để sửa");

        $product = $this->productRepository->findById($id);

        $title = "Thêm mới Sản phẩm";
        $menus = $this->menuRepository->menuList();

        require "views/admin/products/form.view.php";
    }

    /**
     *
     */
    public function update()
    {

        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $name = $_POST['name'];
        $price = $_POST['price'];
        $menu_id = $_POST['menu_id'];
        $description = $_POST['description'];
        $image = '';
        if ($_FILES['fileToUpload']['name']){
            $image = $this->UploadFile();
        }
        $this->productRepository->update(['id' => $id ,'name' => $name, 'price' => $price, 'menu_id' => $menu_id, 'description' => $description, 'image' => $image]);
        redirectWithMessageSession("?role=admin&controller=products&action=index", "Sửa sản phẩm thành công");
    }

    /**
     *
     */
    public function destroy()
    {
        $id = $_GET['id'];
        if (!$id) {
            redirectWithErrorSession("?role=admin&controller=products&action=index", "Không tồn tại sản phẩm để xóa");
        }

        $this->productRepository->destroy($id);
        redirectWithMessageSession("?role=admin&controller=products&action=index", "Xóa sản phẩm thành công");
    }

    /**
     *
     */
    public function show()
    {

    }

    private function UploadFile()
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            redirectWithErrorSession("?role=admin&controller=products&action=create", "File đã tồn tại");
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                 return basename($_FILES["fileToUpload"]["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        return '';
    }

}
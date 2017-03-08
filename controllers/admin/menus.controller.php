<?php

class MenusController
{
    /**
     * @var MenuRepository
     */
    private $menuRepository;
    /**
     * @var MenuTypeRepository
     */
    private $menuTypeRepository;


    /**
     * MenusController constructor.
     * @param MenuRepository $menuRepository
     * @param MenuTypeRepository $menuTypeRepository
     */
    public function __construct(MenuRepository $menuRepository, MenuTypeRepository $menuTypeRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->menuTypeRepository = $menuTypeRepository;
    }

    public function index()
    {
        $menus = $this->menuRepository->all();
        $menuTypes = $this->menuTypeRepository->all();

        $title = "Menu";
        require "views/admin/menus/index.view.php";
    }

    public function store()
    {
        $name = $_POST['name'];
        $parentId = isset($_POST['parent_id']) ? $_POST['parent_id'] : 0;
        $menuTypeId = $_POST['menu_type_id'];

        if ($name) {
            $this->menuRepository->create(['name' => $name, 'parent_id' => $parentId, 'menu_type_id' => $menuTypeId]);
            redirectWithMessageSession("?role=admin&controller=menus&action=index", 'Thêm mới menu thành công');
        } else {
            redirectWithErrorSession("?role=admin&controller=menus&action=index", "Bạn phải nhập tên Menu");
        }
    }


    public function edit()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if (!$id) {
            redirectWithErrorSession("../index.html", "Không tồn tại menu để sửa");
        }

        $editMenu = $this->menuRepository->findById($id);
        $menus = $this->menuRepository->all();
        $menuTypes = $this->menuTypeRepository->all();

        $title = "Menu";

        require "views/admin/menus/index.view.php";
    }

    public function update()
    {
        $id = $_GET['id'];
        $name = $_POST['name'];
        $parentId = $_POST['parent_id'];
        $menuTypeId = $_POST['menu_type_id'];

        if (!$name) redirectWithErrorSession("?role=admin&controller=menus&action=index", "Bạn phải nhập tên để sửa");
        if (!$id) redirectWithErrorSession("?role=admin&controller=menus&action=index", "Không tồn tại Menu để sửa");

        $this->menuRepository->update(['id' => $id, 'name' => $name, 'parent_id' => $parentId, 'menu_type_id' => $menuTypeId]);
        redirectWithMessageSession("?role=admin&controller=menus&action=index", "Sửa Menu thành công");
    }


    public function destroy()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if (!$id) {
            redirectWithErrorSession("?role=admin&controller=menus&action=index", "Không tồn tại menu để xóa");
        }

        $this->menuRepository->destroy($id);
        redirectWithMessageSession("?role=admin&controller=menus&action=index", "Xóa Menu thành công");
    }


}
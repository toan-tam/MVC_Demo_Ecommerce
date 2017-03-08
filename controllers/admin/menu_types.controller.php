<?php

class MenuTypesController{
    /**
     * @var MenuTypeRepository
     */
    private $menuTypeRepository;


    /**
     * MenuTypesController constructor.
     * @param MenuTypeRepository $menuTypeRepository
     */
    public function __construct(MenuTypeRepository $menuTypeRepository)
    {
        $this->menuTypeRepository = $menuTypeRepository;
    }

    public function index()
    {
        $menuTypes = $this->menuTypeRepository->all();
        $title = "Loại Menu";

        require "views/admin/menu_types/index.view.php";
    }



    public function store()
    {
        $name = $_POST['name'];
        if ($name){
            $this->menuTypeRepository->create(['name' => $name]);
            redirectWithMessageSession("?role=admin&controller=menu_types&action=index", 'Thêm mới Loại menu thành công');
        }
    }

    public function edit()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id){
            $editMenuType = $this->menuTypeRepository->findById($id);
            $menuTypes = $this->menuTypeRepository->all();
            $title = "Loại Menu";

            require "views/admin/menu_types/index.view.php";
        }else{
            die("Không tồn tại loại menu để sửa");
        }
    }

    public function update()
    {
        $id = $_GET['id'];
        $name = $_POST['name'];

        if ($id){
            $this->menuTypeRepository->update(['name' => $name, 'id' => $id]);
            redirectWithMessageSession("?role=admin&controller=menu_types&action=index", 'Sửa Loại menu thành công');
        }
    }

    public function destroy()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id){
            $this->menuTypeRepository->destroy($id);
            redirectWithMessageSession("?role=admin&controller=menu_types&action=index", 'Xóa Loại menu thành công');
        }else{
            die("Không tồn tại loại tin đăng để xóa");
        }
    }

}
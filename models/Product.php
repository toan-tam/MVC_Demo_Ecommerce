<?php

class Product
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $menu_id;
    public $image;

    /**
    * get menu name
    */
    public function getMenuName()
    {
        if ($this->menu_id){
            $config = require "config.php";
            $pdo = Connection::make($config['database']);
            $menuRepository = new MenuRepository($pdo);

            $pdo = null;

            return $menuRepository->findById($this->menu_id)->name;
        }
    }

}

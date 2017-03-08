<?php


class Menu
{
    public $id;
    public $name;
    public $parent_id;
    public $menu_type_id;
    
    /**
    * get menu type name
    */
    public function getMenuTypeName()
    {
        if ($this->menu_type_id){
            $config = require "config.php";
            $pdo = Connection::make($config['database']);
            $menuTypeRepository = new MenuTypeRepository($pdo);

            $pdo = null;

            return $menuTypeRepository->findById($this->menu_type_id)->name;
        }
    }

    /**
    * get parent name
    */
    public function getParentName()
    {
        if ($this->parent_id){
            $config = require "config.php";
            $pdo = Connection::make($config['database']);
            $menuRepository = new MenuRepository($pdo);

            $pdo = null;

            return $menuRepository->findById($this->parent_id)->name;
        }
    }
}
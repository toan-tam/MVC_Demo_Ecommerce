<?php

require_once "models/Menu.php";
require_once "repositories/RepoInterface.php";

class MenuRepository implements RepositoryInterface
{
    /**
     * @var PDO
     */
    private $pdo;


    /**
     * MenuRepository constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $statement = $this->pdo->prepare("select * from menus");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, 'Menu');
    }


    /**
     * Menu which have list products
     * @return array|null
     * @internal param $menuTypeId
     */
    public function menuList()
    {
        $statement = $this->pdo->prepare("select menus.* from menus JOIN menu_types ON menus.menu_type_id = menu_types.id WHERE menu_types.name = 'Menu danh sách'");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, 'Menu');
    }


    /**
     * @param array $array
     */
    public function create($array = [])
    {
        $statement = $this->pdo->prepare("Insert into menus(name, parent_id, menu_type_id) values(:name, :parent_id, :menu_type_id)");

        $statement->bindParam(':name', $array['name'] ,PDO::PARAM_STR);
        $statement->bindParam(':parent_id', $array['parent_id'] ,PDO::PARAM_INT);
        $statement->bindParam(':menu_type_id', $array['menu_type_id'] ,PDO::PARAM_INT);

        $statement->execute();
    }


    /**
     * @param array $array
     */
    public function update($array = [])
    {
        $statement = $this->pdo->prepare("Update menus set name = :name, parent_id = :parent_id, menu_type_id = :menu_type_id where id = :id");
        $statement->bindParam(':id', $array['id'], PDO::PARAM_INT);
        $statement->bindParam(':name', $array['name'] ,PDO::PARAM_STR);
        $statement->bindParam(':parent_id', $array['parent_id'] ,PDO::PARAM_INT);
        $statement->bindParam(':menu_type_id', $array['menu_type_id'] ,PDO::PARAM_INT);

        $statement->execute();
    }
    

    /**
     * find specific menu
     * input : menu object
     * @param $menu
     * @return mixed
     */
    public function find($menu)
    {
        $statement = $this->pdo->prepare("select * from menus where id = $menu->id");
        $statement->execute();

        return $statement->fetchObject('Menu');
    }

    /**
     * find by id
     */
    public function findById($id)
    {
        $statement = $this->pdo->prepare("select * from menus where id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchObject('Menu');
    }

    /**
     * find by attribute
     * @param $attribute
     * @param $value
     * @return array
     */
    public function findBy($attribute, $value)
    {
        $value = is_string($value) ? "'" . $value . "'" : $value;

        $statement = $this->pdo->prepare("Select * from menus where $attribute = $value");

        $statement->execute();

        $menus = $statement->fetchAll(PDO::FETCH_CLASS, 'Menu');

        return count($menus) == 1 ? $menus[0] : $menus;
    }



    public function paginate($perPage = 15)
    {
        // TODO: Implement paginate() method.
    }

    public function destroy($id)
    {
        $statement = $this->pdo->prepare("delete from menus where id = $id");
        $statement->execute();
    }
}
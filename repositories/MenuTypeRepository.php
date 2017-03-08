<?php


require_once "models/MenuType.php";
require_once "repositories/RepoInterface.php";

class MenuTypeRepository implements  RepositoryInterface{
    /**
     * @var PDO
     */
    private $pdo;


    /**
     * MenuTypeRepository constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $statement = $this->pdo->prepare("Select * from menu_types");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, 'MenuType');

    }


    /**
     * @param array $array
     */
    public function create($array = [])
    {
        $statement = $this->pdo->prepare("Insert into menu_types(name) values(:name)");
        $statement->bindParam(':name', $array['name'], PDO::PARAM_STR);
        $statement->execute();
    }


    /**
     * @param array $array
     */
    public function update($array = [])
    {
        $statement = $this->pdo->prepare("Update menu_types set name = :name where id = :id");
        $statement->bindParam(':name', $array['name'], PDO::PARAM_STR);
        $statement->bindParam(':id', $array['id'], PDO::PARAM_INT);
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
        $statement = $this->pdo->prepare("select * from menu_types where id = $menu->id");
        $statement->execute();

        return $statement->fetch(PDO::FETCH_CLASS, 'MenuType');
    }

    /**
     * find by id
     */
    public function findById($id)
    {
        $statement = $this->pdo->prepare("select * from menu_types where id = $id");
        $statement->execute();
        return $statement->fetchObject('MenuType');
    }

    /**
     * find by attribute
     * @param $attribute
     * @param $value
     * @return array|null
     */
    public function findBy($attribute, $value)
    {
        $value = is_string($value) ? "'" . $value . "'" : $value;

        $statement = $this->pdo->prepare("Select * from menu_types where $attribute = $value");
        $statement->execute();

        $menuTypes = $statement->fetchAll(PDO::FETCH_CLASS, 'MenuType');

        return count($menuTypes) == 1 ? $menuTypes[0] : $menuTypes;
    }



    public function paginate($perPage = 15)
    {
        // TODO: Implement paginate() method.
    }

    public function destroy($id)
    {
        $statement = $this->pdo->prepare("delete from menu_types where id = $id");
        return $statement->execute();
    }
}
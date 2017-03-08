<?php

require "models/Product.php";
require_once "repositories/RepoInterface.php";

class ProductRepository implements RepositoryInterface
{
    /**
     * @var PDO
     */
    private $pdo;


    /**
     * ProductRepository constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $statement = $this->pdo->prepare("Select * from products");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    /**
     * create new product
     * @param array $array
     */
    public function create($array = [])
    {
        $statement = $this->pdo->prepare("Insert into products(name, description, price, menu_id, image) values(:name, :description, :price, :menu_id, :image)");
        $statement->bindParam(':name', $array['name'], PDO::PARAM_STR);
        $statement->bindParam(':price', $array['price'], PDO::PARAM_INT);
        $statement->bindParam(':description', $array['description'], PDO::PARAM_STR);
        $statement->bindParam(':menu_id', $array['menu_id'], PDO::PARAM_INT);
        $statement->bindParam(':image', $array['image'], PDO::PARAM_STR);

        $statement->execute();
    }


    /**
     * update product
     * @param array $array
     */
    public function update($array = [])
    {
        $statement = $this->pdo->prepare("Update products set name = :name, description = :description, price = :price, menu_id = :menu_id " . ($array['image'] != "" ? ", image = :image " : "") . " where id = :id");

        $statement->bindParam(':id', $array['id'], PDO::PARAM_INT);
        $statement->bindParam(':name', $array['name'], PDO::PARAM_STR);
        $statement->bindParam(':price', $array['price'], PDO::PARAM_INT);
        $statement->bindParam(':description', $array['description'], PDO::PARAM_STR);
        $statement->bindParam(':menu_id', $array['menu_id'], PDO::PARAM_INT);
        if ($array['image']) {
            $statement->bindParam(':image', $array['image'], PDO::PARAM_STR);
        }

        $statement->execute();
    }

    /**
     * find specific menu
     * input : menu object
     * @param $product
     * @internal param $menu
     * @return mixed
     */
    public function find($product)
    {
        $statement = $this->pdo->prepare("Select * from products where id = $product->id");
        $statement->execute();

        return $statement->fetchObject('Product');
    }

    /**
     * find by id
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $statement = $this->pdo->prepare("Select * from products where id = $id");
        $statement->execute();

        return $statement->fetchObject('Product');
    }

    /**
     * find by attribute
     * @param $attribute
     * @param $value
     * @param int|string $type
     * @return array|null
     */
    public function findBy($attribute, $value, $type = Constants::STRING)
    {
        $value = $type == Constants::STRING ? "'" . $value . "'" : $value;
        $statement = $this->pdo->prepare("Select * from products where $attribute = $value");

        $statement->execute();

        $products = $statement->fetchAll(PDO::FETCH_CLASS, 'Product');

        return count($products) == 1 ? $products[0] : $products;
    }


    public function paginate($perPage = 15)
    {
        // TODO: Implement paginate() method.
    }

    public function destroy($id)
    {
        $statement = $this->pdo->prepare("Delete from products where id = $id");

        $statement->execute();
    }
}
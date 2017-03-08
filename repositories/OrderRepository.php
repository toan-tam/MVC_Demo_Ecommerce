<?php

require_once "models/Order.php";
require_once "repositories/RepoInterface.php";

class OrderRepository implements RepositoryInterface{


    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function insert($paramater = [])
    {
        $sql = sprintf(
            "insert into orders (%s) values (%s)",
            join(",", array_keys($paramater)),
            ":" . join(", :", array_keys($paramater))
        );

        try{
            $statement = $this->pdo->prepare($sql);
            return $statement->execute($paramater);

        }catch(Exception $e){
            die("Có lỗi xảy ra");
        }
    }
    

    public function all()
    {
        $statement = $this->pdo->prepare("select * from orders");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, "Order");
    }

    public function destroy($id)
    {
        $statement = $this->pdo->prepare("delete from orders where id=$id");
        return $statement->execute();
    }

    public function paginate($perPage = 15)
    {
        // TODO: Implement paginate() method.
    }

    public function findById($id)
    {
        $statement = $this->pdo->prepare("select * from orders where id = $id");
        $statement->execute();

        return $statement->fetchObject("Order");
    }

    public function find($object)
    {
        $statement = $this->pdo->prepare("select * from orders where id = $object->id");
        $statement->execute();

        return $statement->fetchObject("Order");
    }

    public function findBy($attribute, $value)
    {

        $value = is_string($value) ? "'" . $value . "'" : $value;

        $statement = $this->pdo->prepare("select * from orders where $attribute = $value");

        $orders = $statement->fetchAll(PDO::FETCH_CLASS, "Order");

        return count($orders) == 1 ? $orders[0] : $orders;
    }

    /**
    *
    */
    public function findByAttributeArray($attributeArray = [])
    {
        if (count($attributeArray) > 0){

            $keys = array_keys($attributeArray);
            $sql = "select * from orders where ";

            foreach($keys as $index => $key){
                $value = $attributeArray[$key];

                $sql .= ($index == 0 ? "" : " and ") . "$key = $value";
            }

            $statement = $this->pdo->prepare($sql);

            $statement->execute();

            $orders = $statement->fetchAll(PDO::FETCH_CLASS, "Order");

            return count($orders) == 1 ? $orders[0] : $orders;
        }

        return null;
    }


    public function updateById($id, $paramaters = [])
    {
        $keys = array_keys($paramaters);
        $sqlPart = "";

        if (count($keys) > 0){
            foreach ($keys as $index => $key) {
                $sqlPart .= ($index == 0 ? "" : " ,") . $key . " = :" . $key;
            }
        }

        $sql = sprintf(
            "update orders set %s where id = $id",
            $sqlPart
        );

        try {
            $statement = $this->pdo->prepare($sql);
            return $statement->execute($paramaters);
        }catch(Exception $e){
            die("Có lỗi xảy ra khi update");
        }

    }
}
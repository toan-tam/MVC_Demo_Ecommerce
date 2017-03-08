<?php

require_once "models/OrderProduct.php";
class OrderProductRepository implements RepositoryInterface{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {

        $this->pdo = $pdo;
    }

    public function insert($paramater = [])
    {
        $sql = sprintf(
            "insert into order_product (%s) values (%s)",
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
        // TODO: Implement all() method.
    }

    public function destroy($id)
    {
       $statement = $this->pdo->prepare("delete from order_product where id = $id");
        return $statement->execute();
    }


    /**
    * delete by order_id and product_id
    */
    public function deleteByOrderIdAndProductID($orderId, $productId)
    {
        $sql = "delete from order_product where order_id = $orderId and product_id = $productId";
        $statement = $this->pdo->prepare($sql);

        return $statement->execute();
    }

    public function paginate($perPage = 15)
    {
        // TODO: Implement paginate() method.
    }

    public function findById($id)
    {
        // TODO: Implement findById() method.
    }

    public function find($object)
    {
        // TODO: Implement find() method.
    }

    public function findBy($attribute, $value)
    {
        // TODO: Implement findBy() method.
    }

    public function findByAttributeArray($attributeArray = [])
    {
        if (count($attributeArray) > 0){

            $keys = array_keys($attributeArray);
            $sql = "select * from order_product where ";

            foreach($keys as $index => $key){
                $value = $attributeArray[$key];

                $sql .= ($index == 0 ? "" : " and ") . "$key = $value";
            }

            $statement = $this->pdo->prepare($sql);

            $statement->execute();

            $orderProducts = $statement->fetchAll(PDO::FETCH_CLASS, "OrderProduct");

            return count($orderProducts) == 1 ? $orderProducts[0] : $orderProducts;
        }

        return null;
    }

    /**
    *
    */
    public function update($orderProduct, $paramaters = [])
    {
        $keys = array_keys($paramaters);
        $sqlPart = "";

        if (count($keys) > 0){
            foreach ($keys as $index => $key) {
                $sqlPart .= ($index == 0 ? "" : " ,") . $key . " = :" . $key;
            }
        }

        $sql = sprintf(
            "update order_product set %s where id = $orderProduct->id",
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
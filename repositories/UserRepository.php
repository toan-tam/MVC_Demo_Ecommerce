<?php

require_once "models/User.php";
require_once "repositories/RepoInterface.php";

class UserRepository implements RepositoryInterface
{
    /**
     * @var PDO
     */
    private $pdo;


    /**
     * UserRepository constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $statement = $this->pdo->prepare("select * from users");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, 'User');
    }


    /**
     * @param array $array
     */
    public function create($array = [])
    {
        $statement = $this->pdo->prepare("Insert into users(name, phone_number, email, address, username, password, role_id) values( :name, :phone_number, :email, :address, :username, :password, :role_id)");
        $statement->bindParam(":name", $array['name'], PDO::PARAM_STR);
        $statement->bindParam(":phone_number", $array['phone_number'], PDO::PARAM_STR);
        $statement->bindParam(":email", $array['email'], PDO::PARAM_STR);
        $statement->bindParam(":address", $array['address'], PDO::PARAM_STR);
        $statement->bindParam(":username", $array['username'], PDO::PARAM_STR);
        $statement->bindParam(":password", $array['password'], PDO::PARAM_STR);
        $statement->bindParam(":role_id", $array['role_id'], PDO::PARAM_INT);

        $statement->execute();
    }


    /**
     * @param array $array
     */
    public function update($array = [])
    {
        $statement = $this->pdo->prepare("Update users set name = :name, phone_number = :phone_number, email = :email, addess = :address, username = :username, password = :password, role_id = :role_id where id = :id");
        $statement->bindParam(":name", $array['name'], PDO::PARAM_STR);
        $statement->bindParam(":phone_number", $array['phone_number'], PDO::PARAM_STR);
        $statement->bindParam(":email", $array['email'], PDO::PARAM_STR);
        $statement->bindParam(":address", $array['address'], PDO::PARAM_STR);
        $statement->bindParam(":username", $array['username'], PDO::PARAM_STR);
        $statement->bindParam(":password", $array['password'], PDO::PARAM_STR);
        $statement->bindParam(":role_id", $array['role_id'], PDO::PARAM_INT);
        $statement->bindParam(":id", $array['id'], PDO::PARAM_INT);

        $statement->execute();
    }

    /**
     * find specific user
     */
    public function find($menu)
    {
        $statement = $this->pdo->prepare("Select * from users where id = $menu->id");
        $statement->execute();

        return $statement->fetchObject('User');
    }

    /**
     * find by id
     */
    public function findById($id)
    {
        $statement = $this->pdo->prepare("Select * from users where id = $id");
        $statement->execute();

        return $statement->fetchObject('User');
    }


    public function findBy($attribute, $value)
    {
    }


    /**
     * validate user
     * @param $username
     * @param $password
     * @return mixed
     */
    public function validate($username, $password)
    {
        $statement = $this->pdo->prepare("select * from users where username = :username and password = :password");
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchObject('User');
    }

    public function paginate($perPage = 15)
    {
        // TODO: Implement paginate() method.
    }

    public function destroy($id)
    {
        // TODO: Implement delete() method.
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
            "update users set %s where id = $id",
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
<?php


require_once "models/User.php";
require_once "repositories/UserRepository.php";
class Order{

    public $id;
    public $user_id;
    public $created_at;
    public $total_cost;
    public $is_delivered;
    public $is_completed;

    /**
    *
    */
    public function getOwner()
    {
        if (isset($this->user_id)){
            $config = require "config.php";
            $pdo = Connection::make($config['database']);
            $userRepository = new UserRepository($pdo);
            $pdo = null;

            return $userRepository->findById($this->user_id);
        }

        return null;
    }

    /**
    *
    */
    public function getAmountTime()
    {
        $amount =  (new DateTime(date("Y-m-d H:i:s")))->diff(new DateTime($this->created_at));

        return $amount->days . " ngày - " . $amount->h . " giờ - " . $amount->i . " phút trước";
    }

}
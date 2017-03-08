<?php

interface RepositoryInterface{
    public function all();

    public  function destroy($id);

    public function paginate($perPage = 15);

    public function findById($id);

    public function find($object);

    public function findBy($attribute, $value);
}

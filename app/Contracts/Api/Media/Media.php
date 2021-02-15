<?php


namespace App\Contracts\Api\Media;


interface Media
{

    public function create($data);

    public function getBy($name, $value);

    public function getById($id);

    public function getAll();

    public function delete($id);

    public function update($id, $data);

}

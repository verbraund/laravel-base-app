<?php


namespace App\Contracts\Api\Media;


interface Media
{

    public function create();

    public function getBy($name, $value);

    public function getAll($request);

    public function delete();

    public function edit();

}

<?php


namespace App\Contracts\Api\Media;


interface Role
{

    public function getByName($name);

    public function getHttpExceptionRole();

    public function getErrorExceptionRole();

}

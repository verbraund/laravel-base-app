<?php


namespace App\Contracts\Api\Media;


interface News extends Media
{

    public function getBySlug($slug);

}

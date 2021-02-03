<?php


namespace App\Extensions;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class AdminProvider extends EloquentUserProvider
{

    public function __construct(HasherContract $hasher, $admin)
    {
        parent::__construct($hasher, $admin);
    }

}

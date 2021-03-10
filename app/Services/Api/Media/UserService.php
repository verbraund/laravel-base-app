<?php


namespace App\Services\Api\Media;


use App\Models\User as UserModel;
use App\Contracts\Api\Media\User as UserContract;

class UserService extends MediaService implements UserContract
{

    protected $model = UserModel::class;

    public function getCurrentAuthenticated()
    {
        return $this->getById(auth()->id());
    }
}

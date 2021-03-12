<?php


namespace App\Services\Api\Media;


use App\Models\Role as RoleModel;
use App\Contracts\Api\Media\Role as RoleContract;

class RoleService extends MediaService implements RoleContract
{

    protected $model = RoleModel::class;


    public function getByName($name)
    {
        return $this->getBy('name',$name);
    }

    public function getHttpExceptionRole()
    {
        return $this->getByName(RoleModel::HTTP_EXCEPTION_NAME);
    }

    public function getErrorExceptionRole()
    {
        return $this->getByName(RoleModel::ERROR_EXCEPTION_NAME);
    }
}

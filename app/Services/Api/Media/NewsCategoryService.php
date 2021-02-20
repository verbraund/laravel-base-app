<?php


namespace App\Services\Api\Media;

use App\Contracts\Api\Media\NewsCategory as NewsCategoryContract;
use App\Models\Media\News\NewsCategory as NewsCategoryModel;

class NewsCategoryService extends MediaService implements NewsCategoryContract
{

    protected $model = NewsCategoryModel::class;

}

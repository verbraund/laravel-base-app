<?php

namespace App\Policies\Media\News;

use App\Models\Media\News\News;
use App\Policies\BasePolicy;

class NewsPolicy extends BasePolicy
{

    protected $model = News::class;

}

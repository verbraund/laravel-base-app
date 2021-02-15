<?php

namespace App\Policies\Media\News;

use App\Models\Admin;
use App\Models\Media\News\News;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Media\News\News  $news
     * @return mixed
     */
    public function view(Admin $admin, News $news)
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Media\News\News  $news
     * @return mixed
     */
    public function update(Admin $admin, News $news)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Media\News\News  $news
     * @return mixed
     */
    public function delete(Admin $admin, News $news)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Media\News\News  $news
     * @return mixed
     */
    public function restore(Admin $admin, News $news)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Media\News\News  $news
     * @return mixed
     */
    public function forceDelete(Admin $admin, News $news)
    {
        return false;
    }
}

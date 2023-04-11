<?php

namespace App\Policies;
use App\Models\Content;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Content $content)
    {
        return $user->id == $content->user_id;
    }
    
    public function delete(User $user, Content $content)
    {
        return $user->id == $content->user_id;
    }

}

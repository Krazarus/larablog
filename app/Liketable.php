<?php

namespace App;


trait Liketable
{
    /**
     * @return mixed
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'liked');
    }

    /**
     * @return bool
     */
    public function isLiked()
    {
        return !!$this->likes->where('user_id', auth()->id())->count();
    }
}
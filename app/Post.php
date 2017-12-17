<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    private $_isUpdated = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function path()
    {
        return str_after($this->thumbnail, 'public');
    }

    public function isUpdated()
    {
        if ($this->updated_at != $this->created_at) {
            return true;
        }
        return false;
    }

    public function checkCreator()
    {
        $admin = User::where('name', 'John')->first();
        if ($this->user_id == auth()->id()) {
            return true;
        }
        if ($admin) {
            if ($admin->id == auth()->id()) {
                return true;
            }
        }
        return false;
    }
}

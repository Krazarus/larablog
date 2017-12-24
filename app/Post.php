<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Liketable;
    protected $guarded = [];
    protected $with = ['likes'];

    /**
     * Apply filter to body
     *
     * @param $value
     * @return void
     */
    public function setBodyAttribute($value)
    {
        $filter = Filter::all()->pluck('name')->toArray();

        $this->attributes['body'] = str_ireplace($filter, (new Filter)->value($filter), $value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * URI post
     *
     * @return string
     */
    public function uri()
    {
        return "/posts/{$this->id}";
    }

    /**
     * Path to image
     *
     * @return string
     */
    public function path()
    {
        return str_after($this->thumbnail, 'public');
    }

    /**
     * @return bool
     */
    public function isUpdated()
    {
        if ($this->updated_at != $this->created_at) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function checkCreator()
    {
        $admin = User::where('name', 'admin')->first();
        if ($admin->id == auth()->id()) {
            return true;
        }
        return false;
    }


}

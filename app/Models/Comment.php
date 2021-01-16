<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $content_id
 * @property integer $id_user
 * @property string $comment
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property Content $content
 * @property User $user
 */
class Comment extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['content_id', 'id_user', 'comment', 'created_at', 'updated_at', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content()
    {
        return $this->belongsTo('App\Models\Content');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('comment', 'like', '%'.$query.'%');
    }
}

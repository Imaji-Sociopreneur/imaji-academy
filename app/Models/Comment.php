<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property integer $id
 * @property integer $content_id
 * @property string $comment
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property Content $content
 */
class Comment extends Model
{

    protected $keyType = 'integer';


    protected $fillable = ['content_id', 'comment', 'created_at', 'updated_at', 'name'];


    public function content()
    {
        return $this->belongsTo('App\Models\Content');
    }
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('comment', 'like', '%'.$query.'%');
    }

}

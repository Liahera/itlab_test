<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates=['deleted_at'];
    protected $fillable = [
        'id', 'text', 'title', 'created_at'
    ];
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'article_user')->withTimestamps();
    }
}

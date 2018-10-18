<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $table = "category";

    protected $primaryKey = "id";

    protected $fillable = [
        'folder_id', 'parent_id', 'name'  
    ];

    public function parent() {
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }

    //each category might have multiple children
    public function children() {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }

    public function scopeByParent($query, $parent = 0)
    {
        return $query->where('parent_id', $parent);
    }

 
}

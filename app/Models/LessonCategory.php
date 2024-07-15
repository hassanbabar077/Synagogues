<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonCategory extends Model
{
    use HasFactory;
    protected $fillable = ['lesson_categories', 'icon', 'description'];
    public function sessionDetails()
    {
        return $this->hasMany(SessionDetail::class, 'category_id');
    }
}

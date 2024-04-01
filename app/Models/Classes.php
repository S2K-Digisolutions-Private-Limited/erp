<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'has_stream',
        'school_id',
    ];

    public function sections()
    {
        return $this->hasMany(Section::class, 'class_id', 'id');
    }
    public function streams()
    {
        return $this->hasMany(Stream::class, 'class_id', 'id');
    }
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }
}

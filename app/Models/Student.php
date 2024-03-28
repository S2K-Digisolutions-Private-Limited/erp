<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "status",
        "student_id",
        "school_id",
        'profile_image',
        "email",
        "phone",
        "gender",
        "hidden_password",
        "father_name",
        "mother_name",
        "father_number",
        "mother_number",
        "whatsapp_number",
        "primary_email",
        "full_address",
        "roll_number",
        "class_id",
        "section_id",
        "stream_id",
        "password",
        "about",
    ];

    public function setHiddenPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }
    public function stream()
    {
        return $this->belongsTo(Stream::class, 'stream_id', 'id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}

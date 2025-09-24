<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_number',
        'full_name',
        'enrollment_year',
        'email',
        'phone_number',
        'status',
        'join_date',
        'profile_photo_path',
        'division_id',
        'user_id',
    ];
}

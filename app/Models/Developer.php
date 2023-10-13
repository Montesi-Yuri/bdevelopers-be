<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'experience_year',
        'curriculum',
        'profile_picture',
        'profile_description',
        'address',
        'phone_number'
    ];

    protected $appends = [
        'full_profile_picture_src'
    ];

    public function getFullImgSrcAttribute() {
        return asset('storage/' . $this->profile_picture);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function messages() {
        return $this->belongsTo(Message::class);
    }
    
    public function sponsorships() {
        return $this->belongsToMany(Sponsorship::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function votes() {
        return $this->belongsToMany(Vote::class);
    }

    public function work_fiels() {
        return $this->belongsToMany(WorkField::class);
    }
}

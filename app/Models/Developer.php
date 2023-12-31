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
        'profile_picture',
        'profile_description',
        'address',
        'phone_number'
    ];

    protected $appends = [
        'full_img_src',
        'average_vote',
        'active_sponsorship',
        'sponsorship_expire_date'
    ];

    public function getFullImgSrcAttribute() {
        return asset('storage/' . $this->profile_picture);
    }

    public function getAverageVoteAttribute() {
        $voteArr = [];
        foreach ($this->votes as $vote) {
            $voteArr[] = $vote->value;
        }
        if (count($voteArr) != 0) {
            return array_sum($voteArr)/count($voteArr);
        } else {
            return 0;
        }
    }

    public function getActiveSponsorshipAttribute() {
        $activeSponsorship = false;
        if(count($this->sponsorships) > 0) {
            $expireDate = $this->sponsorships[count($this->sponsorships) - 1]->pivot->expire_date;
            $activeSponsorship = strtotime($expireDate) > time();
        }
        return $activeSponsorship;
    }

    public function getSponsorshipExpireDateAttribute() {
        $expireDate = null;
        $ss = $this->sponsorships->sort(function($a, $b) {
            if($a->pivot->id > $b->pivot->id) {
                return -1;
            } elseif($a->pivot->id < $b->pivot->id) {
                return 1;
            } else {
                return 0;
            }
        })->values();
        if(count($this->sponsorships) > 0 && $this->active_sponsorship) {
            $expireDate = $ss[0]->pivot->expire_date;
        }
        return $expireDate;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }
    
    public function sponsorships() {
        return $this->belongsToMany(Sponsorship::class)->withPivot('id', 'expire_date');
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function votes() {
        return $this->belongsToMany(Vote::class)->withPivot('id', 'created_at');
    }

    public function work_fields() {
        return $this->belongsToMany(WorkField::class);
    }
}

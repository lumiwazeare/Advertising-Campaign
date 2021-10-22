<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['name','start_date','end_date','daily_budget','total_budget'];

    protected $hidden = ['updated_at'];

    public function images(){
        return $this->hasMany(CampaignImage::class);
    }
}

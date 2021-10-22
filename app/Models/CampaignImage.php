<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CampaignImage extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_id','url'];

    protected $hidden = ['updated_at'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

}

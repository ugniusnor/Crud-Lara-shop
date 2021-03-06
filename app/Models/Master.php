<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;
    protected $fillable=['name','surname','avatar_url'];

    public function outfits () {
        return $this->hasMany("App\Models\Outfit",'master_id','id');
    }
}

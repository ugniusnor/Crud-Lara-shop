<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outfit extends Model
{
    use HasFactory;
    protected $fillable=['type','color','size', 'master_id', 'about'];
    public function master() {
        return $this->belongsTo("App\Models\Master",'master_id','id');
    }
    
}

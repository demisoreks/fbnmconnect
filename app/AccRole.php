<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AccRole extends Model
{
    use HasHashSlug;
    
    protected $table = "acc_roles";
    
    protected $guarded = [];
    
    public function link() {
        return $this->belongsTo('App\AccLink');
    }
}

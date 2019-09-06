<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AccLink extends Model
{
    use HasHashSlug;
    
    protected $table = "acc_links";
    
    protected $guarded = [];
    
    public function roles() {
        return $this->hasMany('App\AccRole');
    }
}

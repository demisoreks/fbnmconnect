<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class HrmDepartment extends Model
{
    use HasHashSlug;
    
    protected $table = "hrm_departments";
    
    protected $guarded = [];
    
    public function units() {
        return $this->hasMany('App\HrmUnit');
    }
}

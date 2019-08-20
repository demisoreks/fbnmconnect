<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class HrmUnit extends Model
{
    use HasHashSlug;
    
    protected $table = "hrm_units";
    
    protected $guarded = [];
    
    public function department() {
        return $this->belongsTo('App\HrmDepartment');
    }
    
    public function jobFunctions() {
        return $this->hasMany('App\HrmJobFunction');
    }
}

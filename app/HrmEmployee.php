<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class HrmEmployee extends Model
{
    use HasHashSlug;
    
    protected $table = "hrm_employees";
    
    protected $guarded = [];
    
    public function branch() {
        return $this->belongsTo('App\HrmBranch');
    }
    
    public function grade() {
        return $this->belongsTo('App\HrmGrade');
    }
    
    public function jobFunction() {
        return $this->belongsTo('App\HrmJobFunction');
    }
    
    public function reportsTo() {
        return $this->belongsTo('App\HrmEmployee');
    }
    
    public function subordinates() {
        return $this->hasMany('App\HrmEmployee');
    }
}

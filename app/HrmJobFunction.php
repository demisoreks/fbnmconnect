<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class HrmJobFunction extends Model
{
    use HasHashSlug;
    
    protected $table = "hrm_job_functions";
    
    protected $guarded = [];
    
    public function unit() {
        return $this->belongsTo('App\HrmUnit');
    }
    
    public function employees() {
        return $this->hasMany('App\HrmEmployee');
    }
}

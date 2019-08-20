<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class HrmGrade extends Model
{
    use HasHashSlug;
    
    protected $table = "hrm_grades";
    
    protected $guarded = [];
}

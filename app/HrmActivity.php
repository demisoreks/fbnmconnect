<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class HrmActivity extends Model
{
    use HasHashSlug;
    
    protected $table = "hrm_activities";
    
    protected $guarded = [];
}

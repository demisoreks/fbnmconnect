<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class HrmBranch extends Model
{
    use HasHashSlug;
    
    protected $table = "hrm_branches";
    
    protected $guarded = [];
}

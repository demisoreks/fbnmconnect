<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AccActivity extends Model
{
    use HasHashSlug;
    
    protected $table = "acc_activities";
    
    protected $guarded = [];
}

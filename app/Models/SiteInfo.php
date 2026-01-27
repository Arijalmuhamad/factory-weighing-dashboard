<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    protected $table = "wbs_site_tab";
    protected $fillable = ["siteid","company_name"];
}
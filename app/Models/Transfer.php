<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = "wb_automation_producttrans_tab";
    protected $fillable = ["regis_in","weighing_in","weighing_out","regis_out","netto","posting_date","dateout"];
}

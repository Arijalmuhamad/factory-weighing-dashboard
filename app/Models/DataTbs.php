<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataTbs extends Model
{
    protected $table = "wb_automation_datatbs_tab";
    protected $fillable = ["regis_in","weighing_in","weighing_out","regis_out","netto_ag","supplier","posting_date","janjang","total_brondolan","dateout"];
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LainLain extends Model
{
    protected $table = "wb_automation_data_tab";
    protected $fillable = ["regis_in","weighing_in","weighing_out","regis_out","wbin","wbout","netto","dateout","vehicleno","driver","partname","partid"];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = "wb_automation_datacpo_tab";
    protected $fillable = ["regis_in","weighing_in","weighing_out","regis_out","csid","partname","netto","posting_date","dateout"];
}

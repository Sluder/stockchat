<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $timestamps = true;
    protected $table = 'reports';
    protected $fillable = ['reporter_id', 'user_id', 'reason'];

    // New user report rules
    public static $report_rules = [
        'user_id' => 'required|min:1',
        'reason' => 'required',
    ];
}

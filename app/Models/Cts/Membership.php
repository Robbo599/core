<?php

namespace App\Models\Cts;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $connection = 'cts';
    protected $guarded = [];

    public $timestamps = false;
    public $incrementing = false;

    public const TYPE_HOME = 'H';
    public const TYPE_VISITING = 'V';

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}

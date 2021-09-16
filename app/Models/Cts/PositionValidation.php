<?php

namespace App\Models\Cts;

use Illuminate\Database\Eloquent\Model;

class PositionValidation extends Model
{
    protected $connection = 'cts';
    protected $table = 'position_validations';

    public $timestamps = false;

    public const CAN_REQUEST_STATUS = 1;
    public const MENTOR_STATUS = 5;

    protected $fillable = [
        'member_id',
        'position_id',
        'status',
        'changed_by',
        'date_changed',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function scopeMentors($query)
    {
        return $query->where('status', '=', self::MENTOR_STATUS);
    }
}

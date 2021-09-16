<?php

namespace App\Models\Training\TrainingPlace;

use App\Models\Mship\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingPlaceOffer extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'offer_id';
    public $incrementing = false;

    protected $fillable = [
        'account_id',
        'offer_id',
        'offered_by',
        'expires_at',
        'reminder_sent_at',
        'training_position_id',
        'accepted_at',
        'declined_at',
        'declined_reason'
    ];

    public $dates = ['expires_at', 'accepted_at', 'declined_at', 'reminder_sent_at'];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function offeringAccount() : BelongsTo
    {
        return $this->belongsTo(Account::class, 'offered_by');
    }

    public function trainingPosition(): BelongsTo
    {
        return $this->belongsTo(TrainingPosition::class);
    }
}

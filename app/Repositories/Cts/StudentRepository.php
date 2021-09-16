<?php

namespace App\Repositories\Cts;

use App\Models\Cts\Membership;
use App\Models\Cts\PositionValidation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class StudentRepository
{
    public function getStudentsWithin(int $rtsId): Collection
    {
        $positionValidations = PositionValidation::with(['member', 'position'])
        ->whereHas('position', function (Builder $query) use ($rtsId) {
            $query->where('rts_id', '=', $rtsId);
        })->where('status', '=', 1)->get();

        $students = collect();

        foreach ($positionValidations as $positions) {
            $students->push($positions->member);
        }

        return $this->format($students->unique());
    }

    public function grantTrainingPlacePermission(TrainingPosition $trainingPosition, Account $account) : bool
    {
        $trainingPosition = $trainingPosition->load('ctsPosition');
        try {
            $ctsMember = Member::where('cid', $account->id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            // if not found, sync to cts and then retrieve the synced Member.
            $account->syncToCTS();
            $ctsMember = Member::where('cid', $account->id)->firstOrFail();
        }

        $dateGroup = 'Y-m-d H:i:s';

        // create membership to group.
        Membership::create([
            'rts_id' => $trainingPosition->ctsPosition->rts_id, // assign to the RTS ID of the position in the CTS database.
            'member_id' => $ctsMember->id,
            'type' => Membership::TYPE_HOME, // add the student as a 'home' member of the RTS.
            'joined' => Carbon::now()->format($dateGroup),
            'confirmed' => Carbon::now()->format($dateGroup)
        ]);

        return PositionValidation::create([
            'member_id' => $ctsMember->id,
            'position_id' => $trainingPosition->cts_position_id,
            'status' => PositionValidation::CAN_REQUEST_STATUS,
            'changed_by' => 1234567, // TODO: Replace with configurable service account.
            'date_changed' => Carbon::now()->format($dateGroup),
        ]);
    }

    private function format(Collection $data)
    {
        return $data->pluck('cid')->transform(function ($item) {
            return (string) $item;
        })->sort()->values();
    }
}

<?php

namespace App\Nova\Metrics;

use App\Models\Training\TrainingPlace;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class TrainingPlaceCounts extends Partition
{
    /**
     * Generate a count metric for a group of training places.
     * @return int
     */
    private function generateGroupMetric(string $callsignMatch) : int
    {
        return TrainingPlace::with('trainingPosition')->whereHas('trainingPosition.station', function (Builder $builder) use ($callsignMatch) {
            $builder->where('callsign', 'like', $callsignMatch);
        })->count();
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->result([
            'APP' => $this->generateGroupMetric('%APP'),
            'CTR' => $this->generateGroupMetric('%CTR'),
            'TWR' => $this->generateGroupMetric('%TWR'),
        ]);
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        return 0;
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'training-place-counts';
    }
}

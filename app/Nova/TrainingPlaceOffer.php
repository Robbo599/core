<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Panel;

class TrainingPlaceOffer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Training\TrainingPlace\TrainingPlaceOffer::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'offer_id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [];

    private $dateFormat = 'LLL';

    public static $group = 'Training';

    public static function searchable()
    {
        return false;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'offer_id')->hideFromIndex(),

            BelongsTo::make('Student', 'account', Account::class),

            BelongsTo::make('Offered By', 'offeringAccount', Account::class),

            BelongsTo::make('Position', 'trainingPosition', TrainingPosition::class),

            new Panel('Offer Status', [
                DateTime::make('Expires At')->format($this->dateFormat),
                DateTime::make('Accepted At')->format($this->dateFormat),
                DateTime::make('Declined At')->format($this->dateFormat),
                DateTime::make('Reminder Sent At')->format($this->dateFormat),
            ]),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToView(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }
}

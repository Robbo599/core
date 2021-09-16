@extends('emails.messages.post')

@section('body')
<p>A training place is now available for you on {{ $station->name }} ({{ $station->callsign }}).
    Please {!! link_to_route("training.offer.view", "click here", ["trainingPlaceOffer" => $offerId]) !!} to view and accept or decline this training place.
    Please note that by accepting a training place you agree to the requirements for students set-out in section 5 of the
    <a href="https://community.vatsim.uk/files/downloads/file/230-atc-training-handbook/">ATC Training Handbook</a>.
</p>
<p>
    If we’ve not heard from you within the next 84 hours (3.5 days) - recorded as {{ $expiry }} - we will unfortunately have to offer the place to another student.
</p>
@stop

@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-ukblue">
                <header class="panel-heading">
                    Training Place Offer - {{ $offer->trainingPosition->station->callsign }}
                </header>
                <main class="panel-body">
                    <div>
                        <p>You have been offered a training place on {{ $offer->trainingPosition->station->name }}.
                            This offer will expire at {{ $offer->expires_at }}
                        </p>
                        <p>You can either accept the training place or decline, providing a reason, using the buttons below.
                            It is likely the Training Department will follow up via Email depending on the reason.
                        </p>
                        <p>Please note that by accepting a training place you agree to the requirements for students set-out in section 5 of the <a href="https://community.vatsim.uk/files/downloads/file/230-atc-training-handbook/">ATC Training Handbook</a>.</p>
                    </div>
                    <div class="flex-around">
                        <form action="{{ route('training.offer.accept', ['trainingPlaceOffer' => $offer->offer_id]) }}" method="POST">
                            @csrf
                            <button class="btn btn-success" type="submit">Accept Training Place</button>
                        </form>
                        <form action="{{ route('training.offer.decline', ['trainingPlaceOffer' => $offer->offer_id]) }}" method="POST">
                            @csrf
                            <div class="modal fade" role="dialog" id="declineModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">Decline Training Place</div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Enter Reason For Rejecting Place</label>
                                                <textarea name="declined_reason" cols="30" rows="10" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#declineModal" type="button">Reject Training Place</button>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection

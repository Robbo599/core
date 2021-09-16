@extends('emails.messages.post')

@section('body')
<p>You now have permissions to request mentoring sessions on <strong>{{ $station->name }}</strong> ({{ $station->callsign }}).
    Please ensure that you have both a session request and up-to-date availability in the CT System so that mentors are able to accept your mentoring sessions. You'll need to keep your availability up-to-date throughout your training and make another session request as soon as possible after every session.</p>
<p>If you need to go away for a period of time (e.g. for a holiday) during your training, or will otherwise be unable to enter a session request and availability for a period of time, please let us know in advance so that we don't send you availability reminders during that period. If it's for an extended period of time, we may ask you to defer your place temporarily so that we can provide training to other students whilst you're away. We will be as flexible as we can to accommodate your circumstances, but we can only work with what we know and can't make accommodations retrospectively, so please be sure to communicate with us before any problems arise.</p>
<p>You may find it helpful to set the ‘remind me if I don’t have any availability’ email setting, accessible on the CT System under Students → Self → Email Settings:</p>
<img src="{{ $message->embed(public_path() . '/images/cts/cts-preferences-availability.png') }}" alt="CTS preferences guidance.">


<p>
    If you haven’t already, please review the local documentation for your training position (available in the ‘sub-categories’ on the right-hand side of the page) and the syllabus for your training programme, available from the <a href="https://community.vatsim.uk/files/downloads/category/17-atc-training/">ATC Training downloads library</a>.
    S2 & S3 students can also find comprehensive eLearning materials available on the <a href="https://moodle.vatsim.uk/">Moodle platform</a>.
</p>

<p>
    If you have any questions or concerns during your training, you can get in touch with the instructor team via the <a href="https://helpdesk.vatsim.uk/">helpdesk</a>, or with the mentoring team via the <a href="https://community.vatsim.uk/forum/226-training-department/">training forum</a>.
    This is your training, so please do not hesitate to ask about anything you feel is important: there is no such thing as a ‘silly question’!</p>
</p>

@stop

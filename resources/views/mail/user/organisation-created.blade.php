@component('mail::message')

    Hi, {{$user->name}}
    <br><br>
    You added the following organisation to your account:
    <br><br>
    <strong>Organisation:</strong> {{$user->organisation->name}}<br>
    <strong>Subscribed:</strong> {{$user->organisation->subscribed?'Yes':'No'}}<br>
    <strong>Trial ends on:</strong> {{$user->organisation->trial_end->format('d/m/Y')}}


@endcomponent

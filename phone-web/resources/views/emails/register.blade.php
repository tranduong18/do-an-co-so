@component('mail::message')

Hi <b>{{$user->name}}</b>,
<p>You are almost ready to start enjoying the benefits of E-Commerce</p>

<p>Simply click the button below to verify your email address</p>

<p>
    @component('mail::button', ['url' => url('activate/'.base64_encode($user->id))])
    Verify
    @endcomponent
</p>

<p>This will verify your email address, and then you will officially be part of the E-Commerce</p>

@endcomponent
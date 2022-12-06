@component('mail::message')
# Welcome, {{$user['user_name']}} !!

We are glade to have you on board in Khalilk Initiative.


@component('mail::button', ['url' => config('app.url')])
Click Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
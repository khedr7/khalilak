@component('mail::message')
# Welcome, {{ $user['fname'] }} !!
You are receiving this email because we received your request for joining our team as a volunteer. <br>
You can log in using this user name : {{ $user['user_name'] }} <br>
And password : {{ $password }}<br>
@component('mail::button', ['url' => config('app.url')])
Click Here
@endcomponent
This is an elementary password and You can change it whenever you want.<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent

<p>
    <b>{{ __('User name') }}</b>: {{ $user_name }}
</p>
{{-- <p><b>{{ __('Name') }}</b>: {{ $fname }} {{ $lname }}</p> --}}
<p><b>{{ __('Email') }}</b>: {{ $email }}</p>
<p><b>{{ __('Mobile') }}</b>: @if (isset($mobile))
        {{ $mobile }}
    @endif
</p>

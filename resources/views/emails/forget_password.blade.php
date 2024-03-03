<x-mail::message>
    Hello {{$user->name}},

    We understand it happens.

@component('mail::button', ['url' => url('admin/reset/' . $user->remember_token)])
Reset Your Password
@endcomponent

    in case you have any issues recovering your password, please contact us.
    Thanks,
    {{ config('app.name') }}
</x-mail::message>

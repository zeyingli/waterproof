@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            Note: this email was sent from a notification-only email address that cannot accept incoming email. Please do not reply to this message. 
            <br><br>
            © {{ date('Y') }} {{ config('app.name') }} or its affiliates. @lang('All rights reserved.') 
            <br><br>
            IST440, Section-003W FA18 Waterproof Project
            <br>
            Pennsylvania State University
        @endcomponent
    @endslot
@endcomponent

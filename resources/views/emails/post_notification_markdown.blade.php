@component('mail::message')

# New Post Published: {{ $title }}

{{ $description }}

@component('mail::button', ['url' => $website])
Visit Website
@endcomponent

Thanks for subscribing!

@endcomponent

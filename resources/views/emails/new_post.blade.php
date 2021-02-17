@component('mail::message')

<div>
    <h3>New post on {{ $website->name }}</h3>
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->description }}</p>
</div>

@endcomponent

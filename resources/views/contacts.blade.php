@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
    <div class="page">
        <h1>Контакты</h1>
        <p>Свяжитесь с нами любым удобным способом:</p>

        <ul class="contacts-list">
            @foreach ($contacts as $contact)
                <li>
                    <strong>{{ $contact['title'] }}:</strong>
                    {{ $contact['value'] }}
                </li>
            @endforeach
        </ul>
    </div>
@endsection
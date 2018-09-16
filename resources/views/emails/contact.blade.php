@extends('emails.layouts.master')

@section('header')
    Contact
@stop

@section('body')
    @if(!isset($contact['admin']))
        Nous avons bien réceptionné votre message. <br>
        Nous vous répondrons au plus vite. <br><br>
        Votre message : <br>
        {{ $contact['message'] }} <br><br>
        Merci, <br>
        A bientôt sur LaravelProject ! <br>
    @else
        Message envoyé par : {{ $contact['email'] }} <br>
        Message : <br>
        {{ $contact['message'] }} <br>
    @endif
@stop

@section('footer')

@stop
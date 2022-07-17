@extends('layout')
 
@section('title', 'User')

@section('content') 
    <form action="/user" method="POST">
        @csrf
        @method('POST')
        @include('components.forms.user')    
    </form>
    <script type="text/javascript" src="/js/user-create.js"></script>
@endsection
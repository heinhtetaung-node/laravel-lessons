@extends('layout')
 
@section('title', 'User')

@section('content') 
    <form action="/user/update" method="POST">
        @csrf
        @method('PUT')
        @include('components.forms.user')    
    </form>
      
    <script type="text/javascript" src="/js/user-create.js"></script>
@endsection
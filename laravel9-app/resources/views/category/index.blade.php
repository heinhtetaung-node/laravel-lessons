@extends('layout')
 
@section('title', 'Category')
 
{{-- 
@section('sidemenu')
    @parent
    
@endsection
--}}

@section('content') 

@foreach ($cats as $cat) 
    <p>{{ $cat['id'] }} - {{ $cat['name'] }}</p>
    <a href="/category/{{ $cat['id'] }}"><button>Edit</button></a> 
    <form action="/category/delete/{{ $cat['id'] }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endforeach
<br>
<div class="cus-pagination">
{{-- $users->links() --}}    
</div>
@endsection

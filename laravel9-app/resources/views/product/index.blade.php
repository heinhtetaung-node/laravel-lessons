@extends('layout')
 
@section('title', 'Products')
 
{{-- 
@section('sidemenu')
    @parent
    
@endsection
--}}

@section('content') 

<table>
    <tr>
        <th>Category</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Cost</th>
        <th>Options</th>
    </tr>
    @foreach ($prods as $prod) 
        <tr>
            <td>{{ $prod->category->name }}</td>
            <td>{{ $prod->name }}</td>
            <td>{{ $prod->price }}</td>
            <td>{{ $prod->cost }}</td>
            <td>
                <a href="/product/{{ $prod['id'] }}"><button>Edit</button></a> 
                <form action="/product/delete/{{ $prod['id'] }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<br>
<div class="cus-pagination">
{{-- $users->links() --}}    
</div>
@endsection

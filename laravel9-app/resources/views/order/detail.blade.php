@extends('layout')
 
@section('title', 'Order Detail')
 
@section('content') 

<p>Customer - {{ $order->customUser->name }}</p>
@php
    $total = 0;
    $cost = 0;
    foreach($order->orderItems as $item) {
        $total += $item->price;
        $cost += $item->cost;
    }
    $profit = $total - $cost;
@endphp

<p>Order Date - {{ $order->created_at }}</p>
<p>Total - {{ $total }}</p>
<p>Cost - {{ $cost }}</p>
<p>Profit - {{ $profit }}</p>

<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Price</th>
        <th>Cost</th>
    </tr>
    @foreach ($order->orderItems as $item) 
        <tr>
            <td>{{ $item->product->id }}</td>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->cost }}</td>
        </tr>
    @endforeach
</table>
<br>
<div class="cus-pagination">
{{-- $users->links() --}}    
</div>
@endsection

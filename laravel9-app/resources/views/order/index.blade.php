@extends('layout')
 
@section('title', 'Orders')
 
{{-- 
@section('sidemenu')
    @parent
    
@endsection
--}}

@section('content') 

<table>
    <tr>
        <th>Customer</th>
        <th>Date</th>
        <th>total</th>
        <th>Cost</th>
        <th>Profit</th>
        <th>Options</th>
    </tr>
    @foreach ($orders as $order) 
        <tr>
            <td>{{ $order->customUser->name }}</td>
            <td>{{ $order->created_at }}</td>
            
            <td>
                @php
                    $total = 0;
                    $cost = 0;
                    foreach($order->orderItems as $item) {
                        $total += $item->price;
                        $cost += $item->cost;
                    }
                    $profit = $total - $cost;
                @endphp
                {{ $total }}
            </td>

            <td>{{ $cost }}</td>
            <td>{{ $profit }}</td>
            <td>
                <a href="/order/{{ $order->id }}">Detail</a>
            </td>
        </tr>
    @endforeach
</table>
<br>
<div class="cus-pagination">
{{-- $users->links() --}}    
</div>
@endsection

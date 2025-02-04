@extends('layout')
@section('content')
<div class="row">
    @if($products->isEmpty())
        <div class="empty-state">
            <p>No products match your search. Try another keyword.</p>
        </div>
    @else
        @foreach($products as $product)
            <div class="col-md-4 product-card">
                <div class="card">
                    <img src="{{asset('images')}}/{{$product->image}}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">RM {{ $product->price }}</p>
                        <button type="submit" class="btn btn-danger btn-xs">Add to Cart</button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<style>
    .empty-state {
        text-align: center;
        color: #777;
        margin-top: 50px;
        white-space: normal;
        overflow: visible;
        width: 100%;
    }

    .card-img-top {
        width: 30%;
        height: 200px;
        object-fit: cover;
    }
</style>

@endsection
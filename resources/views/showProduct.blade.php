@extends('layout')
@section('content')
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-6">
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>IDe</td>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Category</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
               @foreach($products as $product)
                <tr>
                    <td style="white-space: nowrap;">{{$product->id}}</td>
                    <td><img src="{{asset('images')}}/{{$product->image}}" alt="" width="100" class="img-fluid"></td>
                    <td style="white-space: nowrap;">{{$product->name}}</td>
                    <td style="white-space: nowrap;">{{$product->description}}</td>
                    <td>RM{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->categoryID}}</td>
                    <td>
                        <a href="{{route('productDetail', ['id'=>$product->id])}}" class="btn btn-warning btn-xs">Edit</a>
                        &nbsp;
                        <a href="{{route('deleteProduct', ['id'=>$product->id])}}" class="btn btn-danger btn-xs" onClick="return confirm('确定？')">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-sm-4"></div>
    <div class="col-sm-2"></div>
    <div class="col-sm-6"></div>
</div>

@endsection

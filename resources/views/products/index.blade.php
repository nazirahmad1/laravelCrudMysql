@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="text-right mt-3">
            <a class="btn btn-sm btn-dark" href="products/create">New Product</a>
        </div>
        <h1>Products</h1>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Sno.</th>
              <th>Description</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
                
            <tr>
              <td>{{$product->name}}</td>
              <td>{{$product->description}}</td>
              <td>
                <img src="/products/{{$product->image}}" class="rounded-circle" width="50" height="50">
                </td>
                <td>
                  <a href="/product/{{$product->id}}/edit" class="btn btn-dark">Edit</a>
                
                  <form action="product/{{$product->id}}/delete" class="d-inline" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                  </form>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>


    @endsection
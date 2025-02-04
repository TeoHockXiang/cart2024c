<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function add(){
        $r = request(); // get all data from html input
        $addProduct = Product::create([
            'name' => $r -> productName, // name in database name
            'description' => $r -> productDescription,
            'quantity' => $r -> productQuantity,
            'price' => $r -> productPrice,
            'categoryID' => '1',
            'image' => 'empty.jpg',
        ]);
        //return view("addProduct");
        return redirect()->route('showProduct');
    }

    public function show(){
        $viewProduct = Product::all(); // SQL select * from products
        return view('showProduct')->with('products', $viewProduct); // products is variable name
    }

    public function edit($id){
        // Fetch the product with its related colours using eager loading
        $product = Product::with('colours')->find($id); // Retrieve product by id with colours relationship
        
        // Check if the product exists
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }
        
        // Pass the product to the view
        return view('editProduct')->with('product', $product); // 'product' is a single model instance
    }

    public function update(){
        $r=request(); // retrieve data from html input
        $product=Product::find($r->id); // find record based on primary key, make sure consistency
        if($r -> file('productImage') != ''){
            $image=$r -> file('productImage');
            $image->move('images', $image -> getClientOriginalName());
            $product -> image = $image -> getClientOriginalName();
        }

        $product->name=$r->productName;
        $product->description=$r->productDescription;
        $product->price=$r->productPrice;
        $product->quantity=$r->productQuantity;
        $product->save(); // update products set name = '$productname', price='$ProductPrice'.... where id='$id'
        return redirect()->route('showProduct');
    }

    public function delete($id){
        // $r=request(); NO INPUT
        $product=Product::find($id);
        $product->delete(); // delete from products where id='$id'
        return redirect()->route('showProduct');
    }

    public function detail($id){
        $products=Product::all()->where('id',$id);
        //select * from products where id='$id';
        return view('productDetail')->with('products', $products); // products is variable name, product is array
    }

    public function search(){
        $keyword = request()->input('keyword');
        if (!empty($keyword)) {
            $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->get();
        } else {
            // If the keyword is empty
            $products = collect();
        }
        return view('searchResult')->with('products', $products);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $product=Product::get();
        return view('products.index',['products'=>$product]);
    }

    public function create(){
        return view('products.create');
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        // dd($request->all());
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);

        $product = new Product();
        $product->image=$imageName;
        $product->name=$request->name;
        $product->description=$request->description;
        $product->save();

       return back()->withSuccess('Product successfuly created!'); 
        // return view('products.index'); 
        
    }

    public function edit($id){
        $product=Product::where('id',$id)->first();

        return view('products.edit',['product'=>$product]);
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        $product=Product::where('id',$id)->first();

        if(isset($request->image)){
            // upload image
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image=$imageName;
        }
      
        $product->name=$request->name;
        $product->description=$request->description;
        $product->save();

       return back()->withSuccess('Product successfuly update!'); 

    }

    public function destroy($id){
        $product=Product::where('id',$id)->first();

        $product->delete();
        return back()->withSuccess('Product successfully deleted!!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product['product'] = Product::paginate(1);
        return view('product.index',$product);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('product.create',[
            'product' => new Product(),
            'categories' => Category::pluck('namecategory','id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $fields = request()->validate([
            'name'=>'required|string|max:100',
            'date'=>'required|date|max:100',
            'value'=>'required|string',
            'category_id'=>'required|integer|max:20',
            'image'=>'required|max:10000|mimes:jpeg,png,jpg',
            
        ]);
        $message = [
            'name'=>'required',
            'date'=>'required',
            'value'=>'required',
            'image'=>'required',
            'category_id'=>'required'
        ];

        $this->validate($request,$fields,$message);

        $dateproduct = request()->except('_token');

        if ($request->hasfile('image')) {
                $dateproduct['image'] = $request->file('image')->store('uploads','public');
        }
        Product::insert($dateproduct);
        return redirect()->route('product.index')->with('mensaje','El producto fue agregado con exito');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        $categories = Category::pluck('namecategory','id');
        return $categories;
        return view('product.edit',['product'=>$product,
        'categories' => Category::pluck('namecategory','id')]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $fields = request()->validate([
            'name'=>'required|string|max:100',
            'date'=>'required|date|max:100',
            'value'=>'required|string',
            'category_id'=>'required|integer|max:20',
            'image'=>'required|max:10000|mimes:jpeg,png,jpg',
            
        ]);
        $message = [
            'name'=>'required',
            'date'=>'required',
            'value'=>'required',
            'image'=>'required',
            'category_id'=>'required'
        ];

        if ($request->hasfile('image')){

            $fields = ['image'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $message = ['image'=>'required'];
        }

        $this->validate($request,$fields,$message);
        
        $dateproduct = $request->except(['_token','_method']);

        if ($request->hasfile('image')) {
            $product = Product::findOrfail($id);
            Storage::delete(['public/'. $product->image]);
            $dateproduct['image'] = $request->file('image')->store('uploads','public');
        }
        Product::where('id','=',$id)->update($dateproduct);

        $product = Product::findOrfail($id);
        //return redirect()->route('product.index',$product);
        return redirect()->route('product.index')->with('mensaje','El producto ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product = Product::findOrfail($id);
        if (Storage::delete(['public/'. $product->photo]))
         {
            Product::destroy($id);
        }
       
        return redirect()->route('product.index')->with('mensaje','El producto ha sido eliminado');
    }

}

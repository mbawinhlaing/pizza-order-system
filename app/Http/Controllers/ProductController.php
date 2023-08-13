<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //Product List
    public function list(){
        $pizzas = Product::select('products.*','categories.name as category_name')
            ->when(request('key'),function($query){
            $query->where('products.name', 'like', '%' .request('key'). '%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(5);
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList', compact('pizzas'));
    }

    // Direct Product List
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    // create product
    public function create(Request $request){
        $this->productValidationCheck($request,'create');
        $data = $this->requestProductInfo($request);

        $fileName= uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] =$fileName;

        Product::create($data);
        return redirect()->route('product#list');
    }

    //Delete Product
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Product Delete Success..']);
    }

    // Product Edit
    public function edit($id){
        $pizza = Product::select('products.*','categories.name as category_name')
                ->leftjoin('categories', 'products.category_id','categories.id')
                ->where('products.id',$id)->first();
        return view('admin.product.edit', compact('pizza'));
    }

    // Product UpdatePage
    public function updatePage($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.updata',compact('pizza','category'));
    }

    //Product Update
    public function update( Request $request){

        $this->productValidationCheck($request,'update');
        $data=$this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')){
            $oldImageName = Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;
            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }

    // Request product info
    private function requestProductInfo($request){
        return[
            'category_id'=>$request->pizzaCategory,
            'name'=>$request->pizzaName,
            'description'=>$request->pizzaDescription,
            'price'=>$request->pizzaPrice,
            'waiting_time'=>$request->pizzaWaitingTime

        ];
    }

    // Product Validatin Check
    private function productValidationCheck($request, $action){
        $validatationRules =[
            'pizzaName'=>'required|min:5|unique:products,name,'.$request->pizzaId,
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required|min:10',
            'pizzaPrice'=>'required',
            'pizzaWaitingTime'=>'required'
        ];
        $validatationRules['pizzaImage'] = $action=="create" ? 'required|mimes:jpg,jpeg,png|file': 'mimes:jpg,jpeg,png|file';
        Validator::make($request->all(), $validatationRules)->validate();
    }
}

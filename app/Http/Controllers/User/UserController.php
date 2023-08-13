<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function user(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $Category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history= Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','Category', 'cart','history'));
    }

    //Change Passwrod page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    // Change Password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue = $user->password;//Hash Value
        if(Hash::check($request->oldPassword,  $dbHashValue)){
            $data=[
                'password'=>Hash::make($request->newPassword)
            ];
            User::where('id', Auth::user()->id)->update($data);

            return back()->with(['ChangeSuccess'=>'Password is Ready Change']);
        }
        return back()->with(['notMatch'=>'This old Password not match. Try Again']);
    }

    // User Account Change Page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    //Change User Role
    public function userChangeRole(Request $request){
        $updatesocur =[
            'role'=>$request->role
        ];
       User::where('id',$request->userId)->update($updatesocur);
    }
    // Direct User List
    public function userList(){
        $users = User::where('role','user')->get();
        return view('admin.user.list', compact('users'));
    }

    // User filter
    public function filter($CategoryId){
        $pizza = Product::Where('category_id',$CategoryId) ->orderBy('created_at','desc')->get();
        $Category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history= Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','Category','cart','history'));
    }

    //Uuser Account Change
    public function accountChange($id, Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for iamge
        if($request->hasFile('image')){
            $dbImage =User::where('id', $id)->first();
            $dbImage = $dbImage->image;
            if($dbImage !=null){
                Storage::delete('public/' . $dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        // old image/ check=>delate/ store

        User::where('id', $id)->update($data);
        return back()->with(['updateSuccess'=>'User Account Update...']);
    }

    // Direct Pizza Details
    public function pizzaDetails($pizzaId){
        $pizza = Product::where('id', $pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details', compact('pizza','pizzaList'));
    }

    // Direct Cart list
   public function cartList(){
    $cartList = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price','products.image as pizza_image')
                ->leftjoin('products','products.id','carts.product_id')
                ->where('carts.user_id',Auth::user()->id)
                ->get();

                $totalPrice =0;
                foreach($cartList as $c){
                    $totalPrice += $c->pizza_price*$c->qty;
                }

    return view('user.main.cart',compact('cartList','totalPrice'));
   }

   //Drict history Page
   public function history(){
    $order= Order::where('user_id', Auth::user()->id)->paginate('3');
    return view('user.main.history',compact('order'));

   }
        //Reqest User data
    private function getUserData($request){
        return[
                'name'=>$request->name,
                'email'=>$request->email,
                'gender'=>$request->gender,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'updated_at'=>Carbon::now()
        ];
     }
        // Account validation check
    private function accountValidationCheck($request){
         Validator::make($request->all(),[
                'name'=>'required',
                'email'=>'required',
                'gender'=>'required',
                'phone'=>'required',
                'image'=>'mimes:png,jpg,jpeg,webp|file',
                'address'=>'required'
         ])->validate();
    }

     // password validation Check
     private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:10',
            'newPassword'=>'required|min:6|max:10',
            'confirmPassword'=>'required|min:6|max:10|same:newPassword'
        ],[
            'oldPassword.required'=>'အဟောင္းနဲ့ဖျစ္ရမည္',
        ])->validate();
    }
}

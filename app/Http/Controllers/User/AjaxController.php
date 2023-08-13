<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //Return Pizza List
    public function pizzalist(Request $request){
        // logger($request->all());
        // logger($request->status);
        if($request->status == 'desc'){
            $data = Product::orderBy('created_at','desc')->get();
            }else{
                $data = Product::orderBy('created_at','asc')->get();
            }
            return response()->json($data,200);
    }

    // Return Pizza List
    public function addToCart(Request $request){
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response =[
            'message'=> 'Add to card Complete',
            'status' => 'success'
        ];
        return response()->json($response,200);
    }

    // Order
     public function order(Request $request){
        $total = 0;
         foreach($request ->all() as $item){
           $data = OrderList::create([
                'user_id'=> $item['userId'],
                'product_id'=>$item['productId'],
                'qty'=> $item['qty'],
                'total'=> $item['total'],
                'order_code'=> $item['order_code'],
            ]);
            $total += $data->total;
         }

         Cart::where('user_id',Auth::user()->id)->delete();
         Order::create([
            'user_id' =>Auth::user()->id,
            'order_code'=>$data->order_code,
            'total_price'=>$total+3000
         ]);
        return response()->json([
            'status'=>'true',
            'message'=>'order completed'
        ],200);
     }


    // Get Order Data
    private function getOrderData($request){
        return[
            'user_id'=> $request->userId,
            'product_id'=>$request->pizzaId,
            'qty'=>$request->count,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }

    // Clear Cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }
    //Clear Current Product
    public function clearCurrentProduct( Request $request){
        Cart::where('user_id', Auth::user()->id)
                ->where('product_id',$request->productId)
                ->where('id',$request->orderId)
                ->delete();
    }

    // increase pizza View Count
    public function increaseViewCount(Request $request){
        $pizza = Product::where('id', $request->productId)->first();
        $viewCount = [
            'view_count'=>$pizza->view_count + 1
        ];
        Product::where('id', $request->productId)->update( $viewCount);
    }
}

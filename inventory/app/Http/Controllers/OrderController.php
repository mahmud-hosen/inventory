<?php

namespace App\Http\Controllers;

use Cart;
use PDF;
use DB;
use App\Product;
use App\Customer;
use App\Order;
use App\Order_detail;


use Illuminate\Http\Request;

class OrderController extends Controller
{

            
            
     public function confirm_order(Request $request){
         $data=array();
        $data['customerId']=$request->customerId;
        $data['order_date']= date('d-m-y');
        $data['order_status']=$request->order_status;
        $data['total_product']=Cart::getTotalQuantity();

        $data['payment_status']=$request->payment_status;
        $data['payment_method']=$request->payment_method;
        $data['Shipping']=$request->Shipping;
        $data['tax']=$request->tax;
        $data['pay']=$request->pay;
        $data['due']=$request->due;
        $data['subTotal']=$request->subTotal;
        $data['total']=$request->total;
        $order_id=DB::table('orders')->insertGetId($data);   
        
        $contents = Cart::getContent();
   
        $order_data=array();

        foreach ($contents as $content ){
         $order_data['order_id']=$order_id;
         $order_data['product_id']=$content->id;
         $order_data['quantity']=$content->quantity;
         $order_data['unitcost']=$content->price;
         $order_data['total']=$content->price*$content->quantity;
   
        $insertSql=DB::table('order_details')->insert($order_data);
     }
     if($insertSql){
         Cart::clear();
        return ['status'=>'Success'];   
     }
     
  }

  public function orderList()
  {
       $orderList = DB::table('orders')
               ->join('customers', 'orders.customerId','customers.id')
               ->select('customers.id','customers.customer_name','orders.*')
               ->get();
            return response()->json(['orderList'=>$orderList],200);
  }
  
    public function orderDetails($id){
        $customarAndOrderDetails=DB::table('orders')
          ->join('customers','orders.customerId','customers.id')
          ->select('customers.customer_name','customers.customer_phone','customers.customer_address','customers.customer_account_number','orders.*')
          ->where('orders.id',$id)
          ->first();

          $order_details=DB::table('order_details')
         ->join('products','order_details.product_id','products.id')
         ->select('products.product_name','products.product_image','order_details.*')
         ->where('order_id',$id)
         ->get();
       return response()->json(['customarAndOrderDetails'=>$customarAndOrderDetails,'order_details'=>$order_details],200);
    }
     public function aprove_order($id){
        $aprove_order=DB::table('orders')->where('id',$id)->update(['order_status'=>'Approved']);
        return ['status'=>'Order status Approved'];
      }
      public function pending_order($id){
        $aprove_order=DB::table('orders')->where('id',$id)->update(['order_status'=>'Pending']);
        return ['status'=>'Order status Pending'];
      }
       public function delete_Order($id){
        $orderItems = Order::destroy($id);
        $orderDetailsItem = DB::table('order_details')->where('order_id', $id)->delete();
          if(($orderItems && $orderDetailsItem) == TRUE){
            return ['status'=>'Order deleted'];
          }
      }
      




  


    
}

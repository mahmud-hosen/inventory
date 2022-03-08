<?php

namespace App\Http\Controllers;

use Cart;
use PDF;

use App\Product;
use App\Customer;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function productAddToCart($id)
    {
        $product = Product::find($id);

         $data=array();
         $data['id'] = $product->id;
         $data['name'] = $product->product_name;
         $data['price'] = $product->product_selling_price;
         $data['quantity'] = 1;

         Cart::add($data);
        
         $cartProducts = Cart::getContent();
         $cartTotalQuantity = Cart::getTotalQuantity();
         $subTotal = Cart::getSubTotal();
         $total = Cart::getTotal();
         return response()->json(['cartProducts'=>$cartProducts,'cartTotalQuantity'=>$cartTotalQuantity,'subTotal'=>$subTotal,'total'=>$total],200);
   
    }

     public function clearCart()
    {
         Cart::clear();        
         $cartProducts = Cart::getContent();
         $cartTotalQuantity = Cart::getTotalQuantity();
         $subTotal = Cart::getSubTotal();
         $total = Cart::getTotal();
         return response()->json(['cartProducts'=>$cartProducts,'cartTotalQuantity'=>$cartTotalQuantity,'subTotal'=>$subTotal,'total'=>$total],200);
   
    }
    public function updateCart(Request $request)
    {
       $id = $request->id;
       $update = Cart::update($id, array(
        'quantity' => array(
            'relative' => false,
            'value' => $request->quantity,
          ),
        ));
        if($update)
        {
            $cartProducts = Cart::getContent();
            $cartTotalQuantity = Cart::getTotalQuantity();
            $subTotal = Cart::getSubTotal();
            $total = Cart::getTotal();
            return response()->json(['cartProducts'=>$cartProducts,'cartTotalQuantity'=>$cartTotalQuantity,'subTotal'=>$subTotal,'total'=>$total],200);
        }  
    }
     public function removeItemFromCart( $id)
    {
       $remove = Cart::remove($id);
        if($remove)
        {
            $cartProducts = Cart::getContent();
            $cartTotalQuantity = Cart::getTotalQuantity();
            $subTotal = Cart::getSubTotal();
            $total = Cart::getTotal();
            return response()->json(['cartProducts'=>$cartProducts,'cartTotalQuantity'=>$cartTotalQuantity,'subTotal'=>$subTotal,'total'=>$total],200);
        }  
    }
    
     public function createInvoice($id)
     {
         if(Cart::isEmpty()){
           //
         }else{
            $customerDetails = Customer::find($id);

            $cartProductsList = Cart::getContent();
            $cartTotalQuantity = Cart::getTotalQuantity();
            $subTotal = Cart::getSubTotal();
            $total = Cart::getTotal();
            return response()->json(['customerDetails'=>$customerDetails,'cartProductsList'=>$cartProductsList,'cartTotalQuantity'=>$cartTotalQuantity,'subTotal'=>$subTotal,'total'=>$total],200);

         }
        

     }
    

    
    

    

   
}

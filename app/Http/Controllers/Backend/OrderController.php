<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderDetail;
use PDF;
use Stripe;
use DB;
class OrderController extends Controller
{
	public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index(){
		// $order = DB::table('orders')
		// ->join('shipping_addresses','shipping_addresses.id','=','orders.shipping_id')
		// ->get();
		$order=Order::with('shipping','payment')->get();
    	//return $order;
    	return view('admin.order.order',['order' => $order]);
    }

    public function viewOrderDetails($orderId){
		$order = Order::with('payment','shipping')->find($orderId);
		// dd($order);
    	$productDetails = OrderDetail::where('order_id', $order->id)->get();
    	//return $order;
    	return view('admin.order.view-order',[
    		'orderDetails'=>$order,
    		'productDetails' => $productDetails
    	]);
    }

    public function orderInvoice($orderId){
    	$order = Order::with('customer','payment','shipping')->find($orderId);
    	$productDetails = OrderDetail::where('order_id', $order->id)->get();
    	//return $order;
    	return view('admin.order.order-invoice',[
    		'orderDetails'=>$order,
    		'productDetails' => $productDetails
    	]);
    }

    public function orderExportPdf($orderId){
    	$order = Order::with('customer','payment','shipping')->find($orderId);
    	$productDetails = OrderDetail::where('order_id', $order->id)->get();
    	$pdf = PDF::loadView('admin.order.exportAsPdf', [
    		'orderDetails'=>$order,
    		'productDetails' => $productDetails
    	]);

    	$fileName = 'invoice'.$orderId.'.pdf';
    	return $pdf->stream($fileName);
    }
    

     /*public function stripePost(Request $request){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
  
        Session::flash('success', 'Payment successful!');
          
        return back();
    }*/
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ShippingAddress;
use App\Model\Order;
use App\Model\OrderDetail;
// use App\Model\
use App\Model\Payment;
use Session;
use Cart;
use Stripe;
use URL;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/

use PayPal\Api\ItemList;
use PayPal\Api\Payer;
// use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;



use Illuminate\Support\Facades\Config;

class OrderController extends Controller
{
    private $_api_context;
    public function shippingInfo(Request $request)
    {
        /*$shipping = ShippingAddress::where('customer_id', Session::get('customerId'))->get();
    	if ($shipping) {
    		$shipping->full_name = $request->full_name;
        	$shipping->email_address = $request->email;
        	$shipping->phone_no = $request->number;
        	$shipping->address = $request->address;
        	$shipping->save();
    	}*/
        $shippingInfo = new ShippingAddress();
        // $shippingInfo->customer_id = Session::get('customerId');
        $shippingInfo->first_name = $request->first_name;
        $shippingInfo->last_name = $request->last_name;
        $shippingInfo->street = $request->street;
        $shippingInfo->postcode = $request->postalcode;
        $shippingInfo->address = $request->address;
        $shippingInfo->company = $request->company;
        $shippingInfo->city = $request->city;
        
        $shippingInfo->email_address = $request->email;
        $shippingInfo->phone_no = $request->phone_no;
        $shippingInfo->comments = $request->comment;

        $shippingInfo->save();

        Session::put('shippingId', $shippingInfo->id);
        /*Session::put('full_name',$request->full_name);
        Session::put('email_address', $request->email);
        Session::put('phone_no', $request->number);
        Session::put('address', $request->address);*/

        return response()->json("Shipping Info Putting in session");
    }

    public function confirmOrder(Request $request)
    {
        // echo $request->type; exit;
        if ($request->type == 'cash') {
            // echo 1; exit;
            $order = new Order();
            $order->customer_id = Session::get('customerId');
            $order->shipping_id = Session::get('shippingId');
            $order->order_total = Cart::subtotal();
            $order->order_status = 'Received';
            $order->save();

            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->payment_info = $request->type;
            if($request->type == 'cash')
            $payment->status = 'Pending';
            $payment->save();

            $cartProducts = Cart::content();
            foreach ($cartProducts as $cartProduct) {
                $orderDetails = new OrderDetail();
                $orderDetails->order_id = $order->id;
                $orderDetails->product_id = $cartProduct->id;
                $orderDetails->product_name = $cartProduct->name;
                $orderDetails->product_price = $cartProduct->price;
                $orderDetails->product_quantity = $cartProduct->qty;
                $orderDetails->save();
            }
            Cart::destroy();

            return response()->json('Order Confirmed');
        }
        if ($request->type == 'stripe') {

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
            ]);

            $order = new Order();
            $order->customer_id = Session::get('customerId');
            $order->shipping_id = Session::get('shippingId');
            $order->order_total = Cart::subtotal();
            $order->save();

            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->payment_info = $request->type;
            $payment->save();

            $cartProducts = Cart::content();
            foreach ($cartProducts as $cartProduct) {
                $orderDetails = new OrderDetail();
                $orderDetails->order_id = $order->id;
                $orderDetails->product_id = $cartProduct->id;
                $orderDetails->product_name = $cartProduct->name;
                $orderDetails->product_price = $cartProduct->price;
                $orderDetails->product_quantity = $cartProduct->qty;
                $orderDetails->save();
            }
            Cart::destroy();

            return response()->json('Order Confirmed');
        }
        if ($request->type == 'paypal') {
            
            // echo 1; exit;
            $paypal_conf = Config::get('paypal');
            $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret']
            ));
            $this->_api_context->setConfig($paypal_conf['settings']);



            $order = new Order();
            $order->customer_id = Session::get('customerId');
            $order->shipping_id = Session::get('shippingId');
            $order->order_total = Cart::subtotal();
            $order->save();

            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->payment_info = $request->type;
            //$payment->save();


            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_1 = new Item();

            $item_1->setName('Item 1')
                /** item name **/
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice(100);
            /** unit price **/


            // $cartProducts = Cart::content();
            // print_r($cartProducts);exit;
            // foreach($cartProducts as $cartProduct){
            //     $orderDetails = new OrderDetail();
            //     $orderDetails->order_id = $order->id;
            //     $orderDetails->product_id = $cartProduct->id;
            //     $orderDetails->product_name = $cartProduct->name;
            //     $orderDetails->product_price = $cartProduct->price;
            //     $orderDetails->product_quantity = $cartProduct->qty;
            //     $orderDetails->save();
            // }
            // Cart::destroy();

            $item_list = new ItemList();
            $item_list->setItems(array($item_1));

            $amount = new Amount();
            $amount->setCurrency('USD')
                ->setTotal(100);
            // $amount->setCurrency('USD')
            // ->setTotal($request->get('amount'));

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::to('status'))
                /** Specify return URL **/
                ->setCancelUrl(URL::to('status'));

            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
            // dd($payment->create($this->_api_context));exit;
            try {

                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {

                if (\Config::get('app.debug')) {

                    \Session::put('error', 'Connection timeout');
                    return Redirect::to('/');
                } else {

                    \Session::put('error', 'Some error occur, sorry for inconvenient');
                    return Redirect::to('/');
                }
            }

            foreach ($payment->getLinks() as $link) {

                if ($link->getRel() == 'approval_url') {

                    $redirect_url = $link->getHref();
                    break;
                }
            }

            /** add payment ID to session **/
            Session::put('paypal_payment_id', $payment->getId());



            return response()->json('Order Confirmed');
        }
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Points;
use App\Models\Plan;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;

class PointsController extends Controller
{
    public function selftopup()
    {
        $current_timestamp = Carbon::now()->timestamp;
        $orderId = "OR-" . auth()->user()->id . $current_timestamp;
        $plan = Plan::orderBy("id", "desc")->first();
        return view("self-topup", compact("current_timestamp", "orderId", "plan"));
    }

    public function paymenttopup(Request $request)
    {
        try {
            $provider = new PayPalClient(config('paypal'));
            $token = $provider->getAccessToken();
            $provider->setAccessToken($token);

            $planid = Crypt::decrypt($request->plan_id);
            $plan = Plan::find($planid);
            if (!$plan) {
                return response()->json([
                    'message' => trans("messages.invalid_request"),
                    'alert-type' => 'error'
                ], 500);
            }

            // Prepare payment data
            $paymentData = [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'amount' => [
                        'currency_code' => config('paypal.currency', 'USD'),
                        'value' => $plan->amount,
                    ],
                    'description' => 'Purchase of ' . $plan->points . ' points',
                ]],
                'application_context' => [
                    'cancel_url' => route('user.paypal.cancel', ['plan_id' => $request->plan_id]),
                    'return_url' => route('user.paypal.success', ['plan_id' => $request->plan_id]),
                ],
            ];

            // Create order
            $response = $provider->createOrder($paymentData);

            if (isset($response['id'])) {
                $approvalUrl = $response['links'][1]['href'];  
                return  response()->json(['approvalUrl' => $approvalUrl, 'message' => trans("messages.add_success", ['module' => trans("cruds.point.title_singular")]), 'alert-type' =>  'success'], 200);
            } else {
                Log::error("PayPal createOrder response does not contain expected 'id' key.", ['response' => $response]);
                return response()->json([
                    'message' => 'Error creating PayPal order',
                    'alert-type' => 'error'
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error("Payment Topup Error: " . $e->getMessage() . $e->getFile() . $e->getLine(), ['exception' => $e]);
            return response()->json([
                'message' => trans("messages.something_went_wrong")
            ], 500);
        }
    }

    public function success(Request $request)
    {
        try {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);

            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                $purchase_unit = $response['purchase_units'][0];
                $capture = $purchase_unit['payments']['captures'][0];

                $transaction = new Transaction();
                $transaction->user_id = auth()->user()->id;
                $transaction->transaction_id = $response['id'];
                $transaction->status = $response['status'];
                $transaction->amount = $capture['amount']['value'];
                $transaction->currency = $capture['amount']['currency_code'];
                $transaction->created_at = $capture['create_time'];
                $transaction->updated_at = $capture['update_time'];
                $transaction->description = $purchase_unit['description'] ?? 'Purchase of points';
                $transaction->payer_id = $response['payer']['payer_id'];
                $transaction->payer_email = $response['payer']['email_address'];
                $transaction->payer_name = $response['payer']['name']['given_name'] . ' ' . $response['payer']['name']['surname'];
                $transaction->save();

                // store data in points table
                $planid = Crypt::decrypt($request->plan_id) ?? 1;
                $plan = Plan::find($planid);

                if($plan){
                    $input = array();
                    $input["plan_id"] =  $planid;
                    $input["user_id"] = auth()->user()->id;
                    $input["credit"] = $plan->points;
                    $input["amount"] = $plan->amount;
                    $input["status"] = 1;
                    $input["payment_id"] = NULL;
                    $input["available_general_point"] = $plan->points;

                    $lastPointRow = Points::where(["user_id" => auth()->user()->id, "type" => config("constant.point_type.general")])->orderBy("id", "desc")->first();
                    if ($lastPointRow) {
                        $avlGenPoint = $lastPointRow->available_general_point;
                        $input["available_general_point"] = $avlGenPoint + $plan->points;
                    }
                    $input["type"] =  config("constant.point_type.general");
                    Points::create($input);
                }                
                return redirect()->route('user.profile', ['tab' => 'information'])->with('success', 'Payment completed successfully!');
                // return redirect()->route('user.profile', ['tab' => 'information'])->with(['message' => 'Payment completed successfully!','alert-type' =>  'success']);
                // return redirect()->route('user.profile')->with(['message' => trans("messages.profile.success"),'alert-type' =>  'success']);
            } else {
                Log::error("PayPal payment capture failed", ['response' => $response]);
                return redirect()->route('user.profile', ['tab' => 'information'])->with('error', 'Payment capture failed. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error("PayPal success callback error: " . $e->getMessage() . $e->getFile() . $e->getFile(), ['exception' => $e]);
            return response()->json([
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            ], 500);
        }
    }

    public function cancel(Request $request)
    {
        try {
            return redirect()->route('user.self-top-up')->with('error', 'Payment failed. Please try again.');
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Payment was cancelled',
                'alert-type' => 'error'
            ], 500);
        }
    }





    // PayPalController.php
    // public function success(Request $request)
    // {
    //     try {
    //         $provider = new PayPalClient([
    //             'clientId' => config('paypal.client_id'),
    //             'clientSecret' => config('paypal.client_secret')
    //         ]);
    //         $token = $provider->getAccessToken();
    //         $provider->setAccessToken($token);

    //         $paymentId = $request->get('paymentId');
    //         $payerId = $request->get('PayerID');

    //         // Execute the payment
    //         $payment = $provider->executePayment($paymentId, $payerId);

    //         // Update Points table, log the payment, etc.
    //         // (Implement your logic here)

    //         return redirect()->route('home')->with('success', 'Payment successful!');
    //     } catch (\Throwable $th) {
    //         Log::error("Payment Execution Error: " . $th->getMessage(), ['exception' => $th]);
    //         return redirect()->route('home')->with('error', 'Payment failed!');
    //     }
    // }

    // public function cancel()
    // {
    //     return redirect()->route('home')->with('error', 'Payment cancelled!');
    // }


    // public function paymenttopup(Request $request)
    // {
    //     try {
    //         $provider = new PayPalClient([]);
    //         $token = $provider->getAccessToken();
    //         $provider->setAccessToken($token);


    //         $planid = Crypt::decrypt($request->plan_id);
    //         $plan = Plan::where("id",$planid)->first();
    //         if(!$plan){
    //             return  response()->json(['message' => trans("messages.invalid_request"), 'alert-type' => 'error'],500);
    //         }
    //         $input = array();
    //         $input["plan_id"] =  $planid;
    //         $input["user_id"] = auth()->user()->id;
    //         $input["credit"] = $plan->points;
    //         $input["amount"] = $plan->amount;
    //         $input["status"] = 1;
    //         $input["payment_id"] = NULL;
    //         $input["available_general_point"] = $plan->points;
    //         $lastPointRow = Points::where(["user_id" => auth()->user()->id, "type" => config("constant.point_type.general")])->orderBy("id","desc")->first();
    //         if($lastPointRow){
    //             $avlGenPoint = $lastPointRow->available_general_point;
    //             $input["available_general_point"] = $avlGenPoint + $plan->points;
    //         }
    //         $input["type"] =  config("constant.point_type.general");
    //         $create = Points::create($input);

    //         return  response()->json(['message' => trans("messages.add_success",['module' => trans("cruds.point.title_singular")]),'alert-type' =>  'success'],200);
    //     } catch (\Throwable $th) {
    //         return  response()->json(['message' => trans("messages.something_went_wrong")],500);
    //     }
    // }
}

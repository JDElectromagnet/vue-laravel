<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;
use DateTime;
use DateTimeZone;

class OrderController extends Controller
{
    public function index(){
        return Inertia::render('Orders');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'buyer' => 'required|max:20',
            'receipt_id' => 'required|max:20',
            'items' => 'required|unique:orders|max:255',
            'buyer_email' => 'required|max:50',
            'note' => 'required|max:30',
            'city' => 'required|max:20',
            'phone' => 'required|max:20',
        ]);
 
        if ($validator->fails()) {
            // echo json_encode("JD");
            $errorArray = array(
                'errors' => $validator->errors()->toArray()
            );
            return $errorArray;

        }
        else {
        $receiptId = $request->input('receipt_id');
        $salt = 'your-salt'; // Replace with your actual salt
        $hashKey = hash('sha512', $receiptId . $salt);
            
        $data = array(
            'amount' => $request->input('amount'),
            'buyer' => $request->input('buyer'),
            'receipt_id' => $request->input('receipt_id'),
            'items' => $request->input('items'),
            'buyer_email' => $request->input('buyer_email'),
            'note' => $request->input('note'),
            'city' => $request->input('city'),
            'phone' => $request->input('phone'),
            'buyer_ip' => $request->ip(),
            'hash_key' => $hashKey,
            'entry_at' => $this->time_converter(),
            'entry_by' => auth()->user()->id,
        );
        Order::create($data);
        return $data;

        }
 
    }

    private function time_converter(){
        $serverTimezone = new DateTimeZone('UTC');

        $serverTime = new DateTime('now', $serverTimezone);

        $dhakaTimezone = new DateTimeZone('Asia/Dhaka');

        $dhakaTime = $serverTime->setTimezone($dhakaTimezone);

        $dhakaTimeString = $dhakaTime->format('Y-m-d');

        return $dhakaTimeString;
    }

    public function list(){
        return Inertia::render('OrderList');
    }

    public function get(){
        $data  = Order::all();
        return $data;
        // return Inertia::render('OrderList', $data);
    }

    
}

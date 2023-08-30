<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index(){
        return Inertia::render('Orders');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'buyer' => 'required|max:255',
            'receipt_id' => 'required|max:20',
            'items' => 'required|unique:orders|max:255',
            'buyer_email' => 'required|max:50',
            'note' => 'required|max:30',
            'city' => 'required|max:20',
            'phone' => 'required|max:20',
            // 'buyer_ip' => 'required',
            // 'hash_key' => 'required|max:255',
            // 'entry_at' => 'required',
            // 'entry_by' => 'required|max:10',
        ]);
 
        if ($validator->fails()) {
            // echo json_encode("JD");
            $errorArray = array(
                'errors' => $validator->errors()->toArray()
            );
            return $errorArray;

        }
        else {
            // $errorArray = array(
            //     'errors' => null
            // );

            
        $data = array(
            'amount' => $request->input('amount'),
            'buyer' => $request->input('buyer'),
            'receipt_id' => $request->input('receipt_id'),
            'items' => $request->input('items'),
            'buyer_email' => $request->input('buyer_email'),
            'note' => $request->input('note'),
            'city' => $request->input('city'),
            'phone' => $request->input('phone'),
            // 'buyer_ip' => $request->buyer_ip(),
            // 'hash_key' => $request->hash_key(),
            // 'entry_at' => $request->entry_at(),
            // 'entry_by' => $request->entry_by(),
            'errors' => null
        );
        return $data;

        }
        
        // // Retrieve the validated input...
        // $validated = $validator->validated();
 
        // // Retrieve a portion of the validated input...
        // $validated = $validator->safe()->only(['name', 'email']);
        // $validated = $validator->safe()->except(['name', 'email']);
 
    }

    
}

<?php

namespace App\Http\Controllers;

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
            'buyer_ip' => 'required',
            'note' => 'required|max:30',
            'city' => 'required|max:20',
            'phone' => 'required|max:20',
            'hash_key' => 'required|max:255',
            'entry_at' => 'required',
            'entry_by' => 'required|max:10',
        ]);
 
        if ($validator->fails()) {
            echo json_encode("false");
            // return redirect('post/create')
            //             ->withErrors($validator)
            //             ->withInput();
        }else {
            echo json_encode("true");
        }
 

        // // Retrieve the validated input...
        // $validated = $validator->validated();
 
        // // Retrieve a portion of the validated input...
        // $validated = $validator->safe()->only(['name', 'email']);
        // $validated = $validator->safe()->except(['name', 'email']);
 
    }

    
}

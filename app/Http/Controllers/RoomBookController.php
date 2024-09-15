<?php

namespace App\Http\Controllers;

use App\Models\RoomBook;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RoomBookController extends Controller
{
    // Display booking form for a specific room
    public function book($id)
    {
        $user = auth()->user(); // Fetch the authenticated user
        $room = Room::findOrFail($id); // Fetch the room by its ID
        return view('frontend.room.book', compact('room', 'user'));
    }

    // View bookings
    public function bookview($id)
    {
        $book = RoomBook::findOrFail($id);
        return view('frontend.room.bookview', compact('book'));
    }

    // Store booking details
    public function store(Request $request)
    {
        // Validate the booking request
        $validatedData = $request->validate([
            'room_id' => 'required|exists:room,id',
        
        
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
            'guestn' => 'required|integer|min:1|max:10',
            'payment_type' => 'required|string|in:cash,online',
        ]);
    
        $user = auth()->user(); // Ensure user is authenticated
        $room = Room::findOrFail($request->room_id);
    
        // Create a new booking instance
        $roombook = new RoomBook();
        $roombook->user_id = $user->id;
        $roombook->room_id = $validatedData['room_id'];
        $roombook->name = $request->fullname;
        $roombook->phone =$request->phone;
        $roombook->checkin = $validatedData['checkin'];
        $roombook->checkout = $validatedData['checkout'];
        $roombook->guestn = $validatedData['guestn'];
        $roombook->message = $request->message;
        $roombook->roomtype = $room->category->title ?? '-';
        $roombook->roomno = $room->name;

    
        // Initially set status to pending
        $roombook->status = 'pending';
        $roombook->save();

        $room->room_status = 'booked';
        $room->update(); 
    
    
    
        // Handle payment
        if ($validatedData['payment_type'] === 'online') {
            $response = $this->payWithKhalti($roombook);
            $d_res = json_decode($response);
            if ($d_res && isset($d_res->payment_url)) {
                return redirect($d_res->payment_url);
            } else {
                
                return redirect()->route('roombook.index')->with('error', 'Khalti payment failed. Contact admin.');
            }
        }
    
        // Return response
        return redirect()->route('bookview', ['id' => $roombook->id])->with('success', 'Booking successful!');
    }
    

    public function payWithKhalti($roombook)
    {
        $amount = $roombook->room->price;
        $amount_paisa = $amount * 100;
        $orderId = "{$roombook->id}";
        $orderName = $roombook->room->name;
        $customer = [
            'name' => $roombook->name,
            'email' => '',
            'phone' => "{$roombook->phone}"
        ];
        $product_detail = [
            "identity" => $roombook->room->id,
            "name" => $orderName,
            "total_price" => "$amount_paisa",
            "quantity" => '1',
        ];
        $khalti_base_url = 'https://a.khalti.com/api/v2/';
        $init_url = 'epayment/initiate/';

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'key bce58b9ec7d1478f916e78c13f4660ec'
        ])->post($khalti_base_url . $init_url, [
            'return_url' => "http://localhost:8000/khalti/callback",
            'website_url' => "http://localhost:8000",
            'amount' => "$amount_paisa",
            'purchase_order_id' => $orderId,
            'purchase_order_name' => $orderName,
            'customer_info' => $customer,
            // 'product_details' =>  $product_detail,
            // 'merchant_username' => '',
            // 'merchant_extra' => ''
        ]);
        return ($response);
    }

    public function khaltiCallback(Request $request)
    {
        // dd($request->all());
        $roombook =RoomBook::findOrfail($request->purchase_order_id);
        $roombook->status = 'success';
        $roombook->update();
       
        
        // Return response
        return redirect()->route('bookview', ['id' => $roombook->id])->with('success', 'Payment and Booking successful!');
   

    }
}

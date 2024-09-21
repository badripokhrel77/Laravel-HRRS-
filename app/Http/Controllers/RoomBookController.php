<?php

namespace App\Http\Controllers;

use App\Models\RoomBook;
use App\Models\Transaction;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon; // Import Carbon for date calculations
use Illuminate\Support\Facades\DB; // For database transactions

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
        $transaction = Transaction::where('roombook_id', $id)->first(); // Get the transaction for the booking

        return view('frontend.room.bookview', compact('book', 'transaction'));
    }

    // Store booking details
    public function store(Request $request)
    {
        // Validate the booking request
        $validatedData = $request->validate([
            'room_id' => 'required|exists:room,id', // Assuming table name is 'rooms'
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
            'guestn' => 'required|integer|min:1|max:10',
            'payment_type' => 'required|string|in:cash,online',
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|string',
        ]);

        // Start a database transaction to ensure data integrity
        DB::beginTransaction();

        try {
            $user = auth()->user(); // Ensure user is authenticated
            $room = Room::findOrFail($validatedData['room_id']);

            // Check room availability for the selected dates
           // $isAvailable = $this->checkRoomAvailability($room->id, $validatedData['checkin'], $validatedData['checkout']);
           // if (!$isAvailable) {
            //    return redirect()->back()->with('error', 'The selected room is not available for the chosen dates.');
           // } 

            // Calculate the number of nights
            $checkinDate = Carbon::parse($validatedData['checkin']);
            $checkoutDate = Carbon::parse($validatedData['checkout']);
            $nights = $checkinDate->diffInDays($checkoutDate);

            // Calculate the total amount
            $totalAmount = $room->price * $nights;

            // Create a new booking instance
            $roombook = new RoomBook();
            $roombook->user_id = $user->id;
            $roombook->room_id = $room->id;
            $roombook->name = $validatedData['fullname'];
            $roombook->phone = $validatedData['phone'];
            $roombook->checkin = $validatedData['checkin'];
            $roombook->checkout = $validatedData['checkout'];
            $roombook->roomtype = $room->category->title ?? '-';
            $roombook->roomno = $room->name;
            $roombook->guestn = $validatedData['guestn'];
            $roombook->message = $validatedData['message'] ?? '';
            $roombook->room_status = 'booked';

            $roombook->save();

            // Update room status to 'booked'
            $room->room_status = 'booked';
            $room->save();

            // Create a transaction based on the payment type
            $transaction = new Transaction();
            $transaction->roombook_id = $roombook->id;
            $transaction->amount = $totalAmount; // Set the calculated total amount
            $transaction->payment_status = 'pending';

            if ($validatedData['payment_type'] === 'cash') {
                // For cash payments, set status as 'pending'
                $transaction->payment_method = 'cash';

                $transaction->save();

                DB::commit();

                return redirect()->route('bookview', ['id' => $roombook->id])
                    ->with('success', 'Room booking submitted successfully! Please pay at the hotel.');
            } elseif ($validatedData['payment_type'] === 'online') {
                // For online payments, initiate Khalti payment
                $transaction->payment_method = 'online';

                $transaction->save();

                DB::commit();

                // Proceed with Khalti payment process
                $response = $this->payWithKhalti($roombook, $totalAmount);
                $d_res = json_decode($response);
              

                if ($d_res && isset($d_res->payment_url)) {
                    return redirect($d_res->payment_url);
                } else {
                    return redirect()->route('roombook.index')->with('error', 'Khalti payment failed. Contact admin.');
                }
            }

            // Fallback response
            DB::commit();
            return redirect()->route('bookview', ['id' => $roombook->id])->with('success', 'Room Booking submitted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::info($e);
            // Log the exception or handle it as needed
            return redirect()->back()->with('error', 'An error occurred while processing your booking. Please try again.');
        }
    }

    /**
     * Check room availability for the selected dates
     *
     * @param int $roomId
     * @param string $checkin
     * @param string $checkout
     * @return bool
     */
    private function checkRoomAvailability($roomId, $checkin, $checkout)
    {
        // Check if there's any booking that overlaps with the desired dates
        $overlappingBookings = RoomBook::where('room_id', $roomId)
            ->where(function ($query) use ($checkin, $checkout) {
                $query->whereBetween('checkin', [$checkin, $checkout])
                    ->orWhereBetween('checkout', [$checkin, $checkout])
                    ->orWhere(function ($query) use ($checkin, $checkout) {
                        $query->where('checkin', '<=', $checkin)
                            ->where('checkout', '>=', $checkout);
                    });
            })
            ->count();

        return $overlappingBookings === 0;
    }

    /**
     * Initiates Khalti Payment
     *
     * @param RoomBook $roombook
     * @param float $totalAmount
     * @return \Illuminate\Http\Client\Response
     */



    public function payWithKhalti($roombook, $totalAmount)
    {
        $amount_paisa = intval($totalAmount * 100); // Convert to paisa and ensure it's an integer
        $orderId = "{$roombook->id}";
        $orderName = $roombook->room->name;
        $customer = [
            'name' => $roombook->name,
            'email' => $roombook->user->email ?? '', // Ensure user has an email
            'phone' => "{$roombook->phone}"
        ];
        // Optionally include product details if required by Khalti
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
            'Authorization' => 'Key bce58b9ec7d1478f916e78c13f4660ec'
        ])->post($khalti_base_url . $init_url, [
            'return_url' => "http://localhost:8000/khalti/callback", //route('khalti.callback'), // Use route helper for dynamic URLs
            'website_url' => "http://localhost:8000",     // config('app.url'),
            'amount' => $amount_paisa,
            'purchase_order_id' => $orderId,
            'purchase_order_name' => $orderName,
            'customer_info' => $customer,
            // 'product_details' =>  $product_detail,
            // 'merchant_username' => '',
            // 'merchant_extra' => ''
        ]);
       

        return ($response);
    }

    /**
     * Handles Khalti Payment Callback
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function khaltiCallback(Request $request)
    {
        // Retrieve booking and transaction using purchase_order_id from the request
        $roombook = RoomBook::findOrFail($request->purchase_order_id);
        $transaction = Transaction::where('roombook_id', $roombook->id)->firstOrFail();

        // Verify the payment with Khalti using the token from the request
        $verificationResponse = $this->verifyKhaltiPayment($request->pidx);

        if ($verificationResponse && $verificationResponse['status'] == 'Completed' && $verificationResponse['total_amount'] == $transaction->amount) {
            // Update the transaction status
            $transaction->payment_status = 'success';
            $transaction->update();

            return redirect()->route('bookview', ['id' => $roombook->id])
                ->with('success', 'Payment and booking successful!');
        } else {
            // Handle failed payment
            $transaction->payment_status = 'failed';
            $transaction->update();

            return redirect()->route('bookview', ['id' => $roombook->id])
                ->with('error', 'Khalti payment failed. Please try again.');
        }
    }

    /**
     * Verifies Khalti Payment
     *
     * @param string $token
     * @param int $amount
     * @return array|null
     */
    protected function verifyKhaltiPayment($pidx)
    {
        $khalti_base_url = 'https://a.khalti.com/api/v2/payment/verify/';
        $secret_key = env('KHALTI_SECRET_KEY'); // Use environment variable

        $response = Http::withHeaders([
            'Authorization' => 'key bce58b9ec7d1478f916e78c13f4660ec',
            'Content-Type' => 'application/json',
        ])->post($khalti_base_url, [
            'pidx' => $pidx,
        ]);
 
        if ($response->successful()) {
            return  json_decode($response);
        }

        return null;
    }
}



//     public function cancel($id)
// {
//     $booking = RoomBook::find($id);
    
//     // Update room status to 'cancel'
//     $booking->room->room_status = 'cancel';
//     $booking->room->save();

//     // Optional: Update the booking status to reflect cancellation
//     // $booking->status = 'cancelled';
//     // $booking->save();

//     return redirect()->route('user.index')->with('success', 'Reservation has been cancelled.');
// }


    


// public function payWithKhalti($roombook)
// {
//     $amount = $roombook->room->price;
//     $amount_paisa = $amount * 100;
//     $orderId = "{$roombook->id}";
//     $orderName = $roombook->room->name;
//     $customer = [
//         'name' => $roombook->name,
//         'email' => '',
//         'phone' => "{$roombook->phone}"
//     ];
//     $product_detail = [
//         "identity" => $roombook->room->id,
//         "name" => $orderName,
//         "total_price" => "$amount_paisa",
//         "quantity" => '1',
//     ];
//     $khalti_base_url = 'https://a.khalti.com/api/v2/';
//     $init_url = 'epayment/initiate/';

//     $response = Http::withHeaders([
//         'Accept' => 'application/json',
//         'Authorization' => 'key bce58b9ec7d1478f916e78c13f4660ec'
//     ])->post($khalti_base_url . $init_url, [
//         'return_url' => "http://localhost:8000/khalti/callback",
//         'website_url' => "http://localhost:8000",
//         'amount' => "$amount_paisa",
//         'purchase_order_id' => $orderId,
//         'purchase_order_name' => $orderName,
//         'customer_info' => $customer,
//         // 'product_details' =>  $product_detail,
//         // 'merchant_username' => '',
//         // 'merchant_extra' => ''
//     ]);
//     return ($response);
// }

// public function khaltiCallback(Request $request)
// {
//     // dd($request->all());
//     $roombook =RoomBook::findOrfail($request->purchase_order_id);
//     $roombook->status = 'success';
//     $roombook->update();
   
    
//     // Return response
//     return redirect()->route('bookview', ['id' => $roombook->id])->with('success', 'Payment and Booking successful!');


// }

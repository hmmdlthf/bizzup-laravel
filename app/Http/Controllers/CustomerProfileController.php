<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    public function profile($id)
    {
        // Retrieve the customer record from the database based on the ID
        $customer = Customer::findOrFail($id);

        // Return a view with the customer data
        return view('customer.profile', compact('customer'));
    }
}

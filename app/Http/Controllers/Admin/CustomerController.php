<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function add()
    {
        return view('admin.customer.create');
    }
    
    public function create(Request $request)
    {
        return redirect('admin/customer/create');
    }
    
    public function index(Request $request)
    {
        return view('admin.customer.index');
    }
    
    // 要修正
    public function show(Request $request)
    {
        return view('admin.customer.show');
    }
    
    public function edit(Request $request)
    {
        return view('admin.customer.edit');
    }
    
    public function update(Request $request)
    {
        return redirect('admin/customer');
    }
}

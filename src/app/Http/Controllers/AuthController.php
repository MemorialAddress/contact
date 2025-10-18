<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AuthController extends Controller
{
    public function admin()
    {
        $contacts = Contact::paginate(7);
        $categories = Category::all();
        return view('admin', ['contacts' => $contacts, 'categories' => $categories]);
    }
}

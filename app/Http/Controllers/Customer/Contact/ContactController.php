<?php

namespace App\Http\Controllers\Customer\Contact;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Communication;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function showContact()
    {
        $allcategoryparent1 = Category::where('category_status',1)->get();
        $allcategory1 = Category::where('category_status',1)->get();
        return view('customer.contact.show_contact')->with(compact('allcategory1','allcategoryparent1'));
    }
}

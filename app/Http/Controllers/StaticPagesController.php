<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Status;


class StaticPagesController extends Controller
{
    public function home(){
      
      $feed_items = [];
      if(Auth::check()){
        $feed_items = Auth::user()->feed()->paginate(10);
      }
      
      
      
      return view('static_pages.home', compact('feed_items'));
    }
}

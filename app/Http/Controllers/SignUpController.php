<?php

namespace App\Http\Controllers;

use App\Category;
use App\Visitor;
use Illuminate\Http\Request;
use Session;


class SignUpController extends Controller
{
    public function signUp()
    {
        $categories=Category::where('publication_status',1)->get();
        return view('front.user.sign-up',[
            'categories' => $categories
        ]);
    }
    public function newsignUp(Request $request) {
        Visitor::saveVisitorInfo($request);
        return redirect('/');
    }
    public function visitorLogout(Request $request)
    {
        Session::forget('visitorId');
        Session::forget('visitorName');

        return redirect('/');
    }
    public function visitorLogin()
    {
        $categories = Category::where('publication_status',1)->get();
        return view('front.user.sign-in',[
            'categories' => $categories
        ]);
    }
    public function visitorSignIn(Request $request) {
        $visitor = Visitor::where('email_address',$request->email_address)->first();

        if($visitor) {
            if (password_verify($request->password, $visitor->password)) {
                Session::put('visitorId',$visitor->id);
                Session::put('visitorName',$visitor->first_name.' '.$visitor->last_name);
                return redirect('/');
            } else {
                return redirect('/visitor-login')->with('message','Password not valid');
            }
        }
        else{
            return redirect('/visitor-login')->with('message','Email address invalid');
        }
//        return $request->all();
    }

    //This is row ajax.
//    public function emailCheck($email){
//       $visitor = Visitor::where('email_address',$email)->first();
//       if($visitor){
//           echo 'email address exist!!!';
//       }
//       else{
//           echo 'email address available!!!';
//       }
//    }

    public function emailCheck($email){
       $visitor = Visitor::where('email_address',$email)->first();
       if($visitor){
           return json_encode('email address exist!!!') ;
       }
       else{
           return json_encode('email address available!!!');
       }
    }
}

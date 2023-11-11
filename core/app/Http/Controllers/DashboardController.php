<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Currency;
use App\Member;
use App\Payment;
use App\PaymentMethod;
use App\Service;
use App\Signal;
use App\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\GeneralSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use DateTime;

class DashboardController extends Controller
{
    public function __construct()
    {
        $data = [];
        $this->middleware('auth:admin');
        $general_all = GeneralSetting::first();
        $this->site_title = $general_all->title;
        $this->gen_phone = $general_all->number;
        $this->gen_email = $general_all->email;

    }
    public function getDashboard()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Dashboard";
        $data['total_plan'] = Service::all()->count();
        $data['total_user'] = Member::all()->count();
        $data['total_signal'] = Signal::all()->count();
        $data['total_article'] = Article::all()->count();
        return view('dashboard.dashboard',$data);
    }

    public function createCurrency()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Create Currency";
        return view('dashboard.currency-create',$data);
    }
    public function storeCurrency(Request $request)
    {
    	
        $this->validate($request,[
            'name' => 'required|unique:currencies,name',
            'rate' => 'required'
        ]);
        try {
            $curr = Input::except('_method','_token');
            Currency::create($curr);
            session()->flash('message', 'Currency Create Successfully.');
            Session::flash('type', 'success');
            return redirect()->back();
        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }
    public function showCurrency()
    {
        $general = GeneralSetting::first();
        $data['site_title'] = $general->title;
        $data['page_title'] = "All Currency";
        $data['currency'] = Currency::orderBy('id','ASC')->paginate(100);
        return view('dashboard.currency-show',$data);
    }
    public function editCurrency($id)
    {
        $general = GeneralSetting::first();
        $data['site_title'] = $general->title;
        $data['page_title'] = "Edit Currency";
        $data['currency'] = Currency::findOrFail($id);
        return view('dashboard.currency-edit',$data);

    }
    public function updateCurrency(Request $request,$id)
    {
    	
        $curr = Currency::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|unique:currencies,name,'.$curr->id,
            'rate' =>'required'
        ]);
        try {
            $currency = Input::except('_method','_token');
            $curr->fill($currency)->save();
            session()->flash('message', 'Currency Updated Successfully.');
            Session::flash('type', 'success');
            return redirect()->back();
        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }
    public function deleteCurrency(Request $request)
    {
    	
        try {
            if ($request->input('id') === '') {
                session()->flash('message', 'Oops, bad request!');
                Session::flash('type', 'danger');
                return redirect()->back();
            }else{
                $currency = Currency::findOrFail($request->input('id'));
                $currency->delete();
                session()->flash('message', 'Currency Deleted Successfully.');
                Session::flash('type', 'success');
                return redirect()->back();
            }

        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }
    public function createService()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Create New Plan";
        $data['currency'] = Currency::all();
        return view('dashboard.service-create',$data);
    }
    public function storeService(Request $request)
    {
    	
        $this->validate($request,[
            'name' => 'required',
            'price' =>'required'
        ]);
        try {
            $service = Input::except('_token','_method');
            Service::create($service);
            session()->flash('message', 'Service Created Successfully.');
            Session::flash('type', 'success');
            return redirect()->back();

        } catch (\PDOException $e) {
            session()->flash('message', "Some Problem Occurs, Please Try Again!");
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }
    public function showService()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "All Plan";
        $data['service'] = Service::with('currency')->orderBy('id','DESC')->paginate(8);
        return view('dashboard.service-show',$data);
    }
    public function editService($id)
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Edit Plan";
        $data['service'] = Service::findOrFail($id);
        $data['currency'] = Currency::all();
        return view('dashboard.service-edit',$data);
    }
    public function updateService(Request $request,$id)
    {
    	
        $this->validate($request,[
            'name' => 'required',
            'price' =>'required'
        ]);
        $service = Service::findOrFail($id);
        try {
            $ser = Input::except('_token','_method');
            $service->fill($ser)->save();
            session()->flash('message', 'Service Updated Successfully.');
            Session::flash('type', 'success');
            return redirect()->back();

        } catch (\PDOException $e) {
            session()->flash('message', "Some Problem Occurs, Please Try Again!");
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }
    public function deleteService(Request $request)
    {
    	
        try {
            if ($request->input('id') === '') {
                session()->flash('message', 'Oops, bad request!');
                Session::flash('type', 'danger');
                return redirect()->back();
            }else{
                $service = Service::findOrFail($request->input('id'));
                $service->signals()->detach();
                $service->delete();
                session()->flash('message', 'Service Deleted Successfully.');
                Session::flash('type', 'success');
                return redirect()->back();
            }

        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }
    public function createSignal()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Create Service";
        $data['service'] = Service::all();
        return view('dashboard.signal-create',$data);
    }
    public function postSignal(Request $request)
    {
    	
        $this->validate($request,[
           'service_id' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);
        $signal = new Signal;
        $signal->title = $request->title;
        $signal->description = $request->description;
        $signal->created_date = date('Y-m-d');
        $signal->save();
        $signal->services()->sync($request->service_id, false);
        $general = new GeneralSetting;
        foreach ($request->service_id as $key => $value) {
            $member = Member::whereService_id($value)->wherePayment_status(1)->get();
            foreach ($member as $mem){
                $to = $mem->email;
                $subject = "$general->site_title"." "."Signal";
                $msg = "$request->description";
                $name = "$mem->fname"." "."$mem->lname";
                $email = "$general->email";

                $headers = "From: $name <$email> \r\n";
                $headers .= "Reply-To: $name <$email> \r\n";
                $headers .='X-Mailer: PHP/' . phpversion();
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

                $message = "
                    <html>
                    <head>
                    <title>$request->title</title>
                    </head>
                    <body>
                    <p>$msg</p>
                    </body>
                    </html>
                    ";
                if (mail($to, $subject, $message, $headers)) {
                    $success = 'hasan';
                } else {
                    $success = 'hosen';

                }
            }

        }
        if($success == 'hasan'){
            session()->flash('message', 'Signal Send Successfully.');
            Session::flash('type', 'success');
            return redirect()->back();
        }else{
            session()->flash('message', 'Signal Not Send Properly.');
            Session::flash('type', 'warning');
            return redirect()->back();
        }

    }
    public function dateSignal()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Signal Date";
        $data['signal'] = Signal::groupBy('created_date')
            ->orderBy('id','DESC')
            ->paginate(6);
        return view('dashboard.signal-date',$data);
    }
    public function showSignal($date)
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Signal Show";
        $data['signal'] = Signal::where('created_at','LIKE','%'.$date.'%')->paginate(8);
        return view('dashboard.signal-show',$data);
    }
    public function showCategory()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "All Category";
        $data['category'] = Category::orderBy('id','DESC')->paginate(10);
        return view('dashboard.category-show',$data);
    }
    public function editCategory($task_id)
    {
        $category = Category::find($task_id);
        return Response::json($category);
    }
    public function storeCategory(Request $request)
    {
    	
        $rules = array(
            'name' => 'required|unique:categories,name',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $category = Category::create($request->all());
            return Response::json($category);
        }
    }
    public function updateCategory(Request $request,$task_id)
    {
    	
        $cat = Category::find($task_id);
        $rules = array(
            'name' => 'required|unique:categories,name,'.$cat->id,
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $cat->name = $request->name;
            $cat->save();
            return Response::json($cat);
        }
    }
    public function deleteCategory($id)
    {
        $task = Category::destroy($id);
        return Response::json($task);
    }
    public function createArticle()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Create Article";
        $data['category'] = Category::all();
        return view('dashboard.article-create',$data);
    }
    public function storeArticle(Request $request)
    {
    	
        $this->validate($request,[
           'category_id' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);
        Article::create($request->all());
        session()->flash('message', 'Article Created Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function showArticle()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Show Article";
        $data['article'] = Article::with('category')->orderBy('id','DESC')->paginate(10);
        return view('dashboard.article-show',$data);
    }
    public function editArticle($id)
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Edit Article";
        $data['article'] = Article::findOrFail($id);
        $data['category'] = Category::all();
        return view('dashboard.article-edit',$data);
    }
    public function updateArticle(Request $request,$id)
    {
    	
        $this->validate($request,[
           'category_id' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);
        $ar = Article::findOrFail($id);
        $ar->fill($request->all())->save();
        session()->flash('message', 'Article Updated Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function deleteArticle(Request $request)
    {
    	
        try {
            if ($request->input('id') === '') {
                session()->flash('message', 'Oops, bad request!');
                Session::flash('type', 'danger');
                return redirect()->back();
            }else{
                Article::destroy($request->input('id'));
                session()->flash('message', 'Article Deleted Successfully.');
                Session::flash('type', 'success');
                return redirect()->route('article-show');
            }

        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }
    public function viewArticle($id)
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "View Article";
        $data['article'] = Article::findOrFail($id);
        return view('dashboard.article-view',$data);
    }
    public function mangeTestimonial()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Mange Testimonial";
        $data['test'] = Testimonial::all();
        return view('dashboard.testimonial-manage',$data);
    }
    public function storeTestimonial(Request $request)
    {
    	
        $this->validate($request,[
           'name' => 'required',
            'description' => 'required'
        ]);
        Testimonial::create($request->all());
        session()->flash('message', 'Testimonial Created Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function editTestimonial($id)
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Mange Testimonial";
        $data['testimonial'] = Testimonial::findOrFail($id);
        $data['test'] = Testimonial::all();
        return view('dashboard.testimonial-edit',$data);
    }
    public function updateTestimonial(Request $request,$id)
    {
    	
        $this->validate($request,[
           'name' => 'required',
            'description' => 'required'
        ]);
        $test = Testimonial::findOrFail($id);
        $test->fill($request->all())->save();
        session()->flash('message', 'Testimonial Updated Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function deleteTestimonial(Request $request)
    {
    	
        try {
            if ($request->input('id') === '') {
                session()->flash('message', 'Oops, bad request!');
                Session::flash('type', 'danger');
                return redirect()->back();
            }else{
                Testimonial::destroy($request->input('id'));
                session()->flash('message', 'Testimonial Deleted Successfully.');
                Session::flash('type', 'success');
                return redirect()->back();
            }

        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }
    public function manageMember()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "All Member";
        $data['member'] = Member::orderBy('id','desc')->paginate(1000);
        return view('dashboard.member-view',$data);
    }
    public function userMessage(Request $request)
    {
    	

        try {
            if ($request->input('id') === '') {
                session()->flash('message', 'Oops, bad request!');
                Session::flash('type', 'danger');
                return redirect()->back();
            }else{
                $general = GeneralSetting::first();
                $member = Member::find($request->input('id'));

                $to = $member->email;
                $subject = $request->subject;
                $msg = $request->message;
                $name = $member->username;
                $email = $general->email;

                $headers = "From: $name <$email> \r\n";
                $headers .= "Reply-To: $name <$email> \r\n";
                $headers .='X-Mailer: PHP/' . phpversion();
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

                $message = "
                    <html>
                    <head>
                    <title>Admin Message</title>
                    </head>
                    <body>
                    <p>$msg</p>
                    </body>
                    </html>
                    ";

                if (mail($to, $subject, $message, $headers)) {
                    session()->flash('message', 'Message Send Successfully.');
                    Session::flash('type', 'success');
                    return redirect()->back();
                } else {
                    session()->flash('message', 'Message Not Send.');
                    Session::flash('type', 'warning');
                    return redirect()->back();
                }
            }

        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }
    public function upcomingPayment()
    {
    	
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Upcoming Payment";
        $data['payment'] = Payment::whereStatus(1)->paginate(10000);
        $pay = $data['payment'];
        foreach ($pay as $p){
            $startTime = Carbon::now();
            $finishTime = Carbon::parse($p->expiry_date);
            $totalDuration = $finishTime->diffInDays($startTime);

            if ($totalDuration <= 3) {
                $member = Member::whereId($p->member_id)->first();
                $general = GeneralSetting::first();
                $to = $member->email;
                $subject = 'Your Subscription Date Expire So Soon';
                $msg = 'Your Subscription Date Expired So Soon. Please Payment So Fast.';
                $name = $member->username;
                $email = $general->email;

                $headers = "From: $name <$email> \r\n";
                $headers .= "Reply-To: $name <$email> \r\n";
                $headers .='X-Mailer: PHP/' . phpversion();
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

                $message = "
                    <html>
                    <head>
                    <title>Admin Message</title>
                    </head>
                    <body>
                    <p>$msg</p>
                    </body>
                    </html>
                    ";

                if (mail($to, $subject, $message, $headers)) {

                } else {

                }
            }
            if($totalDuration <= 0){
                $member = Member::whereId($p->member_id)->first();
                $member->payment_status = 0 ;
                $member->save();
                $pay = Payment::findOrFail($p->id);
                $pay->status = 0;
                $pay->save();
                $general = GeneralSetting::first();
                $to = $member->email;
                $subject = 'Your Subscription Date Expire';
                $msg = 'Your Subscription Date Expired. Please Payment So Fast.';
                $name = $member->username;
                $email = $general->email;

                $headers = "From: $name <$email> \r\n";
                $headers .= "Reply-To: $name <$email> \r\n";
                $headers .='X-Mailer: PHP/' . phpversion();
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

                $message = "
                    <html>
                    <head>
                    <title>Admin Message</title>
                    </head>
                    <body>
                    <p>$msg</p>
                    </body>
                    </html>
                    ";

                if (mail($to, $subject, $message, $headers)) {

                } else {

                }
            }
        }
        return view('dashboard.upcoming-payment',$data);
    }

    public function getPaymentMethod()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Payment Method";
        $data['paypal'] = PaymentMethod::whereId(1)->first();
        $data['perfect'] = PaymentMethod::whereId(2)->first();
        $data['btc'] = PaymentMethod::whereId(3)->first();
        $data['stripe'] = PaymentMethod::whereId(4)->first();
        $data['basic'] = ['currency' => 'ngn','symbol' => 'hh'];
        $data['basic'] = GeneralSetting::first();
        return view('dashboard.payment-method',$data);
    }
    public function updatePaymentMethod(Request $request)
    {
        
        $this->validate($request,[
           'paypal_name' => 'required',
            'paypal_image' => 'mimes:png,jpeg,jpg',
            'paypal_email' => 'required',
            'perfect_name' => 'required',
            'perfect_image' => 'mimes:png,jpeg,jpg',
            'perfect_account' => 'required',
            'perfect_alternate' => 'required',
            'btc_name' => 'required',
            'btc_image' => 'mimes:png,jpeg,jpg',
            'btc_api' => 'required',
            'btc_xpub' => 'required',
            'stripe_name' => 'required',
            'stripe_image' => 'mimes:png,jpeg,jpg',
            'stripe_secret' => 'required',
            'stripe_publishable' => 'required',
        ]);

        $paypal = PaymentMethod::whereId(1)->first();
        $perfect = PaymentMethod::whereId(2)->first();
        $btc = PaymentMethod::whereId(3)->first();
        $stripe = PaymentMethod::whereId(4)->first();

        $paypal->name = $request->paypal_name;
        $paypal->val1 = $request->paypal_email;
        $paypal->status = $request->paypal_status == 'on' ? '1' : '0';
        if($request->hasFile('paypal_image')){
            $image3 = $request->file('paypal_image');
            $filename3 = time().'h3'.'.'.$image3->getClientOriginalExtension();
            $location = 'images/' . $filename3;
            Image::make($image3)->resize(400,400)->save($location);
            $paypal->image = $filename3;
        }

        $perfect->name = $request->perfect_name;
        $perfect->val1 = $request->perfect_account;
        $perfect->val2 = $request->perfect_alternate;
        $perfect->status = $request->perfect_status == 'on' ? '1' : '0';
        if($request->hasFile('perfect_image')){
            $image3 = $request->file('perfect_image');
            $filename3 = time().'h4'.'.'.$image3->getClientOriginalExtension();
            $location = 'images/' . $filename3;
            Image::make($image3)->resize(400,400)->save($location);
            $perfect->image = $filename3;
        }

        $btc->name = $request->btc_name;
        $btc->val1 = $request->btc_api;
        $btc->val2 = $request->btc_xpub;
        $btc->status = $request->btc_status == 'on' ? '1' : '0';
        if($request->hasFile('btc_image')){
            $image3 = $request->file('btc_image');
            $filename3 = time().'h5'.'.'.$image3->getClientOriginalExtension();
            $location = 'images/' . $filename3;
            Image::make($image3)->resize(400,400)->save($location);
            $btc->image = $filename3;
        }

        $stripe->name = $request->stripe_name;
        $stripe->val1 = $request->stripe_secret;
        $stripe->val2 = $request->stripe_publishable;
        $stripe->status = $request->stripe_status == 'on' ? '1' : '0';
        if($request->hasFile('stripe_image')){
            $image3 = $request->file('stripe_image');
            $filename3 = time().'h6'.'.'.$image3->getClientOriginalExtension();
            $location = 'images/' . $filename3;
            Image::make($image3)->resize(400,400)->save($location);
            $stripe->image = $filename3;
        }

        $paypal->save();
        $perfect->save();
        $btc->save();
        $stripe->save();

        session()->flash('message', 'Payment Method Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();

    }







}

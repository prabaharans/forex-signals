<?php

namespace App\Http\Controllers;

use App\Article;
use App\GeneralSetting;
use App\Member;
use App\Menu;
use App\PasswordSubmit;
use App\Payment;
use App\PaymentLog;
use App\PaymentMethod;
use App\Service;
use App\Signal;
use App\Slider;
use App\Testimonial;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;

class HomeController extends Controller
{
    public function __construct()
    {
        $data = [];
        $general_all = GeneralSetting::first();
        $this->site_title = $general_all->title;
        $this->site_email = $general_all->email;
        $this->site_color = $general_all->color;
        $this->footer_text = $general_all->footer_text;
        $this->top_text = $general_all->top_text;
        $this->paypal_email = $general_all->paypal_email;
        $this->footer_bottom_text = $general_all->footer_bottom_text;
    }
    public function getHome()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = 'Home Page';
        $data['site_color'] = $this->site_color;
        $data['footer_text'] = $this->footer_text;
        $data['footer_bottom_text'] = $this->footer_bottom_text;
        $data['top_text'] = $this->top_text;
        $data['menu'] = Menu::all();
        $data['slider'] = Slider::all();
        $data['total_signal'] = Signal::all()->count();
        $data['total_user'] = Member::all()->count();
        $data['total_article'] = Article::all()->count();
        $data['total_package'] = Service::all()->count();
        $data['package'] = Service::orderBy('id','ASC')->get();
        $data['test'] = Testimonial::inRandomOrder()->take(6)->get();
        return view('home.home',$data);
    }
    public function menu($id)
    {
        $menu = Menu::findOrFail($id);
        $data['site_title'] = $this->site_title;
        $data['page_title'] = 'Menu';
        $data['site_color'] = $this->site_color;
        $data['footer_text'] = $this->footer_text;
        $data['footer_bottom_text'] = $this->footer_bottom_text;
        $data['top_text'] = $this->top_text;
        $data['menu_name'] = $menu->name;
        $data['menu_description'] = $menu->description;
        $data['menu'] = Menu::all();
        return view('home.menu',$data);
    }
    public function getLogIn()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = 'User Log In';
        $data['site_color'] = $this->site_color;
        $data['footer_text'] = $this->footer_text;
        $data['footer_bottom_text'] = $this->footer_bottom_text;
        $data['top_text'] = $this->top_text;
        $data['menu'] = Menu::all();
        return view('home.login',$data);
    }
    public function getForgetPassword()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = 'User Reset Password';
        $data['site_color'] = $this->site_color;
        $data['footer_text'] = $this->footer_text;
        $data['footer_bottom_text'] = $this->footer_bottom_text;
        $data['top_text'] = $this->top_text;
        $data['menu'] = Menu::all();
        return view('home.forget-password',$data);
    }
    public function submitForgetPassword(Request $request)
    {
        
        
        $email = $request->email;
        $ur = Member::whereEmail($email)->count();
        $user = Member::whereEmail($email)->first();
        if ($ur == 1){
            $data['token'] = Str::random(60);
            $data['email'] = $email;
            $data['status'] = 0;
            $rr = PasswordSubmit::create($data);
            $url = route('user-password-reset',$rr->token);

            $general = GeneralSetting::first();
            $mail_val = [
                'email' => $user->email,
                'name' => $user->lname.' '.$user->fname,
                'g_email' => $general->email,
                'g_title' => $general->title,
                'subject' => 'Password Reset Email',
            ];
            Config::set('mail.driver','mail');
            Config::set('mail.from',$general->email);
            Config::set('mail.name',$general->title);

            Mail::send('auth.reset-email', ['name' => $user->lname.' '.$user->fname,'link'=>$url,'footer'=>$general->footer_bottom_text], function ($m) use ($mail_val) {
                $m->from($mail_val['g_email'], $mail_val['g_title']);
                $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
            });

            session()->flash('message', 'Check Your Email.Reset link Successfully send.');
            Session::flash('type', 'success');
            return redirect()->back();

        }else{
            session()->flash('message', 'Email Not Match our Recorded.');
            Session::flash('type', 'warning');
            return redirect()->back();
        }
    }
    public function resetForgetPassword($token)
    {
        
        
        $pw = PasswordSubmit::whereToken($token)->first();
        $data['site_title'] = $this->site_title;
        $data['page_title'] = 'User Reset Password';
        $data['site_color'] = $this->site_color;
        $data['footer_text'] = $this->footer_text;
        $data['footer_bottom_text'] = $this->footer_bottom_text;
        $data['top_text'] = $this->top_text;
        $data['menu'] = Menu::all();
        $data['token'] = $pw->token;
        return view('home.reset-password-form',$data);
    }
    public function ResetSubmitPassword(Request $request)
    {
        
        $this->validate($request,[
           'email' => 'email|required',
            'token' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
        $pw = PasswordSubmit::whereEmail($request->email)->whereToken($request->token)->count();
        $pw1 = PasswordSubmit::whereEmail($request->email)->whereToken($request->token)->first();
        if ($pw == 1){

            $user = Member::whereEmail($pw1->email)->first();
            $password = Hash::make($request->password);
            $user->password = $password;
            $user->save();
            PasswordSubmit::whereEmail($pw1->email)->delete();
            session()->flash('message', 'Password Reset Successfully.');
            Session::flash('type', 'success');
            return redirect()->route('user-login');
        }else{
            session()->flash('message', 'Something Is Error.');
            Session::flash('type', 'success');
            return redirect()->back();
        }
    }
    public function getRegistration()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = 'User Registration';
        $data['site_color'] = $this->site_color;
        $data['footer_text'] = $this->footer_text;
        $data['footer_bottom_text'] = $this->footer_bottom_text;
        $data['menu'] = Menu::all();
        $data['plan'] = Service::all();
        return view('home.registration',$data);
    }
    public function postRegistration(Request $request)
    {
        $this->validate($request,[
           'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|unique:members,email',
            'username' => 'required|unique:members,username',
            'password' => 'required|confirmed',
            'service_id' => 'required',
            'phone' => 'required|numeric'
        ]);
        $member = Input::except('_method','_token');
        $member['password'] = Hash::make($request->password);
        $member['code'] = strtoupper(rand(100,999).uniqid().rand(100,999));
        $mem = Member::create($member);
        session()->flash('message', 'Member Created Successfully.');
        Session::flash('type', 'success');
        return redirect()->route('payment-invoice',$mem->id);
    }
    public function paymentInvoice($id)
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = 'User Payment Invoice';
        $data['site_color'] = $this->site_color;
        $data['footer_text'] = $this->footer_text;
        $data['footer_bottom_text'] = $this->footer_bottom_text;
        $data['paypal_email'] = $this->paypal_email;
        $data['menu'] = Menu::all();
        $data['plan'] = Service::all();
        $data['member'] = Member::findOrFail($id);
        $data['paypal'] = PaymentMethod::whereId(1)->first();
        $data['perfect'] = PaymentMethod::whereId(2)->first();
        $data['btc'] = PaymentMethod::whereId(3)->first();
        $data['stripe'] = PaymentMethod::whereId(4)->first();
        $pp = PaymentLog::whereMember_id($id)->count();

        if ($pp == 0){
            $p['member_id'] = $id;
            $p['custom'] = Str::random(40);
            $p['amount'] = $data['member']->service->price;
            $data['log'] = PaymentLog::create($p);
        }else{
            $data['log'] = PaymentLog::whereMember_id($id)->first();
        }


        return view('home.payment-invoice',$data);
    }
    public function paypalIpn()
    {

        $payment_type		=	$_POST['payment_type'];
        $payment_date		=	$_POST['payment_date'];
        $payment_status		=	$_POST['payment_status'];
        $address_status		=	$_POST['address_status'];
        $payer_status		=	$_POST['payer_status'];
        $first_name			=	$_POST['first_name'];
        $last_name			=	$_POST['last_name'];
        $payer_email		=	$_POST['payer_email'];
        $payer_id			=	$_POST['payer_id'];
        $address_country	=	$_POST['address_country'];
        $address_country_code	=	$_POST['address_country_code'];
        $address_zip		=	$_POST['address_zip'];
        $address_state		=	$_POST['address_state'];
        $address_city		=	$_POST['address_city'];
        $address_street		=	$_POST['address_street'];
        $business			=	$_POST['business'];
        $receiver_email		=	$_POST['receiver_email'];
        $receiver_id		=	$_POST['receiver_id'];
        $residence_country	=	$_POST['residence_country'];
        $item_name			=	$_POST['item_name'];
        $item_number		=	$_POST['item_number'];
        $quantity			=	$_POST['quantity'];
        $shipping			=	$_POST['shipping'];
        $tax				=	$_POST['tax'];
        $mc_currency		=	$_POST['mc_currency'];
        $mc_fee				=	$_POST['mc_fee'];
        $mc_gross			=	$_POST['mc_gross'];
        $mc_gross_1			=	$_POST['mc_gross_1'];
        $txn_id				=	$_POST['txn_id'];
        $notify_version		=	$_POST['notify_version'];
        $custom				=	$_POST['custom'];

        $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);

        $paypal = PaymentMethod::whereId(1)->first();

        $paypal_email = $paypal->val1;

        if($payer_status=="verified" && $payment_status=="Completed" && $receiver_email==$paypal_email && $ip=="notify.paypal.com"){

            $data = PaymentLog::where('custom' , $custom)->first();
            $totalamo = $data->amount;

            if($totalamo == $mc_gross)
            {
                $mem = Member::findOrFail($data->member_id);
                $mem->payment_status = 1;
                $pay = new Payment;
                $pay->member_id = $data->member_id;
                $pay->start_date = Carbon::today();
                $pay->expiry_date = Carbon::today()->addMonths(1);
                $pay->status = 1;
                $pay->save();
                $mem->save();
            }
        }

    }
    public function perfectIPN()
    {
        $pay = PaymentMethod::whereId(2)->first();
        $passphrase=strtoupper(md5($pay->val2));

        define('ALTERNATE_PHRASE_HASH',  $passphrase);
        define('PATH_TO_LOG',  '/somewhere/out/of/document_root/');
        $string=
            $_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
            $_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
            $_POST['PAYMENT_BATCH_NUM'].':'.
            $_POST['PAYER_ACCOUNT'].':'.ALTERNATE_PHRASE_HASH.':'.
            $_POST['TIMESTAMPGMT'];

        $hash=strtoupper(md5($string));
        $hash2 = $_POST['V2_HASH'];

        if($hash==$hash2){

            $amo = $_POST['PAYMENT_AMOUNT'];
            $unit = $_POST['PAYMENT_UNITS'];
            $custom = $_POST['PAYMENT_ID'];


            $data = PaymentLog::where('custom' , $custom)->first();

            if($_POST['PAYEE_ACCOUNT']=="$pay->val1" && $unit=="USD" && $amo == $data->amount){
                $mem = Member::findOrFail($data->member_id);
                $mem->payment_status = 1;
                $pay = new Payment;
                $pay->member_id = $data->member_id;
                $pay->start_date = Carbon::today();
                $pay->expiry_date = Carbon::today()->addMonths(1);
                $pay->status = 1;
                $pay->save();
                $mem->save();
            }else{
                session()->flash('message', 'Something error....');
                Session::flash('type', 'warning');
                return redirect()->back();
            }

        }
    }
    public function stripePreview(Request $request)
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = 'Card Fund Preview';
        $data['site_color'] = $this->site_color;
        $data['footer_text'] = $this->footer_text;
        $data['footer_bottom_text'] = $this->footer_bottom_text;
        $data['menu'] = Menu::all();
        $data['general'] = GeneralSetting::first();
        $data['amount'] = $request->amount;
        $data['custom'] = $request->custom;
        $data['url'] = $request->url;
        $data['member'] = Member::findOrFail($request->member_id);
        return view('home.stripe-preview',$data);
    }
    public function submitStripe(Request $request)
    {
        $this->validate($request,[
            'amount' => 'required',
            'custom' => 'required',
            'cardNumber' => 'required|numeric',
            'cardExpiryMonth' => 'required|numeric',
            'cardExpiryYear' => 'required|numeric',
            'cardCVC' => 'required|numeric',
        ]);
        $data = PaymentLog::whereCustom($request->custom)->first();
        $amm = $request->amount;
        $cc = $request->cardNumber;
        $emo = $request->cardExpiryMonth;
        $eyr = $request->cardExpiryYear;
        $cvc = $request->cardCVC;
        $basic = PaymentMethod::whereId(4)->first();
        Stripe::setApiKey($basic->val1);
        try{
            $token = Token::create(array(
                "card" => array(
                    "number" => "$cc",
                    "exp_month" => $emo,
                    "exp_year" => $eyr,
                    "cvc" => "$cvc"
                )
            ));
            if (!isset($token['id'])) {
                session()->flash('message','The Stripe Token was not generated correctly');
                return Redirect::to($request->url);
            }

            $charge = Charge::create(array(
                'card' => $token['id'],
                'currency' => 'USD',
                'amount' => round($request->amount) * 100,
                'description' => 'item',
            ));

            if ($charge['status'] == 'succeeded' and $charge['amount'] == ($data->amount * 100) ) {

                $mem = Member::findOrFail($data->member_id);
                $mem->payment_status = 1;
                $pay = new Payment;
                $pay->member_id = $data->member_id;
                $pay->start_date = Carbon::today();
                $pay->expiry_date = Carbon::today()->addMonths(1);
                $pay->status = 1;
                $pay->save();
                $mem->save();
                session()->flash('message','Card Successfully Charged.');
                session()->flash('title','Success');
                session()->flash('type','success');
                return redirect()->route('user-login');
            }else{
                session()->flash('message','Something Is Wrong.');
                session()->flash('title','Opps..');
                session()->flash('type','warning');
                return Redirect::to($request->url);
            }

        }catch (Exception $e){
            session()->flash('message',$e->getMessage());
            session()->flash('title','Opps..');
            session()->flash('type','warning');
            return redirect()->route('add-fund');
        }
    }
    public function btcPreview(Request $request)
    {
        $data['amount'] = $request->amount;
        $data['custom'] = $request->custom;
        $data['url'] = $request->url;
        $pay = PaymentMethod::whereId(3)->first();
        $tran = PaymentLog::whereCustom($data['custom'])->first();

        $blockchain_root = "https://blockchain.info/";
        $blockchain_receive_root = "https://api.blockchain.info/";
        $mysite_root = url('/');
        $secret = "ABIR";
        $my_xpub = $pay->val2;
        $my_api_key = $pay->val1;

        $invoice_id = $tran->custom;


        $callback_url = route('btc_ipn',['invoice_id'=>$invoice_id,'secret'=>$secret]);

        if ($tran->btc_acc == null){
            if (file_exists($blockchain_receive_root . "v2/receive?key=" . $my_api_key . '&callback=' . urlencode($callback_url) . '&xpub=' . $my_xpub)) {
                $resp = file_get_contents($blockchain_receive_root . "v2/receive?key=" . $my_api_key . '&callback=' . urlencode($callback_url) . '&xpub=' . $my_xpub);
    
                $response = json_decode($resp);
        
                $sendto = $response->address;
        
                $api = "https://blockchain.info/tobtc?currency=USD&value=".$data['amount'];
        
                $usd = file_get_contents($api);
        
                $tran->btc_amo = $usd;
                $tran->btc_acc = $sendto;
                $tran->save();
            }else{
                session()->flash('message', 'BlockChain Something Error.');
                Session::flash('type', 'warning');
                return redirect()->back();
            }

    
        }else{
            $usd = $tran->btc_amo;
            $sendto = $tran->btc_acc;
        }

        $var = "bitcoin:$sendto?amount=$usd";
        $data['code'] =  "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$var&choe=UTF-8\" title='' style='width:300px;' />";

        $data['general'] = GeneralSetting::first();

        $data['site_title'] = $this->site_title;
        $data['page_title'] = 'BTC - Blockchain Preview';
        $data['site_color'] = $this->site_color;
        $data['footer_text'] = $this->footer_text;
        $data['footer_bottom_text'] = $this->footer_bottom_text;
        $data['menu'] = Menu::all();
        $data['general'] = GeneralSetting::first();
        $data['amount'] = $request->amount;
        $data['custom'] = $request->custom;
        $data['url'] = $request->url;
        $data['member'] = Member::findOrFail($request->member_id);
        $data['btc'] = $usd;
        $data['add'] = $sendto;
        return view('home.btc-preview',$data);
    }
    public function btcIPN(){
        $depoistTrack = $_GET['invoice_id'];
        $secret = $_GET['secret'];
        $address = $_GET['address'];
        $value = $_GET['value'];
        $confirmations = $_GET['confirmations'];
        $value_in_btc = $_GET['value'] / 100000000;

        $trx_hash = $_GET['transaction_hash'];

        $DepositData = PaymentLog::whereCustom($depoistTrack)->first();

        if ($DepositData->btc_amo == $value_in_btc && $DepositData->btc_acc == $address && $secret=="ABIR" && $confirmations>2){

            $mem = Member::findOrFail($DepositData->member_id);
            $mem->payment_status = 1;
            $pay = new Payment;
            $pay->member_id = $DepositData->member_id;
            $pay->start_date = Carbon::today();
            $pay->expiry_date = Carbon::today()->addMonths(1);
            $pay->status = 1;
            $pay->save();
            $mem->save();

        }
    }


    public function getContact()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = 'Contact Us';
        $data['site_color'] = $this->site_color;
        $data['footer_text'] = $this->footer_text;
        $data['footer_bottom_text'] = $this->footer_bottom_text;
        $data['menu'] = Menu::all();
        $data['general'] = GeneralSetting::first();
        return view('home.contact-us',$data);
    }
    public function postContact(Request $request)
    {
    	
        $to = $this->site_email;
        $subject = "Contact Message ";
        $msg = "$request->message";
        $name = "$request->name";
        $email = $request->email;

        $headers = "From: $name <$email> \r\n";
        $headers .= "Reply-To: $name <$email> \r\n";
        $headers .='X-Mailer: PHP/' . phpversion();
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        $message = "
                    <html>
                    <head>
                    <title>Contact Message</title>
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
            session()->flash('message', 'Message Not Successfully.');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }




}

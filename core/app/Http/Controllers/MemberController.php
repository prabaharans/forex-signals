<?php

namespace App\Http\Controllers;

use App\Article;
use App\GeneralSetting;
use App\Member;
use App\Service;
use App\Signal;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    public function __construct()
    {
        $data = [];
        $this->middleware('auth:member');
        $general_all = GeneralSetting::first();
        $this->site_title = $general_all->title;
        $this->gen_phone = $general_all->number;
        $this->gen_email = $general_all->email;
    }
    public function getDashboard()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Member Dashboard";
        $data['total_signal'] = Signal::all()->count();
        $data['total_user'] = Member::all()->count();
        $data['total_article'] = Article::all()->count();
        $data['total_plan'] = Service::all()->count();
        $data['plan'] = Service::findOrFail(Auth::guard('member')->user()->service_id);
        return view('member.dashboard',$data);
    }
    public function changePassword()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Member Password Change";
        return view('member.change-pass',$data);
    }
    public function postPassword(Request $request)
    {
    	
        $this->validate($request, [
            'current_password' =>'required',
            'password' => 'required|min:5|confirmed'
        ]);

        try {
            $c_password = Auth::guard('member')->user()->password;
            $c_id = Auth::guard('member')->user()->id;

            $user = Member::findOrFail($c_id);

            if(Hash::check($request->current_password, $c_password)){

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                session()->flash('message', 'Password Changes Successfully.');
                Session::flash('type', 'success');
                return redirect()->back();
            }else{
                session()->flash('message', 'Password Not Match.');
                Session::flash('type', 'warning');
                return redirect()->back();
            }

        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }
    public function getMemberSignalDate()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Member Forex Signal";
        $member_service_id = Auth::guard('member')->user()->service_id;
        $se = Service::find($member_service_id);
        $data['signal'] = $se->signals()->orderBy('id','DESC')->paginate(6);
        return view('member.signal-show',$data);
    }
    public function showSignal($id)
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Member Forex Signal";
        $data['signal'] = Signal::findOrFail($id);
        return view('member.signal-view',$data);
    }
    public function getArticle()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Forex Article";
        $data['article'] = Article::orderBy('id','DESC')->paginate(10000);
        return view('member.article-show',$data);
    }
    public function viewArticle($id)
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Forex Article";
        $data['article'] = Article::findOrFail($id);
        return view('member.article-view',$data);
    }



}

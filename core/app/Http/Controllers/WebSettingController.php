<?php

namespace App\Http\Controllers;

use App\Aboutus;
use App\GeneralSetting;
use App\Home;
use App\HomeTop;
use App\Menu;
use App\Offer;
use App\Service;
use App\Slider;
use App\Sponsor;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Support\Facades\Input;
use Image;
use Auth;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class WebSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $data = [];
        $general_all = GeneralSetting::first();
        $this->site_title = $general_all->title;
        $this->site_color = $general_all->color;
        $this->footer_text = $general_all->footer_text;
    }
    public function getChangePass()
    {
        $data['page_title'] = "Change Password";
        $general_all = GeneralSetting::first();
        $data['site_title'] = $general_all->title;
        return view('auth.change-pass',$data);
    }
    public function postChangePass(Request $request)
    {
    	
        $this->validate($request, [
            'current_password' =>'required',
            'password' => 'required|min:5|confirmed'
        ]);

        try {
            $c_password = Auth::guard('admin')->user()->password;
            $c_id = Auth::guard('admin')->user()->id;

            $user = Admin::findOrFail($c_id);

            if(Hash::check($request->current_password, $c_password)){

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                session()->flash('message', 'Password Changes Successfully.');
                Session::flash('type', 'success');
                return redirect()->back();
            }else{
                session()->flash('message', 'Password Not Match');
                Session::flash('type', 'danger');
                return redirect()->back();
            }

        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }

    }
    public function getGeneralSetting()
    {
        $data['page_title'] = "General Setting";
        $general_all = GeneralSetting::first();
        $data['site_title'] = $general_all->title;
        $data['general'] = $general_all;
        return view('websetting.general_setting',$data);
    }
    public function putGeneralSetting(Request $request, $id)
    {
        

        $this->validate($request,[
           'title' => 'required',
            'images' => 'mimes:png',
            'images1' => 'mimes:png',
        ]);
        try {
            $generals = GeneralSetting::find($id);
            $general = Input::except('_method', '_token');
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = "logo".'.'.$image->getClientOriginalExtension();
                $location = 'images/' . $filename;
                Image::make($image)->save($location);
                $general['logo'] = $filename;
            }
            if($request->hasFile('image1')){
                $image = $request->file('image1');
                $filename = "favicon".'.'.$image->getClientOriginalExtension();
                $location = 'images/' . $filename;
                Image::make($image)->resize(60,60)->save($location);
                $general['favicon'] = $filename;
            }

            $generals->fill($general)->save();
            session()->flash('message', 'General Setting Updated Successfully.');
            Session::flash('type', 'success');
            return redirect()->back();
        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }

    }
    public function getSlider()
    {
        $general_all = GeneralSetting::first();
        $data['site_title'] = $general_all->title;
        $data['page_title'] = "Manage Slider";
        $data['slider'] = Slider::all();
        return view('websetting.slider',$data);
    }
    public function postSlider(Request $request)
    {
    	
        $this->validate($request,[
            'text' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'images/' . $filename;
            Image::make($image)->resize(1920,750)->save($location);
            $slider = Input::except('_method', '_token');
            $slider['image'] = $filename;
            try {
                Slider::create($slider);
                session::flash('message', 'Slider Added Successfully.');
                Session::flash('type', 'success');
                return redirect()->back();

            } catch (\PDOException $e) {
                session::flash('message', 'Some Problem Occure, Please Try Again!');
                Session::flash('type', 'danger');
                return redirect()->back();
            }
        }
    }
    public function deleteSlider(Request $request)
    {
    	

        try {
            if ($request->input('id') === '') {
                session()->flash('message', 'Oops, bad request!');
                Session::flash('type', 'danger');
                return redirect()->back();
            }else{

                $slider = Slider::findOrFail($request->input('id'));
                $slider->delete();
                Storage::delete($slider->image);
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
    public function getMenuCreate()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Create Menu Setting";
        return view('websetting.menu-create',$data);
    }
    public function postMenuCreate(Request $request)
    {
    	
        $this->validate($request,[
            'name' => 'required|unique:menus,name',
            'description' => 'required'
        ]);
        try {
            $menu = Input::except('_method','_token');
            Menu::create($menu);
            session()->flash('message', 'Menu Create Successfully.');
            Session::flash('type', 'success');
            return redirect()->back();
        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }
    public function showMenuCreate()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Show All Menu";
        $data['menu'] = Menu::all();
        return view('websetting.menu-show',$data);
    }
    public function editMenuCreate($id)
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Edit Menu";
        $data['menu'] = Menu::findorFail($id);
        return view('websetting.menu-edit',$data);
    }
    public function updateMenuCreate(Request $request,$id)
    {
    	
        $menus = Menu::findOrFail($id);
        $this->validate($request,[
            'name' =>'required|unique:menus,name,'.$menus->id,
            'description' => 'required'
        ]);
        try {
            $menu = Input::except('_method','_token');
            $menus->fill($menu)->save();
            session()->flash('message', 'Menu Updated Successfully.');
            Session::flash('type', 'success');
            return redirect()->back();
        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }
    public function deleteMenuCreate($id)
    {
    	
        try {
            $menu = Menu::findOrFail($id);
            $menu->delete();
            session()->flash('message', 'Menu Deleted Successfully.');
            Session::flash('type', 'success');
            return redirect()->back();
        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'danger');
            return redirect()->back();
        }
    }




}

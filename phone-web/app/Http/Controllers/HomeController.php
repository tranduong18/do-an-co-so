<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Models\SliderModel;
use App\Models\PartnerModel;
use App\Models\PageModel;
use App\Models\ContactUsModel;
use App\Models\SystemSettingModel;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Mail;


class HomeController extends Controller
{
    public function home(){
        $data['getSlider'] = SliderModel::getRecordActive();
        $data['getPartner'] = PartnerModel::getRecordActive();
        $data['getCategory'] = CategoryModel::getRecordActiveHome();
        $data['getProductTrendy'] = ProductModel::getProductTrendy();

        $getPage = PageModel::getSlug('home');
        $data['getPage'] = $getPage;

        $data['meta_title']=$getPage->meta_title;
        $data['meta_keyword']=$getPage->meta_description;
        $data['meta_description']=$getPage->meta_keywords;

        // $data['meta_title']='E-commerce';
        // $data['meta_keyword']='';
        // $data['meta_description']='';

        return view('home',$data);
    }
    public function contact()
    {
       
        $first_number  = mt_rand(0,9);
        $second_number  = mt_rand(0,9);

        $data['first_number'] =$first_number;
        $data['second_number'] =$second_number;

        Session::put('total_sum', $first_number + $second_number);


        $getPage = PageModel::getSlug('contact');
        $data['getPage'] = $getPage;
        $data['getSystemSetting'] = SystemSettingModel::getSingle();
        $data['meta_title']=$getPage->meta_title;
        $data['meta_keyword']=$getPage->meta_description;
        $data['meta_description']=$getPage->meta_keywords;

        return view('page.contact', $data);
    }
    public function submit_contact(Request $request)
    {
        if(!empty($request->verification) && !empty(Session::get('total_sum')))
        {
            If(trim(Session::get('total_sum')) == trim($request->verification))
        {
            $save = new ContactUsModel();
            if(!empty(Auth::check()))
            {
                $save->user_id = Auth::user()->id;
            }
            $save->name = trim($request->name);
            $save->email = trim($request->email);
            $save->phone = trim($request->phone);
            $save->subject = trim($request->subject);
            $save->message = trim($request->message);
            
            $save->save();
            
            // $getSystemSetting = SystemSettingModel::getSingle();
            // Mail::to($getSystemSetting->submit_email)->send(new ContactUsMail($save));
            
            return redirect()->back()->with('success', "Your information successfully send.");
        }
        else
        {
            return redirect()->back()->with('error', "Your verification sum is wrong.");
        }
     }
     else{
        return redirect()->back()->with('error', "Your verification sum is wrong.");
     }
        

    }
    public function about(){
        $getPage = PageModel::getSlug('about');
        $data['getPage'] = $getPage;

        $data['meta_title']=$getPage->meta_title;
        $data['meta_keyword']=$getPage->meta_description;
        $data['meta_description']=$getPage->meta_keywords;

        return view('page.about', $data);
    }
    public function faq(){
        $getPage = PageModel::getSlug('faq');
        $data['getPage'] = $getPage;

        $data['meta_title']=$getPage->meta_title;
        $data['meta_keyword']=$getPage->meta_description;
        $data['meta_description']=$getPage->meta_keywords;
        return view('page.faq', $data);
    }
    public function payment_method(){
        $getPage = PageModel::getSlug('payment_method');
        $data['getPage'] = $getPage;

        $data['meta_title']=$getPage->meta_title;
        $data['meta_keyword']=$getPage->meta_description;
        $data['meta_description']=$getPage->meta_keywords;
        return view('page.payment_methods', $data);
    }
    public function money_back_guarantee(){
        $getPage = PageModel::getSlug('money_back_guarantee');
        $data['getPage'] = $getPage;

        $data['meta_title']=$getPage->meta_title;
        $data['meta_keyword']=$getPage->meta_description;
        $data['meta_description']=$getPage->meta_keywords;
        return view('page.money_back_guarantee', $data);
    }
    public function return(){
        $getPage = PageModel::getSlug('return');
        $data['getPage'] = $getPage;

        $data['meta_title']=$getPage->meta_title;
        $data['meta_keyword']=$getPage->meta_description;
        $data['meta_description']=$getPage->meta_keywords;
        return view('page.return', $data);
    }
    public function shipping(){
        $getPage = PageModel::getSlug('shipping');
        $data['getPage'] = $getPage;

        $data['meta_title']=$getPage->meta_title;
        $data['meta_keyword']=$getPage->meta_description;
        $data['meta_description']=$getPage->meta_keywords;
        return view('page.shipping', $data);
    }
    public function terms_condition(){
        $getPage = PageModel::getSlug('terms-condition');
        $data['getPage'] = $getPage;

        $data['meta_title']=$getPage->meta_title;
        $data['meta_keyword']=$getPage->meta_description;
        $data['meta_description']=$getPage->meta_keywords;
        return view('page.terms_conditions', $data);
    }
    public function privacy_policy(){
        $getPage = PageModel::getSlug('privacy_policy');
        $data['getPage'] = $getPage;

        $data['meta_title']=$getPage->meta_title;
        $data['meta_keyword']=$getPage->meta_description;
        $data['meta_description']=$getPage->meta_keywords;
        return view('page.privacy_policy', $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Models\SliderModel;
use App\Models\PartnerModel;

class HomeController extends Controller
{
    public function home(){
        $data['getSlider'] = SliderModel::getRecordActive();
        $data['getPartner'] = PartnerModel::getRecordActive();
        $data['getCategory'] = CategoryModel::getRecordActiveHome();
        $data['getProductTrendy'] = ProductModel::getProductTrendy();

        $data['meta_title']='E-commerce';
        $data['meta_keyword']='';
        $data['meta_description']='';

        return view('home',$data);
    }
    public function contact(){
        return view('page.contact');
    }
    public function about(){
        return view('page.about');
    }
    public function faq(){
        return view('page.faq');
    }
    public function payment_methods(){
        return view('page.payment_methods');
    }
    public function money_back_guarantee(){
        return view('page.money_back_guarantee');
    }
    public function return(){
        return view('page.return');
    }
    public function shipping(){
        return view('page.shipping');
    }
    public function terms_condition(){
        return view('page.terms_conditions');
    }
    public function privacy_policy(){
        return view('page.privacy_policy');
    }
}

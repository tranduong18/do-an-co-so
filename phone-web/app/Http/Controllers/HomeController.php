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
}

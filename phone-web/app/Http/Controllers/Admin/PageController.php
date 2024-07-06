<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageModel;
use App\Models\ContactUsModel;

use App\Models\SystemSettingModel;
use App\Models\HomeSettingModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function contactus()
    {
        $data['getRecord'] = ContactUsModel::getRecord();
        $data['header_title'] = 'Contact us';
        return view('admin.contactus.list', $data);
    }
    public function contactus_delete($id)
    {
        ContactUsModel::where('id', '=', $id)->delete();

        return redirect()->back()->with('success', "Record Successfully Deleted");
    }
    public function list()
    {
        $data['getRecord'] = PageModel::getRecord();
        $data['header_title'] = 'Page';
        return view('admin.page.list', $data);
    }


    public function edit($id)
    {
        $data['getRecord'] = PageModel::getSingle($id);
        $data['header_title'] = 'Edit Page';
        return view('admin.page.edit', $data);
    }

    public function update($id, Request $request)
    {
        $page = PageModel::getSingle($id);
        $page->name = trim($request->name);
        $page->title = trim($request->title);
        $page->description = trim($request->description);
        $page->meta_title = trim($request->meta_title);
        $page->meta_description = trim($request->meta_description);
        $page->meta_keywords = trim($request->meta_keywords);
        
        if (!empty($request->file('image_name'))) {
            // unlink('upload/page/'.$page->image_name);
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $page->id . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/page/', $filename);
            $page->image_name = trim($filename);
        }
        $page->save();
        return redirect('admin/page/list')->with('success', "Page Charge successfully updated");
    }
    public function system_setting()
    {
        $data['getRecord'] = SystemSettingModel::getSingle();
        $data['header_title'] = 'System Setting';
        return view('admin.setting.system_setting', $data);
    }


    public function update_system_setting(Request $request)
    {
        $save = SystemSettingModel::getSingle();
        $save->website_name = trim($request->website_name);
        $save->footer_description = trim($request->footer_description);
        $save->addres = trim($request->address);
        $save->phone = trim($request->phone);
        $save->phone_two = trim($request->phone_two);
        $save->submit_email = trim($request->submit_email);
        $save->email = trim($request->email);
        $save->email_two = trim($request->email_two);
        $save->working_hour = trim($request->working_hour);
        $save->facebook_link = trim($request->facebook_link);
        $save->twitter_link = trim($request->twitter_link);
        $save->instagram_link = trim($request->instagram_link);
        $save->youtube_link = trim($request->youtube_link);
        $save->pinterest_link = trim($request->pinterest_link);

        if (!empty($request->file('logo'))) {
            unlink('upload/setting/'.$save->image_name);
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $filename);
            $save->logo = trim($filename);
        }

        if (!empty($request->file('fevicon'))) {
            unlink('upload/setting/'.$save->fevicon);
            $file = $request->file('fevicon');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $filename);
            $save->fevicon = trim($filename);
        }
        $save->save();

        return redirect()->back()->with('success', "Setting successfully updated");
    }
    
    public function home_setting()
    {
        $data['getRecord'] = HomeSettingModel::getSingle();
        $data['header_title'] = 'Home Setting';
        return view('admin.setting.home_setting', $data);
    }

    public function update_home_setting(Request $request)
    {
        $save = HomeSettingModel::getSingle();
        $save->trendy_product_title = trim($request->trendy_product_title);
        $save->shop_category_title = trim($request->shop_category_title);
        $save->recent_arrival_title = trim($request->recent_arrival_title);
        $save->blog_title = trim($request->blog_title);
        $save->payment_delivery_title = trim($request->payment_delivery_title);
        $save->payment_delivery_description = trim($request->payment_delivery_description);
        $save->payment_delivery_image = trim($request->payment_delivery_image);
        $save->refund_title = trim($request->refund_title);
        $save->refund_description = trim($request->refund_description);
        $save->refund_image = trim($request->refund_image);
        $save->support_title = trim($request->support_title);
        $save->support_description = trim($request->support_description);
        $save->support_image = trim($request->support_image);
        $save->singup_title = trim($request->singup_title);
        $save->singup_description = trim($request->singup_description);
        $save->singup_image = trim($request->singup_image);

        if (!empty($request->file('payment_delivery_image'))) {
            // unlink('upload/setting/'.$save->payment_delivery_image);
            $file = $request->file('payment_delivery_image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $filename);
            $save->payment_delivery_image = trim($filename);
        }

        if (!empty($request->file('refund_image'))) {
            // unlink('upload/setting/'.$save->refund_image);
            $file = $request->file('refund_image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $filename);
            $save->refund_image = trim($filename);
        }

        if (!empty($request->file('support_image'))) {
            // unlink('upload/setting/'.$save->support_image);
            $file = $request->file('support_image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $filename);
            $save->support_image = trim($filename);
        }

        if (!empty($request->file('singup_image'))) {
            // unlink('upload/setting/'.$save->singup_image);
            $file = $request->file('singup_image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $filename);
            $save->singup_image = trim($filename);
        }
        $save->save();

        return redirect()->back()->with('success', "Home Setting successfully updated");
    }
}

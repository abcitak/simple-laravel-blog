<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Flasher\Prime\Notification\NotificationInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ConfigController extends Controller
{
    //
    public function index()
    {
        $config = Config::findOrFail(1);
        return view('back.configs.index',compact('config'));
    }

    public function update(Request $request)
    {
        $config = Config::findOrFail(1);
        $config->site_title = $request->site_title;
        $config->active = $request->active;

        $config->site_title = $request->site_title;
        $config->site_title = $request->site_title;
        $config->facebook = $request->facebook;
        $config->twitter = $request->twitter;
        $config->github = $request->github;
        $config->linkedin = $request->linkedin;
        $config->youtube = $request->youtube;
        $config->instagram = $request->instagram;

        if($request->hasFile('logo'))
        {
            $logoName = Str::slug($request->site_title).'logo-.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads/'),$logoName);
            $config->logo = 'uploads/'.$logoName;
        }

        if($request->hasFile('favicon'))
        {
            $favicon = Str::slug($request->site_title).'favicon-.'.$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads/'),$favicon);
            $config->favicon = 'uploads/'.$favicon;
        }


        $config->save();
        toastr('Ayarlar Güncellendi',NotificationInterface::SUCCESS,'Başarılı');
        return redirect()->back();
    }
}

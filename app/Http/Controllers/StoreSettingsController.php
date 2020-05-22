<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\StoreSettingsHelper;

class StoreSettingsController extends Controller
{
    public $settingsHelper;
    public function __construct(StoreSettingsHelper $helper)
    {
        $this->settingsHelper = $helper;
    }
    public function index()
    {
        $settings = $this->settingsHelper->getSettings()->all();
        // dd($settings[0]);
        if (!empty($settings)) {
            $data = [
                'edit' => true,
                's' => $settings[0]
            ];
        } else {
            $data = [
                'edit' => false,
                's' => null
            ];
        }
        return view('settings.index', $data);
    }

    public function store(Request $request)
    {
        $this->val($request);
        $data = $request->except('_token');
        if ($request->hasFile('store_logo')) {
            $file = $request->file('store_logo');
            $data['store_logo'] = now() . '.' . $file->extension();
            $file->move(public_path(config('constants.store_logo_dir')), $data['store_logo']);
        } else {
            $data['store_logo'] = config('constants.default_store_logo');
        }
        $this->settingsHelper->saveSettings($data);
        session()->flash('message', 'Settings Saved Successfully');
        return redirect()->route('settings.index');
    }

    public function update(Request $request)
    {
        $this->val($request);
        $settings = $this->settingsHelper->getSettings()->all()[0];
        // dd($settings);
        $data = $request->except('_tokken');
        if ($request->hasFile('store_logo')) {
            $file = $request->file('store_logo');
            $data['store_logo'] = now() . '.' . $file->extension();
            $file->move(public_path(config('constants.store_logo_dir')), $data['store_logo']);
            if ($settings->store_logo != config('constants.default_store_logo')) {
                unlink(public_path(config('constants.store_logo_dir')) . '/' . $settings->store_logo);
            }
        } else {
            $data['store_logo'] = config('constants.default_store_logo');
        }
        $settings->update($data);
        session()->flash('message', 'Settings updated Successfully');
        return redirect()->route('settings.index');
    }

    private function val(Request $request)
    {
        return $request->validate([
            'store_logo' => 'mimes:jpeg,jpg,png',
            'title' => 'required|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'bussiness_name' => 'required|string',
            'currency_text' => 'required|string',
            'currency_sym' => 'required|string',
            'phone_1' => 'required|string',
            'phone_2' => 'required|string',
            'address' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'zip' => 'required|string',
        ]);
    }
}

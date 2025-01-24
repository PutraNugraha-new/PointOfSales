<?php

namespace App\Http\Controllers;

use App\Models\application_setting;
use Illuminate\Http\Request;

class ApplicationSettings extends Controller
{
    public function index()
    {
        $data = application_setting::all();

        return view('admin.appsett.index', [
            'title' => 'Application Settings',
            'appsett' => $data
        ]);
    }

    public function create()
    {
        return view('admin.appsett.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'setting_key' => 'required|string|max:255|unique:application_settings,setting_key',
                'setting_value' => 'required|string',
                'data_type' => 'required'
            ]);

            application_setting::create($validatedData);
            return redirect()->route('appSett.index')->with('success', 'Application Setting Created Successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }
}

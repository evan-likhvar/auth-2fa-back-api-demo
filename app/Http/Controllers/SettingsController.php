<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsStoreRequest;
use App\Http\Requests\SettingsUpdateRequest;
use App\Models\Settings;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Settings::with('valueType')->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param SettingsStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SettingsStoreRequest $request)
    {
        $setting = Settings::create($request->all());
        return response()->json($setting->load('valueType'));
    }

    /**
     * Display the specified resource.
     *
     * @param Settings $setting
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Settings $setting)
    {
        return response()->json($setting->load('valueType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Settings $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingsUpdateRequest $request, Settings $setting)
    {
        $sameSetting = $setting::where('name', '=', $request->input('name'))->whereKeyNot($setting->id)->exists();
        if ($sameSetting) {
            return response()->json(['errors' => ['name' => __('validation.unique',['attribute'=> 'name'])]], 422);
        }
        $setting->update($request->all());

        return response()->json($setting->refresh()->load('valueType'));
    }

    /**
     * Remove the specified resource from storage.
     * @param Settings $setting
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Settings $setting)
    {
        if (!$setting->delete()) return response(null, 204);
    }
}

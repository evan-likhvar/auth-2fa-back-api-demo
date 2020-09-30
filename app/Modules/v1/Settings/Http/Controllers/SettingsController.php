<?php

namespace App\Modules\v1\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\v1\Settings\Http\Requests\SettingStoreRequest;
use App\Modules\v1\Settings\Http\Requests\SettingUpdateRequest;
use App\Modules\v1\Settings\Models\Setting;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Setting::with('valueType')->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param SettingStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SettingStoreRequest $request)
    {
        $setting = Setting::create($request->all());
        return response()->json($setting->load('valueType'));
    }

    /**
     * Display the specified resource.
     *
     * @param Setting $setting
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Setting $setting)
    {
        return response()->json($setting->load('valueType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingUpdateRequest $request, Setting $setting)
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
     * @param Setting $setting
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Setting $setting)
    {
        if (!$setting->delete()) return response(null, 204);
    }
}

<?php

namespace App\Modules\v1\UserShopModule\Http\Controllers;

use App\Models\User;
use App\Modules\v1\UserShopModule\Models\UserShop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class UserShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(UserShop::all()->load(['user']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $userShop = UserShop::create($request->all());
        return response()->json($userShop->load(['user']));    }

    /**
     * Display the specified resource.
     *
     * @param UserShop $userShop
     * @return JsonResponse
     */
    public function show(UserShop $userShop)
    {
        return response()->json($userShop->load(['user']));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param UserShop $userShop
     * @return JsonResponse
     */
    public function update(Request $request, UserShop $userShop)
    {
        $userShop->update($request->all());

        return response()->json($userShop->load(['user']));
    }


}

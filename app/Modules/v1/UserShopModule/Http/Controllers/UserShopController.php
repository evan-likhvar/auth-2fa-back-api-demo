<?php

namespace App\Modules\v1\UserShopModule\Http\Controllers;

use App\Models\User;
use App\Modules\v1\UserShopModule\Http\Requests\UserShopRequest;
use App\Modules\v1\UserShopModule\Models\UserShop;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserShopController extends Controller
{
    /**
     * @var User|Authenticatable|null
     */
    private $user;

    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

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
     * @param UserShopRequest $request
     * @return JsonResponse
     */
    public function store(UserShopRequest $request)
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
     * @param UserShopRequest $request
     * @param UserShop $userShop
     * @return JsonResponse
     */
    public function update(UserShopRequest $request, UserShop $userShop)
    {
        $userShop->update($request->all());

        return response()->json($userShop->load(['user']));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBeemSettingsRequest;
use App\Http\Requests\StoreGeneralSettingsRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('admin.settings.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreGeneralSettingsRequest  $request
     * @return RedirectResponse
     */
    public function storeGeneralSettings(StoreGeneralSettingsRequest $request): RedirectResponse
    {
        setting($request->validated())->save();

        return redirect(route('settings.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  StoreBeemSettingsRequest  $request
     * @return Application|Redirector|RedirectResponse
     */
    public function storeBeemSettings(StoreBeemSettingsRequest $request): Redirector|RedirectResponse|Application
    {
        setting($request->validated())->save();

        return redirect(route('settings.index'));
    }
}

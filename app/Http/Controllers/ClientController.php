<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('client.index', [
            'clients' => Client::all()
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return Application|Factory|View
     */
    public function create(Request $request)
    {
        return view('client.create');
    }

    /**
     * @param  ClientStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStoreRequest $request)
    {
        Client::create($request->validated());

        return redirect()->route('client.index');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Client $client)
    {
        return view('client.show', compact('client'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Client $client)
    {
        return view('client.edit', compact('client'));
    }

    /**
     * @param  \App\Http\Requests\ClientUpdateRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request, Client $client)
    {
        $client->update($request->validated());

        $request->session()->flash('client.id', $client->id);

        return redirect()->route('client.index');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Client $client)
    {
        $client->delete();

        return redirect()->route('client.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceStoreRequest;
use App\Http\Requests\ResourceUpdateRequest;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Resource::all();

        return view('resource.index', compact('resources'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('resource.create');
    }

    /**
     * @param \App\Http\Requests\ResourceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResourceStoreRequest $request)
    {
        $resource = Resource::create($request->validated());

        $request->session()->flash('resource.id', $resource->id);

        return redirect()->route('resource.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Resource $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Resource $resource)
    {
        return view('resource.show', compact('resource'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Resource $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Resource $resource)
    {
        return view('resource.edit', compact('resource'));
    }

    /**
     * @param \App\Http\Requests\ResourceUpdateRequest $request
     * @param \App\Models\Resource $resource
     * @return \Illuminate\Http\Response
     */
    public function update(ResourceUpdateRequest $request, Resource $resource)
    {
        $resource->update($request->validated());

        $request->session()->flash('resource.id', $resource->id);

        return redirect()->route('resource.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Resource $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Resource $resource)
    {
        $resource->delete();

        return redirect()->route('resource.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceStoreRequest;
use App\Http\Requests\ResourceUpdateRequest;
use App\Models\Resource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ResourceController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $resources = Resource::all();

        return view('admin.resource.index', compact('resources'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.resource.create');
    }

    /**
     * @param ResourceStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ResourceStoreRequest $request)
    {
        try {
            Resource::create($request->validated());

            toast('Resource has been created successfully.', 'success');

            return redirect()->route('resources.index');

        } catch (\Exception|\Error) {
            toast('Something went really wrong. We\re fixing this right now.', 'error');

            return back();
        }

    }

    /**
     * @param Resource $resource
     * @return Application|Factory|View
     */
    public function show(Resource $resource)
    {
        return view('admin.resource.show', compact('resource'));
    }

    /**
     * @param Resource $resource
     * @return Application|Factory|View
     */
    public function edit(Resource $resource)
    {
        return view('admin.resource.edit', compact('resource'));
    }

    /**
     * @param ResourceUpdateRequest $request
     * @param Resource $resource
     * @return RedirectResponse
     */
    public function update(ResourceUpdateRequest $request, Resource $resource)
    {
        try {
            $resource->update($request->validated());

            toast('Resource updated successfully', 'success');

            return redirect()->route('resources.index');

        } catch (\Exception|\Error) {
            toast('Something went really wrong. We\re fixing this right now.', 'error');

            return back();
        }

    }

    /**
     * @param Resource $resource
     * @return RedirectResponse
     */
    public function destroy(Resource $resource)
    {
        try {
            $resource->delete();

            toast('Resource deleted successfully.', 'success');

            return redirect()->route('resources.index');
        } catch (\Exception|\Error) {
            toast('Something went really wrong. We\re fixing this right now.', 'error');

            return back();
        }

    }
}

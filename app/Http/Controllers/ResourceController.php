<?php

namespace App\Http\Controllers;

use App\Http\Resources\InfoResource;
use App\Resource;
use Illuminate\Http\Request;
use App\User;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return InfoResource::collection(Resource::paginate(30));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resource = new Resource();
        $resource->title = $request->title;
        $resource->content = $request->content;
        $resource->user()->associate(User::findOrFail($request->user_id));
        $resource->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $resource)
    {
        $resource->title = $request->title;
        $resource->question = $request->question;
        $resource->user = $request->user()->associate(User::findOrFail($request->user_id));
    }


}

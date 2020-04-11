<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Resources\DiscussionResource;
use Illuminate\Http\Request;
use App\User;
class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussion = DiscussionResource::collection(Discussion::paginate(30));
        return $discussion;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $discussion = new Discussion();
        $discussion->question = $request->question;
        $discussion->tags = $request->tag;
        $discussion->user()->associate(User::findOrFail($request->user_id));
        $discussion->save();

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussion $discussion)
    {
        $data = $request->all();
        $discussion->title = $data['title'] != null? $data['title'] : $discussion->title;
        $discussion->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        $discussion->delete();
    }
}

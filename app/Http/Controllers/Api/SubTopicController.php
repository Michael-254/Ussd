<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Content as ModelsContent;
use App\Models\SubTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SubTopicController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        $slug = Str::slug($request->title);

        $subtopic = SubTopic::create([
            'course_id' => $request->course_id, 'title' => $request->title, 'slug' => $slug
        ]);

        ModelsContent::Create(['content' => $request->content, 'sub_topic_id' => $subtopic->id]);

        $sub_topic = $subtopic->load('contents');

        return response()->json([
            'success' => true,
            'data' => [
                'data' => $sub_topic,
            ]
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubTopic  $subTopic
     * @return \Illuminate\Http\Response
     */
    public function show(SubTopic $subTopic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubTopic  $subTopic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubTopic $subTopic)
    {
        $request->validate([
            'course_id' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        $slug = Str::slug($request->title);

        $subTopic->update([
            'title' => $request->title, 'slug' => $slug
        ]);

        $content = ModelsContent::whereSubTopicId($subTopic->id)->first();
        $content->update(['content' => $request->content]);

        $sub_topic = $subTopic->load('contents');

        return response()->json([
            'success' => true,
            'data' => [
                'data' => $sub_topic,
            ]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubTopic  $subTopic
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubTopic $subTopic)
    {
        $subTopic->contents()->delete();
        $subTopic->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }
}

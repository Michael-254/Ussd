<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Course as ResourcesCourse;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Passport\Client;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $client = Client::whereId($request->key)->whereSecret($request->secret)->get();
        if($client->count > 0) {
            $courses = Course::all();
            return ResourcesCourse::collection($courses);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'instructor' => 'required',
            'provider' => 'required',
        ]);

        $slug = Str::slug($request->title);
 
        $course = request()->user()->courses()->create($validateData + ['slug' => $slug]);

        return (new ResourcesCourse($course))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return new ResourcesCourse($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Course $course)
    {
        $validateData = request()->validate([
            'title' => 'required',
            'instructor' => 'required',
            'provider' => 'required',
        ]);
        $slug = Str::slug(request()->title);

        $course->update($validateData + ['slug' => $slug]);

        return (new ResourcesCourse($course))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }

}

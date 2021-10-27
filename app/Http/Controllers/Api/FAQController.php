<?php

namespace App\Http\Controllers\Api;

use App\Models\FAQ;
use App\Http\Controllers\Controller;
use App\Http\Resources\Faq as ResourcesFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faqs = FAQ::all();
        return  ResourcesFaq::collection($faqs);
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
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = FAQ::create($validateData);

        return (new ResourcesFaq($faq))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function show(FAQ $fAQ)
    {
        return new ResourcesFaq($fAQ);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FAQ $fAQ)
    {
        $validateData = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $fAQ->update($validateData);

        return (new ResourcesFaq($fAQ))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function destroy(FAQ $fAQ)
    {
        $fAQ->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }
}

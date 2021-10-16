<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Sparors\Ussd\Facades\Ussd;
use Sparors\Ussd\Machine;
use App\Http\Ussd\States\Welcome;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $text=$request->input('text');
        $session_id = $request->input('sessionId');
        $phone_number = $request->input('phoneNumber');
        $service_code = $request->input('serviceCode');
        $network_code = $request->input('networkCode');

        $level = explode("*", $text);
        $ussd = (new Machine())->setSessionId($session_id)
            ->setInput('98')
            ->setInitialState(Welcome::class)
            ->setStore('array');

        /* $ussd = Ussd::machine()
            ->setSessionId('1234')
            ->setFromRequest([
                'network',
                'phone_number' => '0717606015',
                'SessionId' => '54566453434345',
                'input' => 'msg'
            ])
            ->setInitialState(Welcome::class)
            ->setResponse(function (string $message, string $action) {
            return [
                'USSDResp' => [
                    'action' => $action,
                    'menus' => '',
                    'title' => $message
                ]
            ];
	    }); */

	    return response($ussd->run()['message'])->header('Content-Type', 'text/plain');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\HR;
use App\Http\Requests\Admin\UpdateAccountRequest;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class HRController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hr');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('instructor.index');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit()
    {
        return view('hr.auth.edit');
    }

    public function update(UpdateAccountRequest $request, HR $hr)
    {
        if ($request->hasFile('profile')) {
            $image_name = request()->file('profile')->getRealPath();
            Cloudder::upload($image_name, null);
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => 150, "height"=> 150]);
            $hr->profile = $image_url;
        }
        
        $hr->name = $request->name;

        if (!is_null($request->password)) {
            $hr->password = $request->password;
        }
        $hr->save();

        return back()->with('success', 'Successfully update your account.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

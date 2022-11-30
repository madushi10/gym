<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fine;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class FineController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:fine-list|fine-create|fine-edit|fine-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:fine-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:fine-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:fine-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $fines = Fine::latest()->paginate(5);
        foreach($fines as $fine){

        $user[]=Fine::find($fine->id)->user;
        $booking[]=Booking::find($fine->id)->booking;

        }


        return view('Admin.fines.index',compact('fines'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::get();
        $booking = Booking::get();
        return view('Admin.fines.create' , compact('user','booking'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'user_id' => 'required',
            'booking_id' => 'required',
            'states' => 'required',
            'amount' => 'required',
        ]);

        Fines::create($request->all());
        Users::create($request->all());
        Bookings::create($request->all());

        return redirect()->route('Admin.fines.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fine $fine)
    {
        $user = User::get();
        $booking = Booking::get();
        return view('users.show',compact('user','booking'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fine $fine)
    {
        $user = User::get();
        $booking = Booking::get();
        return view('fines.edit',compact('fine' , 'user'));
        return view('fines.edit',compact('fine' , 'user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fine $fine)
    {
       ( ['user_id' => 'required',
        'booking_id' => 'required',
        'states' => 'required',
        'amount' => 'required',]);

        $fine->update($request->all());

        return redirect()->route('fines')
                        ->with('success','fine updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fine $fine)
    {
        $fine->delete();

        return redirect()->route('fines')
                        ->with('success','fine deleted successfully');
    }
}

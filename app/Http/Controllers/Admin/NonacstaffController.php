<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class NonacstaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      //page field is defined in the request
   $user_nonacstaffs = DB::table('users')
   ->join('nonacstaffs', 'users.id', '=', 'nonacstaffs.user_id')
   ->select('users.*', 'nonacstaffs.*')
   ->paginate(5);



//dd($user_nonacstaffs);


// $nurses = Nurse::latest()->paginate(5);
return view('Admin.nonacstaff.index',compact('user_nonacstaffs'))
->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //$all_users_with_all_their_roles = User::with('roles')->get();
            //$users = User::all();
            // $user_roles = [];
            // $user_acstaffs = [];
            // $nonacstaff = [];

            // foreach ($users as $user) {

            // $user_roles=$user->getRoleNames();

            //   if($user_roles[0] == "nonacstaff"){

            //     $user_acstaffs[] = User::find($user->id)->nonacstaff;
            //     $duser[] = User::find($user->id);
            //   }
            // }

            return view('Admin.nonacstaff.create');
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
            'name'=> 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        $nonacstaff = new nonacstaff;
        $nonacstaff->phone = $request->phone;
        $nonacstaff->address = $request->address;
        $nonacstaff->specialization = $request->specialization;
        $nonacstaff->photo_path = $request->file;


        $user->nonacstaff()->save($nonacstaff);

        $user->assignRole('nonacstaff');

        return redirect()->route('nonacstaff.index')
                        ->with('success','Nonacstaff created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nonacstaff=Nonacstaff::find($id);
        $duser=$nonacstaff->user;

        return view('admin.nonacstaffs.show',compact('nonacstaff','duser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nonacstaff=Nonacstaff::find($id);
        // $duser=$nonacstaff->user;
        // dd($nonacstaff);
         return view('Admin.nonacstaffs.edit',compact('nonacstaff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name'=> 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'password' => 'required|string|min:8|confirmed',
            // 'file' => 'required',
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user->password = Hash::make($request->password);

        $user->update();

        $nonacstaff = new Nonacstaff;
        $nonacstaff->phone = $request->phone;
        // $nonacstaff->address = $request->address;
        // $nonacstaff->gender = $request->gender;
        // $nonacstaff->position = $request->position;

        // $nonacstaff->NIC = $request->nic;
        // $nonacstaff->age = $request->age;
        // $nonacstaff->specialization = $request->specialization;

        // $imageName = time().'.'.$request->file->extension();

        // $request->file->move(public_path('images'), $imageName);

        // $nonacstaff->photo_path = $imageName;


        $user->nonacstaff()->update($nonacstaff->toArray());

        // DB::table('model_has_roles')->where('model_id',$id)->delete();

        // $user->assignRole($request->input('roles'));

        return redirect()->route('nonacstaff.index')
                        ->with('success','nonacstaff created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nonacstaff = User::find($id);
        $nonacstaff->delete();
    }
}

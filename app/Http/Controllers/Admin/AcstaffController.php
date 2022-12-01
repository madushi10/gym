<?php

namespace App\Http\Controllers\Admin;

use App\Models\Acstaff;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class AcstaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      //page field is defined in the request
   $user_acstaffs = DB::table('users')
   ->join('acstaffs', 'users.id', '=', 'acstaffs.user_id')
   ->select('users.*', 'acstaffs.*')
   ->paginate(5);



//dd($user_acstaffs);


// $nurses = Nurse::latest()->paginate(5);
return view('Admin.acstaffs.index',compact('user_acstaffs'))
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
            // $acstaff = [];

            // foreach ($users as $user) {

            // $user_roles=$user->getRoleNames();

            //   if($user_roles[0] == "acstaff"){

            //     $user_acstaffs[] = User::find($user->id)->acstaff;
            //     $duser[] = User::find($user->id);
            //   }
            // }

            return view('Admin.acstaffs.create');
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

        $acstaff = new Acstaff;
        $acstaff->phone = $request->phone;
        $acstaff->address = $request->address;
        $acstaff->specialization = $request->specialization;
        $acstaff->photo_path = $request->file;


        $user->acstaff()->save($acstaff);

        $user->assignRole('acstaff');

        return redirect()->route('acstaffs.index')
                        ->with('success','Acstaff created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acstaff=Acstaff::find($id);
        $duser=$acstaff->user;

        return view('Admin.acstaffs.show',compact('acstaff','duser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acstaff=Acstaff::find($id);
        // $duser=$acstaff->user;
        // dd($acstaff);
         return view('Admin.acstaffs.edit',compact('acstaff'));
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

        $acstaff = new Acstaff;
        $acstaff->phone = $request->phone;
        // $acstaff->address = $request->address;
        // $acstaff->gender = $request->gender;
        // $acstaff->position = $request->position;

        // $acstaff->NIC = $request->nic;
        // $acstaff->age = $request->age;
        // $acstaff->specialization = $request->specialization;

        // $imageName = time().'.'.$request->file->extension();

        // $request->file->move(public_path('images'), $imageName);

        // $acstaff->photo_path = $imageName;


        $user->acstaff()->update($acstaff->toArray());

        // DB::table('model_has_roles')->where('model_id',$id)->delete();

        // $user->assignRole($request->input('roles'));

        return redirect()->route('acstaffs.index')
                        ->with('success','Acstaff created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $acstaff = User::find($id);
        $acstaff->delete();
    }
}

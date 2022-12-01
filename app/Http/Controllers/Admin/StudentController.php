<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\StudentController;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    //page field is defined in the request
   $user_students = DB::table('users')
   ->join('students', 'users.id', '=', 'students.user_id')
   ->select('users.*', 'students.*')
   ->paginate(5);



//dd($user_students);


// $nurses = Nurse::latest()->paginate(5);
return view('Admin.students.index',compact('user_students'))
->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        {
            //$all_users_with_all_their_roles = User::with('roles')->get();
            //$users = User::all();
            // $user_roles = [];
            // $user_students = [];
            // $student = [];

            // foreach ($users as $user) {

            // $user_roles=$user->getRoleNames();

            //   if($user_roles[0] == "student"){

            //     $user_students[] = User::find($user->id)->student;
            //     $duser[] = User::find($user->id);
            //   }
            // }

            return view('Admin.students.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //dd($request);
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

        $student = new Student;
        $student->phone = $request->phone;
        $student->name = $request->name;
        $student->rejnumb = $request->rejnumb;
        $student->email = $request->email;

        //$student->specialization = $request->specialization;
       // $student->photo_path = $request->file;
       if($request->hasFile('file')) {
        $imageName = time().'.'.$request->file->extension();

        $request->file->move(public_path('images'), $imageName);

        $student->photo_path = $imageName;

        }


        $user->student()->save($student);

        $user->assignRole('student');

        return redirect()->route('students.index')
                        ->with('success','Student created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

         $student=Student::find($id);
         $duser=$student->user;

         return view('Admin.students.show',compact('student','duser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student=Student::find($id);
       // $duser=$student->user;
       // dd($student);
        return view('Admin.students.edit',compact('student'));
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
         //
        request()->validate([
            'name'=> 'required',
            'email'=> 'required',
            'phone'=> 'required',


        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }else{
            $user = Arr::except($user, ['password']);

        }

        $user->update();

        $student = new Student;
        $student->phone = $request->phone;
        // $student->address = $request->address;
        // $student->gender = $request->gender;
        // $student->position = $request->position;

        $student->rejnumb = $request->rejnumb;
        // $student->age = $request->age;
        // $student->specialization = $request->specialization;


        if($request->hasFile('file')) {
        $imageName = time().'.'.$request->file->extension();

        $request->file->move(public_path('images'), $imageName);

        $student->photo_path = $imageName;
        }

        $user->student()->update($student->toArray());

        // DB::table('model_has_roles')->where('model_id',$id)->delete();

        // $user->assignRole($request->input('roles'));

        return redirect()->route('students.index')
                        ->with('success','Student created successfully.');

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

        $user = User::find($id);
        //dd($user->student);
        $user->student()->delete();
       // $user->delete();

        return redirect()->route('students.index')
        ->with('success','student deleted successfully');
    }
}

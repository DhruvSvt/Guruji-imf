<?php

namespace App\Http\Controllers;

use App\Models\Society;
use App\Models\User;
use App\Models\Resident;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class SocietyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role_id==1){
$societies = Society::Join('residents', 'residents.id', '=', 'societies.policy_type')->leftJoin('users','users.user_id', '=', 'societies.agent')->select('societies.value','societies.id','societies.exp_date','societies.start_date','societies.mobile','societies.commision','societies.email','societies.status','societies.proposer','residents.name as policy','users.name as agentname')
                 ->orderby('societies.id', 'DESC')->get();
        }elseif(auth()->user()->role_id==2){
            $userid = auth()->user()->id;
            $societies = Society::Join('residents', 'residents.id', '=', 'societies.policy_type')->Join('users','users.user_id', '=', 'societies.agent')->select('societies.value','societies.id','societies.exp_date','societies.start_date','societies.mobile','societies.commision','societies.email','societies.status','societies.proposer','residents.name as policy','users.name as agentname')->where('users.society',$userid)
                 ->orderby('societies.id', 'DESC')->get();
        }else{
            $userid = auth()->user()->user_id;
            $societies = Society::Join('residents', 'residents.id', '=', 'societies.policy_type')->Join('users','users.user_id', '=', 'societies.agent')->select('societies.value','societies.id','societies.exp_date','societies.start_date','societies.mobile','societies.commision','societies.email','societies.status','societies.proposer','residents.name as policy','users.name as agentname')->where('societies.agent',$userid)
                 ->orderby('societies.id', 'DESC')->get();

        }

        return view('admin.society.index', compact('societies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(auth()->user()->role_id==1){
            $agents = User::where(['role_id'=> 3, 'status' => 1])->orderBy('user_id', 'ASC')->get();
        }elseif(auth()->user()->role_id==2){
            $userid = auth()->user()->id;
            $agents = User::where(['role_id'=> 3, 'society' => $userid])->orderBy('user_id', 'ASC')->get();
        }else{
            $userid = auth()->user()->id;
            $agents = User::where(['id' => $userid])->orderBy('user_id', 'ASC')->get();
        }
               //Session::flash('success', 'Task successfully added!');

       // echo Session::get('success');die;

        $residents = Resident::where(['status' => 1])->orderBy('name', 'ASC')->get();
        $create = true;
        $title = 'Policy Create';
        return view('admin.society.create', compact('create','residents', 'title','agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       try {

        $user = new Society();

        $user->policy_type = $request->policy_type;
        $user->agent = $request->agent;
        $user->value = $request->value;
        $user->exp_date = $request->exp_date;
        $user->start_date = $request->start_date;
        $user->vehicle_no = $request->vehicle_no;
        $user->proposer = $request->proposer;
        $user->address = $request->address;
        $user->dob = $request->dob;
        $user->ocupation = $request->ocupation;
        $user->gender = $request->gender;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->annual_income = $request->annual_income;
        $user->sum_insured = $request->sum_insured;
        $user->last_c_name = $request->last_c_name;
        $user->last_expiry = $request->last_expiry;
        $user->commision = 0;


        if(isset($request->agent) && $request->agent!=''){
            $residents = Resident::where(['id' => $user->policy_type])->first();
            $com_per = $residents->society;
            $user->commision = round(($user->value/100)* $com_per);
        }

         if($request->file('last_copy'))
        {
            $extension = $request->file('last_copy')->getClientOriginalExtension();
              if($extension=='png' || $extension=='jpg' || $extension == 'jpeg' || $extension == 'pdf'){
             $image = $request->file('last_copy');
             $path = $image->store('files', 'public');
             $user->last_copy  = $path;
              }
        }
        $test = array();
         if($request->hasFile('docs')) {
            $files = $request->file('docs');

            foreach ($files as $key => $file) {
                $extension = $file->getClientOriginalExtension();
              if($extension=='png' || $extension=='jpg' || $extension == 'jpeg' || $extension == 'pdf'){
                     $path = $file->store('files', 'public');
                    $test[$key] = $path;
                }
            }

        }
        $test = implode(",",$test);
        $user->docs = $test;

        $user->save();
        $policyID = $user->id;
        $f_name = $request->input('f_name');

   for($count = 0; $count < collect($f_name)->count(); $count++)
{
    $data = array(
            'f_name' => $request->f_name[$count],
            'f_dob'  => $request->f_dob[$count],
            'f_ht'  => $request->f_ht[$count],
            'f_ocuppation'  => $request->f_ocuppation[$count],
            'f_relation'  => $request->f_relation[$count],
            'f_nominee'  => $request->f_nominee[$count],
            'f_nomineeDOB'  => $request->f_nomineeDOB[$count],
            'f_diabetes'  => $request->f_diabetes[$count],
            'f_bp'  => $request->f_bp[$count],
            'f_predisease'  => $request->f_predisease[$count],
            'policyID' => $policyID
          );
            Member::insert($data);
        }
            return redirect()->route('society.index')->with('message', 'Policy added successfully!');

        } catch (\Exception $e) {
            dd($e->getMessage());
               Session::flash('error', 'Task successfully added!');
               return redirect()->route('society.create');

            //return redirect()->route('society.create')->with('message', 'Data Updated Successfully');
            //  Session::flash('message', "Special message goes here");
            //  return redirect()->back()->with('success', 'your message,here');
            // $em = $e->getMessage();
            // return Redirect::back()->withErrors(['msg' => $em]);
            // return back()->with('error', $em);
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Society $society)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $society = Society::findOrFail($id);
        $title = 'Policy Edit';
        $edit = true;
        return view('admin.society.create', compact('edit', 'title', 'society'));
    }
    public function view($id)
    {

        $societies = Society::Join('residents', 'residents.id', '=', 'societies.policy_type')->Join('users', 'users.user_id', '=', 'societies.agent')->Join('members', 'members.policyID', 'societies.id')->select('societies.*', 'residents.name as policy', 'users.name as agentname', 'members.*')->where('societies.id', $id)->get();
        $title = 'Policy View';
       return view('admin.society.view', compact('societies'));
    }



    public function viewPolicy($id)
    {

        $societies = Society::select('*')->where('id', $id)->first();
        return view('admin.society.view', compact('societies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $society = Society::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'total_appartments' => 'required',
            'city' => 'required',
            'address' => 'required'
        ]);

        $society->update($request->post());

        return redirect()->route('society.index')->with('message', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $society = Society::findOrFail($id);
        $society->delete();
        Member::where('policyID',$id)->delete();
        return redirect()->route('society.index')->with('message', 'Data Deleted Successfully');
    }

    public function status(Request $request)
    {
        $society = Society::findOrFail($request->societyId);
        $society->status = $request->status;
        $society->save();

        return redirect()->back();
    }
}

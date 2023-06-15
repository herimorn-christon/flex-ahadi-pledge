<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pledge;
use App\Models\Jumuiya;
use App\Models\Payment;
use App\Models\CardMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\memberFormRequest;
use App\Http\Requests\Admin\updateMemberFormRequest;
use App\Models\Dependant;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $new_user = Auth::user()->church_id;
        $role = Role::findByName('member');
        
        $members = $role->users()
            ->where('church_id', $new_user)
            ->orderBy('updated_at', 'DESC')
            ->with('community')
            ->get();
        
        $total_members = $role->users()
            ->where('church_id', $new_user)
            ->count();
        
        $active_members = $role->users()
            ->where('church_id', $new_user)
            ->where('status', '')
            ->count();
        
        $inactive_members = $role->users()
            ->where('church_id', $new_user)
            ->where('status', '1')
            ->count();
        
        $male_members = $role->users()
            ->where('church_id', $new_user)
            ->where('gender', 'male')
            ->count();
        
        $female_members = $role->users()
            ->where('church_id', $new_user)
            ->where('gender', 'female')
            ->count();
        
        return response()->json([
            'members' => $members,
            'total_members' => $total_members,
            'active_members' => $active_members,
            'inactive_members' => $inactive_members,
            'male_members' => $male_members,
            'female_members' => $female_members,
        ]);
    }

    // search community 
    public function autocomplete(Request $request)
    {        
        $data = Jumuiya::select("name")
            ->where("name", "LIKE", "%{$request->str}%")
            ->get('query');

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_user = Auth::user()->church_id;
        $role = Role::findByName('member');

        $request->validate([
            'fname' => 'required|max:255',
            'mname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required',
            'date_of_birth' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $minBirthYear = now()->subYears(18)->format('Y');
                    $submittedBirthYear = date('Y', strtotime($value));
                    
                    if ($submittedBirthYear > $minBirthYear) {
                        $fail('You must be at least 18 years old.');
                    }
                },
            ],
            'password' => 'required',
            'gender' => 'required',
            'jumuiya' => 'required',
        ]);

        $member = new User();
        $member->fname = $request->fname;
        $member->mname = $request->mname;
        $member->lname = $request->lname;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->gender = $request->gender;
        $member->date_of_birth = $request->date_of_birth;
        $member->jumuiya = $request->jumuiya;
        $member->status = $request->status ? '1' : '0';
        $member->password = Hash::make($request->password);
        $member->church_id = $new_user;
        $member->save();

        $role->users()->attach($member);

        return response()->json(['status' => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $new_user = Auth::user()->church_id;
        $member = User::with('community')->find($id);
        $payments = Payment::where('user_id', $id)
            ->with('payment')
            ->with('pledge')
            ->get();
        $pledges = Pledge::where('user_id', $id)
            ->where('type_id', 9)
            ->with('type')
            ->with('purpose')
            ->get();
        $pledges_object = Pledge::where('user_id', $id)
            ->where('type_id', 1)
            ->with('type')
            ->with('purpose')
            ->get();
        $cards = CardMember::where('user_id', $id)
            ->with('user')
            ->with('card')
            ->get();
        $dependants = Dependant::where('users_id', $id)->get();

        return response()->json([
            'member' => $member,
            'payments' => $payments,
            'pledges' => $pledges,
            'cards' => $cards,
            'dependants' => $dependants,
            'pledges_object' => $pledges_object,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fname' => 'required|max:255',
            'mname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required',
            'date_of_birth' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $minBirthYear = now()->subYears(18)->format('Y');
                    $submittedBirthYear = date('Y', strtotime($value));
                    
                    if ($submittedBirthYear > $minBirthYear) {
                        $fail('You must be at least 18 years old.');
                    }
                },
            ],
            'gender' => 'required',
            'jumuiya' => 'required',
            'status' => 'boolean',
        ]);

        $member = User::find($id);
        $member->fname = $request->fname;
        $member->mname = $request->mname;
        $member->lname = $request->lname;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->gender = $request->gender;
        $member->date_of_birth = $request->date_of_birth;
        $member->jumuiya = $request->jumuiya;
        $member->status = $request->status ? '1' : '0';
        $member->save();

        return response()->json(['status' => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return response()->json(['status' => "success"]);
    }

    public function search(Request $request)
    {
        $members = [];

        if ($request->has('q')) {
            $search = $request->q;
            $members = User::select("id", "fname", "mname", "lname")
                ->where(function ($query) use ($search) {
                    $query->where('fname', 'LIKE', "%$search%")
                        ->orWhere('mname', 'LIKE', "%$search%")
                        ->orWhere('lname', 'LIKE', "%$search%");
                })
                ->where('role', 'member')
                ->get();
        } else {
            $members = User::where('role', 'member')->get();
        }

        return response()->json($members);
    }

    public function storeValue(Request $request)
    {
        $id = $request->update_id;
        $user = User::find($id);
        $user->marriage_date = $request->mdate;
        $user->deacon_name = $request->dname;
        $user->deacon_phone = $request->dphone;
        $user->baptization_date = $request->bdate;
        $user->kipaimara_date = $request->cdate;
        $user->fellowship_name = $request->fename;
        $user->partner_name = $request->pname;
        $user->proffession = $request->proffesion;
        $user->save();

        return response()->json([
            'success' => 'spiritual services are updated',
        ], 201);
    }
}

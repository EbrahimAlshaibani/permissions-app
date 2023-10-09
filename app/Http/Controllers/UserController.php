<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    function __construct()
    {
            $this->middleware('permission:user-list', ['only' => ['index','show']]);
            $this->middleware('permission:user-cerate', ['only' => ['create','store']]);
            $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
            $this->middleware('permission:change-password', ['only' => ['changePassword']]);
    }
    public function index(Request $request)
    {
        $users = User::with('roles')->latest()->paginate(25);
        return view('users.index',compact('users'));
    }
    
    public function create()
    {
        $roles = Role::all();
        $users = User::all();
        $permissions = Permission::all();
        return view('users.create',compact('roles','users','permissions'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'username'=> 'required|unique:users,username',
            'is_enabled' =>'required',
            'password' => 'required|same:confirm-password',
            // 'roles' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'real_name' => $request->real_name,
            'username'=> $request->username,
            'address'=> $request->address,
            'phone'=> $request->phone,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'is_enabled'=> $request->is_enabled,
            'hasChangedPassword' => 0,
        ]);
        $user->syncRoles($request->input('roles'));
        $user->syncPermissions($request->input('permissions'));
        return redirect()->route('users.index')
        ->with('success','تم إضافة المستخدم بنجاح');
    }
    
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.edit',compact('user','roles','users','permissions'));
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'username'=> 'required',
            'is_enabled' =>'required',
            'password' => 'same:confirm-password',
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password')); 
        }

        if(!empty($input['phone'])){ 
            $input['phone'] = $input['phone'];
        }else{
            $input = Arr::except($input,array('phone'));    
        }
    
        $user = User::find($id);
        if(!empty($input['password'])){ 
            $user->hasChangedPassword = 0;
        }
        $user->syncRoles($request->input('roles'));
        $user->syncPermissions($request->input('permissions'));

        $user->update($input);

        return redirect()->route('users.index')
                        ->with('success','تم تعديل المستخدم بنجاح');
    }
    public function profile()
    {
        return view('users.profile');
    }
    public function changePassword(Request $request)
    {
        $this->validate($request,[
            'curentPassword' =>  'required',
            'newPassword'=>  'required|min:8',
            'cnewPassword'=>  'required|same:newPassword',
        ],[
            'curentPassword.required' =>  'ادخل كلمة المرور الحالية',
            'newPassword.required' =>  'ادخل كلمة المرور الجديدة',
            'cnewPassword.required' =>  'ادخل تأكيد كلمة الجديدة',
            'newPassword.min' =>  'يجب ان تكون كلمة المرور 8 احرف على الاقل',
            'cnewPassword.same' =>  'يجب ان تتطابق كلمة المرور الجديدة مع تاكيد كلمة المرور',
        ]);
        if(password_verify($request->curentPassword,Auth::user()->password))
        {
            $user = User::where('id',Auth::user()->id)
            ->first();
            $user->password = Hash::make($request->newPassword);
            $user->hasChangedPassword = 1;
            $user->save();
            return redirect()->back()
            ->with('success','تم تعديل كلمة المرور بنجاح');
        }else{
            return redirect()->back()
            ->with('success','كلمة المرور خاطئة');
        }
    }
    // public function delete($id)
    // {
    //     $user = User::find($id);
    //     $user->delete();
    //     return redirect()->back()
    //         ->with('success','تم الحذف');
    // }
}

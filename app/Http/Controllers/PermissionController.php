<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permission-list', ['only' => ['index','show']]);
        $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }
    public function create()
    {
        $permissions = Permission::all();
        return view('permissions.create',compact('permissions'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            'description' => 'required|unique:permissions,name',
        ]);
    
        $permission = Permission::create([
            'name' => $request->name,
            'description' => $request->description,
            'guard_name' => 'web',

        ]);
            
        return redirect()->back()
                ->with('success','تم أضافة الصلاحيات بنجاح');
    }
    public function edit(Request $request,Permission $permission)
    {
        return view('permissions.edit',compact('permission'));
    }
    public function update(Request $request,Permission $permission)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name,'.$permission->id,
            'description' => 'required|unique:permissions,description,'.$permission->id,
        ]);
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->update();
        return redirect()->back()
                ->with('success','تم تعديل الصلاحيات بنجاح');
    }
    public function destroy(Permission $permission) {
        $permission->delete();
        return redirect()->back()
        ->with('success','تم الحذف الصلاحيات بنجاح');
    }
}

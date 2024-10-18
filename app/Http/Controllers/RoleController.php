<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function showUsers()
    {
        $users = User::all();
        $roles = Role::all();
        return view('setting.roles.assign_user_role', compact('users','roles'));
    }

    public function addRole()
    {
        $permissions = Permission::all()->groupBy('category');
        return view('setting.roles.add_roles', compact('permissions'));
    }


    public function showRole()
    {
        $roles = Role::with('permissions')->get();
        return view('setting.roles.role_list', compact('roles'));
    }


    public function storeRole(Request $request)
    {

        try {

            $role = Role::create($request->only('name'));          
            return redirect()->route('showRole')->with('success', 'Role created successfully.');

        } catch (\Exception $e) {
            
            return redirect()->back()->with('error', 'Failed to create role: ' . $e->getMessage());

        }
    }

    public function editRole($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        return view('setting.roles.role_edit', compact('role'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'permissions' => 'required|array'
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->role_name,
            'description' => $request->description,
        ]);

        $role->permissions()->delete();

        foreach ($request->permissions as $permission => $value) {
            $role->permissions()->create([
                'permission' => $permission,
                'can_create' => $value['can_create'] ?? 0,
                'can_read' => $value['can_read'] ?? 0,
                'can_edit' => $value['can_edit'] ?? 0,
                'can_delete' => $value['can_delete'] ?? 0,
            ]);
        }

        return redirect()->route('showRole')->with('success', 'Role updated successfully');
    }

    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);

        // Delete the permissions associated with the role
        $role->permissions()->delete();

        // Delete the role
        $role->delete();

        return redirect()->route('showRole')->with('success', 'Role deleted successfully');
    }

    public function assignRole(Request $request)
    {
        // Validate the input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        try {
            // Retrieve the user and role
            $user = User::findOrFail($request->user_id);
            $role = Role::findOrFail($request->role_id);

            // Assign the role to the user
            $user->assignRole($role->name);

            return redirect()->back()->with('success', 'Role huththa assigned to user successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to assign role: ' . $e->getMessage());
        }
    }


    public function addPermission()
    {
        return view('setting.roles.add_permitions');
    }

    
   
    public function storePermission(Request $request)
    {

        //dd($request);
        try {
            $request->validate([
                'category' => 'required',
                'items.*.name' => 'required|string|max:255',
                'items.*.description' => 'nullable|string',
            ]);

            foreach ($request->items as $itemData) {
                $item = new Permission();
                
                $item->name = $itemData['name'];
                $item->description = $itemData['description'];
                $item->category = $request->category;

                $item->save();
            }

            return redirect()->route('showPermission')->with('success', 'Permission added successfully!');
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function showPermission()
    {
        $permissions = Permission::all();
        return view('setting.roles.show_Permission', compact('permissions'));
    }

    




}

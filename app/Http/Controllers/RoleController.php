<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use App\Repositories\RolesRepository;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = RolesRepository::query()->where('shop_id', $this->mainShop()->id)->orderByDesc('id')->get();
        return view('role.index', compact('roles'));
    }

    public function store(RoleRequest $request)
    {
        RolesRepository::storeByRequest($request);
        return back()->with('success', 'Role is created successfully!');
    }
    public function update(RoleRequest $request, Role $role)
    {
        RolesRepository::updateByRequest($request, $role);
        return back()->with('success', 'Role is updated successfully!');
    }

    public function permission($id)
    {
        $role = RolesRepository::find($id);
        $rolePermissions = Role::findByName($role->name)->permissions->pluck('name')->toArray();
        $permissions = Permission::all();
        return view('role.permission', compact('role', 'permissions', 'rolePermissions'));
    }

    public function setPermission(Request $request)
    {
        $request->validate([
            'permission' => 'required|array',
        ]);

        $permissions = [];
        foreach ($request->permission as $key => $permission) {
            if ($key == 'product.create') {
                $permissions[] = 'product.store';
            }
            if ($key == 'product.edit') {
                $permissions[] = 'product.update';
            }

            if ($key == 'purchase.create') {
                $permissions[] = 'purchase.store';
            }
            if ($key == 'purchase.edit') {
                $permissions[] = 'purchase.update';
            }

            if ($key == 'user.create') {
                $permissions[] = 'user.store';
            }
            if ($key == 'user.edit') {
                $permissions[] = 'user.update';
            }

            if ($key == 'customer.create') {
                $permissions[] = 'customer.store';
            }
            if ($key == 'customer.edit') {
                $permissions[] = 'customer.update';
            }

            if ($key == 'supplier.create') {
                $permissions[] = 'supplier.store';
            }
            if ($key == 'supplier.edit') {
                $permissions[] = 'supplier.update';
            }

            if ($key == 'category.create') {
                $permissions[] = 'category.store';
            }
            if ($key == 'category.edit') {
                $permissions[] = 'category.update';
            }
            $permissions[] = $key;
        }

        $role = Role::find($request->role_id);
        $role->syncPermissions($permissions);
        return back()->with('success', 'Permission is updated successfully');
    }
}

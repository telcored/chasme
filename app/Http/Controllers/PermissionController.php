<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permisos')->only(['index']);
        $this->middleware('permission:permisos-crear')->only(['create', 'store']);
        $this->middleware('permission:permisos-editar')->only(['edit', 'update']);
        $this->middleware('permission:permisos-eliminar')->only(['destroy']);
    }

    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:permissions,name',
            'slug' => 'required|string|unique:permissions,slug',
        ]);

        Permission::create($data);
        return redirect()->route('permissions.index')
            ->with('success', 'Permiso creado correctamente.');
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id,
            'slug' => 'required|string|unique:permissions,slug,' . $permission->id,
        ]);

        $permission->update($data);
        return redirect()->route('permissions.index')
            ->with('success', 'Permiso actualizado correctamente.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')
            ->with('success', 'Permiso eliminado correctamente.');
    }
}

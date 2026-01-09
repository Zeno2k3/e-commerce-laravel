<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        // Define role metadata that isn't in the database
        $rolesData = [
            'admin' => [
                'name' => 'Quản trị viên',
                'code' => 'ADMIN',
                'department' => 'Ban giám đốc',
                'level' => 'Cấp cao',
                'level_class' => 'bg-red-600 text-white',
                'status' => 'Hoạt động',
            ],
            'employee' => [
                'name' => 'Nhân viên',
                'code' => 'NV',
                'department' => 'Vận hành',
                'level' => 'Nhân viên',
                'level_class' => 'bg-gray-100 text-gray-800',
                'status' => 'Hoạt động',
            ],
        ];

        // Count users for each role
        $roleCounts = User::selectRaw('role, count(*) as count')
            ->whereIn('role', array_keys($rolesData))
            ->groupBy('role')
            ->pluck('count', 'role')
            ->toArray();

        // Merge count into data
        $roles = [];
        foreach ($rolesData as $key => $data) {
            $data['count'] = $roleCounts[$key] ?? 0;
            $data['key'] = $key;
            $roles[] = (object) $data;
        }

        return view('admin.roles.index', compact('roles'));
    }
}

<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {
    public function index() {
        // Lấy toàn bộ danh sách khách hàng từ bảng user
        $users = DB::table('user')->get();
        return view('admin.customers.index', compact('users'));
    }
}
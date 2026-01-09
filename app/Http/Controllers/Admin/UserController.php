<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {
    public function index() {
    // Chỉ lấy những người là khách hàng bình thường
    $users = DB::table('user')
                ->where('role', '=', 'user')
                ->get();

    return view('admin.customers.index', compact('users'));
}
}

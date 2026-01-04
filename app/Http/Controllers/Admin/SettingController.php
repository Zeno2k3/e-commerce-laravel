<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller {
    public function index() {
        // Cách sửa lỗi "null": Ép lấy user có ID là 1 (là cái thằng Test User mày đang thấy)
        //
        $admin = DB::table('user')->where('user_id', 1)->first();

        // Nếu trong DB mày muốn lấy thằng khác, hãy đổi số 1 thành ID tương ứng
        
        return view('admin.settings', compact('admin'));
    }

    public function updateProfile(Request $request) {
        // Cập nhật cho đúng thằng ID số 1 đó luôn
        DB::table('user')->where('user_id', 1)->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'updated_at' => now()
        ]);
        
        return redirect()->back()->with('success', 'Đã cập nhật thông tin!');
    }
}
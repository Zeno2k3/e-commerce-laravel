<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:product,product_id',
                'rating' => 'required|integer|min:1|max:5',
                'content' => 'required|string|max:1000',
            ]);

            if (!Auth::check()) {
                return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập để đánh giá'], 401);
            }

            // Check if user already reviewed this product? (Upsert logic)
            // Using updateOrCreate to support "Editing" by submitting again
            $review = Review::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                ],
                [
                    'rating' => $request->rating,
                    'content' => $request->content,
                    'review_date' => now(),
                ]
            );

            return response()->json([
                'success' => true, 
                'message' => 'Đánh giá đã được gửi thành công!',
                'data' => [
                    'review_id' => $review->review_id,
                    'rating' => $review->rating,
                    'content' => $review->content
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Review Store Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy($id)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập'], 401);
        }

        $review = Review::find($id);

        if (!$review) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy đánh giá'], 404);
        }

        // Ensure user owns the review
        if ($review->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Bạn không có quyền xóa đánh giá này'], 403);
        }

        $review->delete();

        return response()->json(['success' => true, 'message' => 'Đánh giá đã được xóa thành công']);
    }
}

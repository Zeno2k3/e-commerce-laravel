<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Services\GeminiService;

class ChatBotController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        $lowerMessage = mb_strtolower($message);
        $reply = "";
        $suggestions = [];

        // 0. QUICK REPLY HANDLERS (Specific Exact Matches)
        if ($message === 'Shop đang có khuyến mãi gì không?') {
            $context = $this->getSystemContext();
            $reply = "🎁 **Tin vui cho bạn!**\n\n" . 
                     ($context['vouchers'] !== 'Hiện chưa có mã giảm giá công khai.' ? "Mã giảm giá hot: " . $context['vouchers'] . "\n" : "") .
                     ($context['events'] !== 'Hiện chưa có sự kiện lớn.' ? "Sự kiện: " . $context['events'] : "Hiện tại chưa có chương trình lớn, nhưng bạn nhớ ghé mục 'Mã giảm giá' để săn voucher bí mật nhé!");
            
            $suggestions = ['Cách dùng mã giảm giá', 'Sản phẩm đang Sale', 'Chính sách Freeship'];
            return response()->json(['reply' => $reply, 'suggestions' => $suggestions]);
        }

        if ($message === 'Gợi ý sản phẩm mới nhất') {
            $newProducts = \App\Models\Product::with('variants')->latest()->take(3)->get();
            if ($newProducts->count() > 0) {
                $reply = "✨ **Bộ sưu tập mới nhất vừa cập bến:**\n";
                foreach ($newProducts as $p) {
                    $price = number_format($p->variants->min('price') ?? 0);
                    $reply .= "- {$p->product_name} ({$price}đ)\n";
                }
                $reply .= "\nBạn muốn xem chi tiết mẫu nào không?";
            } else {
                $reply = "Hiện tại bên mình đang cập nhật mẫu mới. Bạn xem qua các mẫu Best Seller nhé!";
            }
            $suggestions = ['Xem tất cả sản phẩm', 'Sản phẩm giá rẻ', 'Tư vấn Size'];
            return response()->json(['reply' => $reply, 'suggestions' => $suggestions]);
        }

        if ($message === 'Chính sách đổi trả thế nào?') {
            $reply = "🛡️ **Yên tâm mua sắm tại Luxe Shop:**\n\n" .
                     "- Đổi size/mẫu miễn phí trong vòng **7 ngày**.\n" .
                     "- Hoàn tiền 100% nếu sản phẩm lỗi do nhà sản xuất.\n" .
                     "- Được kiểm tra hàng trước khi thanh toán.\n\n" .
                     "Bạn cần hỗ trợ đổi đơn hàng nào không ạ?";
            $suggestions = ['Liên hệ Hotline', 'Địa chỉ gửi hàng', 'Phí vận chuyển'];
            return response()->json(['reply' => $reply, 'suggestions' => $suggestions]);
        }


        // 1. FAST RULE-BASED CHECK (Immediate, Static Answers)
        $keywordMap = [
            ['keywords' => ['địa chỉ', 'shop ở đâu'], 'reply' => 'Showroom chính: 123 Đường ABC, Quận 1, TP.HCM. Mở cửa từ 8:00 - 22:00.', 'suggestions' => ['Bản đồ', 'Hotline']],
            ['keywords' => ['hotline', 'sđt', 'liên hệ'], 'reply' => 'Hotline hỗ trợ 24/7: 1900 1234.', 'suggestions' => ['Chat Zalo', 'Gửi Email']],
            ['keywords' => ['zalo', 'facebook'], 'reply' => 'Bạn có thể liên hệ qua Fanpage "Luxe Shop" hoặc Zalo 0909xxxxxx nhé.', 'suggestions' => ['Hotline', 'Địa chỉ shop']],
        ];

        foreach ($keywordMap as $rule) {
            foreach ($rule['keywords'] as $keyword) {
                if (str_contains($lowerMessage, $keyword)) {
                    return response()->json([
                        'reply' => $rule['reply'], 
                        'suggestions' => $rule['suggestions'] ?? ['Sản phẩm mới', 'Khuyến mãi']
                    ]);
                }
            }
        }

        // 2. BUILD CONTEXT (RAG)
        $contextData = $this->getSystemContext();
        $productContext = "";
        
        // Search for relevant products if query seems to be about products
        $searchQuery = str_replace(['giá', 'tìm', 'mua', 'bán', 'có', 'mẫu', 'shop', 'ơi', 'cho', 'em', 'mình', 'của', 'bao nhiêu', 'tư vấn', 'khuyến mãi', 'sale'], '', $lowerMessage);
        $searchQuery = trim($searchQuery);
        
        if (mb_strlen($searchQuery) > 2) {
             $products = \App\Models\Product::where('product_name', 'like', "%{$searchQuery}%")
                                           ->orWhere('description', 'like', "%{$searchQuery}%")
                                           ->with('variants')
                                           ->take(4)
                                           ->get();
            
            if ($products->count() > 0) {
                $productContext = "SẢN PHẨM TÌM THẤY TRONG KHO:\n";
                foreach ($products as $p) {
                    $minPrice = $p->variants->min('price') ?? 0;
                    $priceFormatted = number_format($minPrice, 0, ',', '.') . 'đ';
                    $productContext .= "- Tên: {$p->product_name} | Giá từ: {$priceFormatted} | Link: /san-pham/{$p->product_id}\n";
                }
            }
        }

        // 3. GENERATE AI RESPONSE
        $systemPrompt = $this->buildPrompt($message, $contextData, $productContext);

        // Call Gemini
        $aiReply = $this->geminiService->generateContent($systemPrompt);

        if ($aiReply) {
            // Default suggestions for AI responses if we can't contextually generate them yet
            $defaultSuggestions = ['Sản phẩm mới', 'Khuyến mãi', 'Tư vấn Size'];
            
            // Simple heuristic to vary suggestions based on content
            if (str_contains(mb_strtolower($aiReply), 'giá')) {
                $defaultSuggestions = ['Mua ngay', 'Sản phẩm khác', 'Phí ship'];
            }
            if (str_contains(mb_strtolower($aiReply), 'size')) {
                $defaultSuggestions = ['Bảng size', 'Đổi trả', 'Chất liệu'];
            }

            return response()->json(['reply' => $aiReply, 'suggestions' => $defaultSuggestions]);
        }

        // 4. FALLBACK
        return response()->json([
            'reply' => "Xin lỗi, hiện tại mình đang bận xíu. Bạn hãy thử hỏi lại hoặc liên hệ hotline nhé! 📞",
            'suggestions' => ['Hotline', 'Sản phẩm mới', 'Khuyến mãi']
        ]);
    }

    private function getSystemContext()
    {
        // 1. Get Categories
        $categories = \App\Models\Category::pluck('category_name')->implode(', ');

        // 2. Get Active Vouchers
        $vouchers = \App\Models\Voucher::active()->valid()->take(3)->get()->map(function($v) {
            return "Mã [{$v->voucher_code}]: Giảm {$v->discount_percentage}% (Tối đa " . number_format($v->max_discount_value) . "đ)";
        })->implode('; ');

        // 3. Get Active Events
        $events = \App\Models\PromotionEvent::active()->take(2)->get()->map(function($e) {
            return "Sự kiện [{$e->name}]: Giảm {$e->discount_percent}% toàn bộ sp";
        })->implode('; ');

        return [
            'categories' => $categories,
            'vouchers'   => $vouchers ?: 'Hiện chưa có mã giảm giá công khai.',
            'events'     => $events ?: 'Hiện chưa có sự kiện lớn.',
        ];
    }

    private function buildPrompt($userMessage, $globalContext, $productContext)
    {
        return "Bạn là trợ lý ảo AI của 'Luxe Shop'.
                
                DỮ LIỆU CỬA HÀNG (Hãy dùng thông tin này để trả lời):
                - Danh mục sản phẩm: {$globalContext['categories']}
                - Khuyến mãi đang chạy: {$globalContext['events']}
                - Mã giảm giá (Voucher): {$globalContext['vouchers']}
                
                {$productContext}

                HƯỚNG DẪN TRẢ LỜI:
                1. Ngắn gọn, thân thiện, dùng emoji 🛍️✨.
                2. Nếu khách hỏi khuyến mãi/voucher, hãy liệt kê các mã CÓ trong dữ liệu trên.
                3. Nếu khách hỏi sản phẩm cụ thể, dùng thông tin trong mục 'SẢN PHẨM TÌM THẤY'. Nếu không có, gợi ý xem theo danh mục.
                4. Tuyệt đối KHÔNG bịa đặt thông tin không có trong dữ liệu.

                Câu hỏi của khách: \"{$userMessage}\"
                Trả lời:";
    }
}

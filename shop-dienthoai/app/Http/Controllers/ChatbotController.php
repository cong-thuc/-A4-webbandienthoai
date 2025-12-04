<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    // Dữ liệu sản phẩm MẪU (BẠN CÓ THỂ THAY THẾ BẰNG TRUY VẤN DATABASE)
    private $products = [
        'iphone 15' => ['price' => '20.000.000đ', 'specs' => 'Màn hình 6.1 inch Super Retina XDR, Chip A16 Bionic, Camera 48MP.', 'status' => 'Còn hàng (Đen, Trắng, Xanh).', 'durability' => 'Sản phẩm chính hãng, độ bền cao, được bảo hành 12 tháng.'],
        'iphone 15 pro max' => ['price' => '28.500.000đ', 'specs' => 'Vỏ Titan, Chip A17 Pro, Camera Telephoto 5x, Pin lớn.', 'status' => 'Đặt trước, dự kiến giao hàng sau 5 ngày.', 'durability' => 'Là dòng cao cấp nhất, độ bền vượt trội, khung Titan nhẹ và bền.'],
        'samsung s25 ultra' => ['price' => '25.000.000đ', 'specs' => 'Màn hình Dynamic AMOLED 2X 6.8 inch, Chip Snapdragon 8 Gen 3 for Galaxy, kèm bút S Pen.', 'status' => 'Còn hàng (Tím, Đen).', 'durability' => 'Thiết kế kháng nước, bụi IP68, chất liệu Armor Aluminum, rất bền.'],
        'oppo reno14' => ['price' => '10.000.000đ', 'specs' => 'Camera 64MP, Pin 5000mAh, Sạc nhanh 67W.', 'status' => 'Còn hàng số.', 'durability' => 'Thiết kế mỏng nhẹ, độ bền tốt trong tầm giá.'],
    ];

    public function ask(Request $request)
    {
        $request->validate(['message' => 'required|string|max:500']);
        $userMessage = strtolower($request->input('message')); 

        $aiResponse = $this->processMessage($userMessage);

        return response()->json(['answer' => $aiResponse]);
    }

    private function getIphoneNewestAnswer() {
        $p_max = $this->products['iphone 15 pro max'] ?? null;
        $p_base = $this->products['iphone 15'] ?? null;
        
        $response = "Dòng **iPhone 15 Series** hiện là mới nhất và hot nhất tại Phone Shop! \n\n";
        
        if ($p_max) {
            $response .= "📱 **iPhone 15 Pro Max** (Cao cấp):\n- Giá: {$p_max['price']}\n- Đặc điểm nổi bật: {$p_max['specs']}\n- Tình trạng: {$p_max['status']}\n\n";
        }
        if ($p_base) {
            $response .= "📱 **iPhone 15** (Phiên bản tiêu chuẩn):\n- Giá: {$p_base['price']}\n- Đặc điểm nổi bật: {$p_base['specs']}\n- Tình trạng: {$p_base['status']}\n";
        }

        return $response . "\nBạn muốn tôi kiểm tra thêm về các phiên bản khác không?";
    }

    private function getAndroidBudgetAnswer() {
        $p_premium = $this->products['samsung s24 ultra'] ?? null;
        $p_budget = $this->products['oppo reno8'] ?? null;

        $response = "Tùy vào nhu cầu và ngân sách, tôi đề xuất:\n\n";

        if ($p_premium) {
            $response .= "🤖 **Cao cấp (Samsung S24 Ultra)**:\n- Giá: {$p_premium['price']}\n- Đặc điểm: {$p_premium['specs']}\n\n";
        }

        if ($p_budget) {
            $response .= "🤖 **Giá tốt (Oppo Reno8)**:\n- Giá: {$p_budget['price']}\n- Đặc điểm: {$p_budget['specs']}\n";
        }

        return $response . "\nBạn muốn biết chi tiết giá hoặc cấu hình của máy nào?";
    }


    private function processMessage($message)
    {
        // 1. Logic Chào hỏi chung & Tư vấn tổng quát
        if (strpos($message, 'chào') !== false || strpos($message, 'alo') !== false || strpos($message, 'tư vấn') !== false || strpos($message, 'hỗ trợ') !== false) {
            return "Chào bạn, tôi là trợ lý AI của Phone Shop. Bạn cần tư vấn về **giá**, **cấu hình** sản phẩm, hay **chính sách** của cửa hàng?";
        }
        
        // 2. Logic Xử lý Quick Replies và các câu hỏi mẫu
        
        // Trả lời cho Quick Reply: iPhone mới nhất là gì?
        if (strpos($message, 'iphone mới nhất') !== false) {
             return $this->getIphoneNewestAnswer();
        }

        // Trả lời cho Quick Reply: Điện thoại Android nào tốt?
        if (strpos($message, 'android nào tốt') !== false) {
             return $this->getAndroidBudgetAnswer();
        }
        
        // Câu hỏi mẫu: iphone 15 giá bao nhiêu / samsung giá bao nhiêu
        if (strpos($message, 'giá bao nhiêu') !== false) {
            foreach ($this->products as $keyword => $data) {
                if (strpos($message, $keyword) !== false) {
                    return "Giá niêm yết của **{$keyword}** là **{$data['price']}**. Tình trạng: {$data['status']}.";
                }
            }
        }
        
        // Câu hỏi mẫu: iphone 15 sài có bền không
        if (strpos($message, 'bền không') !== false || strpos($message, 'bền không') !== false) {
            foreach ($this->products as $keyword => $data) {
                if (strpos($message, $keyword) !== false) {
                    return "Về độ bền của **{$keyword}**: {$data['durability']}";
                }
            }
        }


        // 3. Logic Tra cứu Sản phẩm Tên Sản phẩm (TRẢ LỜI TỔNG HỢP)
        foreach ($this->products as $keyword => $data) {
            if (strpos($message, $keyword) !== false) {
                
                // --- TRẢ LỜI TỔNG HỢP (Chỉ cần gõ tên sản phẩm) ---
                return "Thông tin tổng hợp về **{$keyword}**:\n"
                     . "- **Giá**: {$data['price']}\n"
                     . "- **Cấu hình**: {$data['specs']}\n"
                     . "- **Tình trạng**: {$data['status']}\n\n"
                     . "Bạn có muốn hỏi thêm về ưu đãi hay trả góp không?";
            }
        }
        
        // 4. Logic Chính sách chung (để không bị trùng với mục 3)
        if (strpos($message, 'bảo hành') !== false || strpos($message, 'thanh toán') !== false || strpos($message, 'trả góp') !== false) {
            return "Chính sách của Phone Shop: Bảo hành 12 tháng chính hãng và hỗ trợ trả góp 0% qua thẻ tín dụng.";
        }

        // 5. Logic Không hiểu (Fallback)
        return "Xin lỗi, tôi chưa hiểu rõ câu hỏi này. Vui lòng hỏi lại về **giá**, **cấu hình**, hoặc **tên sản phẩm** cụ thể (ví dụ: iPhone 15) nhé!";
    }
}
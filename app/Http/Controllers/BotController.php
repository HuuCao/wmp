<?php

namespace App\Http\Controllers;

use App\Models\StockProduct;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function chatBot()
    {
        $stock_product_data = StockProduct::where('is_active', 1)
            ->where('type', 1)
            ->get();
        foreach ($stock_product_data as $stock_product) {
            $expirationDate = strtotime($stock_product['expiration_date']);
            $fiveDaysBeforeExpiration = strtotime('-5 days', $expirationDate);
            $currentDate = strtotime(date('Y-m-d'));
            $currentTime = strtotime(date('H:i'));
            $notificationTime = strtotime(date('Y-m-d') . ' 19:20');

            if ($currentDate >= $fiveDaysBeforeExpiration && $currentDate <= $expirationDate && $currentTime >= $notificationTime) {
                $remainingDays = round(($expirationDate - $currentDate) / (60 * 60 * 24));
                $message = "Sản phẩm có ID " . $stock_product['product_id'] . " sẽ hết hạn sử dụng trong vòng " . $remainingDays . " ngày.";
                $chatID = '-814715937';

                $apiToken = "5751384612:AAF-yfw4fWeWlJV2M23WOnwjVvXV1JgCojE";
                $data = [
                    'chat_id' => $chatID,
                    'text' => $message
                ];
                file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));
            }
        }
    }
}

<?php
/**
 * Module hiển thị kết quả
 */
class ResultRenderer {
    
    /**
     * Hiển thị kết quả thành công
     */
    public static function renderSuccess($num_a, $operation, $num_b, $result) {
        // Format số để hiển thị đẹp hơn
        $formatted_result = is_float($result) && floor($result) != $result 
            ? number_format($result, 2, '.', ',') 
            : number_format($result, 0, '.', ',');
        
        $formatted_a = is_float($num_a) && floor($num_a) != $num_a 
            ? number_format($num_a, 2, '.', ',') 
            : number_format($num_a, 0, '.', ',');
            
        $formatted_b = is_float($num_b) && floor($num_b) != $num_b 
            ? number_format($num_b, 2, '.', ',') 
            : number_format($num_b, 0, '.', ',');
            
        return sprintf(
            '<span class="success">%s %s %s = %s</span>',
            $formatted_a,
            $operation,
            $formatted_b,
            $formatted_result
        );
    }
    
    /**
     * Hiển thị thông báo lỗi
     */
    public static function renderError($error) {
        return '<span class="error">' . htmlspecialchars($error) . '</span>';
    }
    
    /**
     * Hiển thị trạng thái mặc định
     */
    public static function renderDefault() {
        return 'Chưa có kết quả';
    }
    
    /**
     * Hiển thị kết quả dựa trên dữ liệu
     */
    public static function renderResult($result_data) {
        if (isset($result_data['error'])) {
            return self::renderError($result_data['error']);
        } elseif (isset($result_data['success'])) {
            return $result_data['success'];
        } else {
            return self::renderDefault();
        }
    }
    
    /**
     * Tạo thông báo kết quả chi tiết
     */
    public static function createDetailedResult($num_a, $operation, $num_b, $result, $operation_name) {
        $formatted_result = self::renderSuccess($num_a, $operation, $num_b, $result);
        return [
            'success' => $formatted_result,
            'operation_name' => $operation_name,
            'raw_result' => $result
        ];
    }
}
?>

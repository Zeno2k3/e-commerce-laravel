<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoucherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization sẽ được xử lý bởi middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $voucherId = $this->route('voucher')?->voucher_id ?? $this->route('voucher');

        return [
            'voucher_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('voucher', 'voucher_code')->ignore($voucherId, 'voucher_id'),
            ],
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'max_discount_value' => 'nullable|numeric|min:0',
            'usage_conditions' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'voucher_code.required' => 'Mã voucher là bắt buộc.',
            'voucher_code.unique' => 'Mã voucher đã tồn tại.',
            'voucher_code.max' => 'Mã voucher không được vượt quá 50 ký tự.',
            'quantity.required' => 'Số lượng là bắt buộc.',
            'quantity.min' => 'Số lượng không được nhỏ hơn 0.',
            'discount_percentage.required' => 'Phần trăm giảm giá là bắt buộc.',
            'discount_percentage.min' => 'Phần trăm giảm giá không được nhỏ hơn 0.',
            'discount_percentage.max' => 'Phần trăm giảm giá không được vượt quá 100.',
            'max_discount_value.min' => 'Giá trị giảm tối đa không được nhỏ hơn 0.',
            'start_date.required' => 'Ngày bắt đầu là bắt buộc.',
            'end_date.required' => 'Ngày kết thúc là bắt buộc.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
        ];
    }
}

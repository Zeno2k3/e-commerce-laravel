@extends('client.layouts.app')

@section('content')
<script src="//unpkg.com/alpinejs" defer></script>

{{-- Khai báo x-data ở div ngoài cùng để quản lý toàn bộ trạng thái của trang --}}
<div class="bg-[#f9fafb] min-h-screen font-sans pb-20 pt-10"
     x-data="{
         shippingMethod: 'standard',
         paymentMethod: 'card'
     }">

    <div class="container mx-auto px-4 max-w-6xl">

        {{-- Form UI (Không cần action backend) --}}
        <form action="" class="grid grid-cols-1 lg:grid-cols-12 gap-8" onsubmit="event.preventDefault(); alert('Giao diện đã sẵn sàng! (Chưa xử lý Backend)');">

            {{-- ==================== CỘT TRÁI (8 PHẦN) ==================== --}}
            <div class="lg:col-span-8 space-y-8">

                {{-- 1. THÔNG TIN GIAO HÀNG --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                        <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-[#7d3cff]">
                            <i class="fa-regular fa-id-card text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900">Thông tin giao hàng</h2>
                    </div>

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Họ và tên <span class="text-red-500">*</span></label>
                                <input type="text" placeholder="Nguyễn Văn A" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] focus:bg-white outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Số điện thoại <span class="text-red-500">*</span></label>
                                <input type="text" placeholder="0909 123 456" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] focus:bg-white outline-none transition-all">
                            </div>
                        </div>
                        <div>

                            <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Địa chỉ nhận hàng <span class="text-red-500">*</span></label>
                            <input type="text" placeholder="Số nhà, tên đường..." class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] focus:bg-white outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Email (Để nhận thông báo)</label>
                            <input type="email" name="email" placeholder="customer@example.com" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] focus:bg-white outline-none transition-all">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-gray-500 font-medium mb-1 text-xs">Tỉnh / Thành phố</label>
                                <select class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] outline-none cursor-pointer">
                                    <option>Hồ Chí Minh</option>
                                    <option>Hà Nội</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-gray-500 font-medium mb-1 text-xs">Phường / Xã</label>
                                <select class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] outline-none cursor-pointer">
                                    <option>Phường Bến Nghé</option>
                                    <option>Phường Đa Kao</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. PHƯƠNG THỨC VẬN CHUYỂN (Chuyển đổi UI bằng Alpine) --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-[#7d3cff]">
                            <i class="fa-solid fa-truck-fast text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900">Phương thức vận chuyển</h2>
                    </div>

                    <div class="space-y-4">
                        {{-- Option Standard --}}
                        <label class="relative flex items-center justify-between p-4 border rounded-xl cursor-pointer transition-all hover:border-gray-400"
                               :class="shippingMethod === 'standard' ? 'border-[#7d3cff] bg-purple-50/10' : 'border-gray-200'">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="shipping" value="standard" x-model="shippingMethod" class="appearance-none w-6 h-6 border-2 border-gray-300 rounded-full checked:bg-[#7d3cff] checked:border-[#7d3cff] cursor-pointer transition-all">
                                <div>
                                    <span class="block text-lg font-bold text-gray-900">Giao hàng tiêu chuẩn</span>
                                    <span class="block text-sm text-gray-500 mt-0.5">5-7 ngày làm việc</span>
                                </div>
                            </div>
                            <span class="text-lg font-bold text-gray-900">30.000₫</span>
                        </label>

                        {{-- Option Fast --}}
                        <label class="relative flex items-center justify-between p-4 border rounded-xl cursor-pointer transition-all hover:border-gray-400"
                               :class="shippingMethod === 'fast' ? 'border-[#7d3cff] bg-purple-50/10' : 'border-gray-200'">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="shipping" value="fast" x-model="shippingMethod" class="appearance-none w-6 h-6 border-2 border-gray-300 rounded-full checked:bg-[#7d3cff] checked:border-[#7d3cff] cursor-pointer transition-all">
                                <div>
                                    <span class="block text-lg font-bold text-gray-900">Giao hàng nhanh</span>
                                    <span class="block text-sm text-gray-500 mt-0.5">2-3 ngày làm việc</span>
                                </div>
                            </div>
                            <span class="text-lg font-bold text-gray-900">50.000₫</span>
                        </label>
                    </div>
                </div>

                {{-- 3. PHƯƠNG THỨC THANH TOÁN (Logic ẩn hiện form) --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-[#7d3cff]">
                            <i class="fa-regular fa-credit-card text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900">Phương thức thanh toán</h2>
                    </div>

                    <div class="space-y-4">
                        {{-- Radio Card --}}
                        <label class="flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:border-gray-400"
                               :class="paymentMethod === 'card' ? 'border-[#7d3cff] bg-purple-50/10' : 'border-gray-200'">
                            <input type="radio" name="payment" value="card" x-model="paymentMethod" class="appearance-none w-6 h-6 border-2 border-gray-300 rounded-full checked:bg-[#7d3cff] checked:border-[#7d3cff] cursor-pointer transition-all mr-4">
                            <span class="text-lg font-medium text-gray-900">Thẻ tín dụng/ghi nợ</span>
                        </label>

                        {{-- Radio Momo --}}
                        <label class="flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:border-gray-400"
                               :class="paymentMethod === 'momo' ? 'border-[#7d3cff] bg-purple-50/10' : 'border-gray-200'">
                            <input type="radio" name="payment" value="momo" x-model="paymentMethod" class="appearance-none w-6 h-6 border-2 border-gray-300 rounded-full checked:bg-[#7d3cff] checked:border-[#7d3cff] cursor-pointer transition-all mr-4">
                            <span class="text-lg font-medium text-gray-900">Ví MoMo</span>
                        </label>

                        {{-- Radio COD --}}
                        <label class="flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:border-gray-400"
                               :class="paymentMethod === 'cod' ? 'border-[#7d3cff] bg-purple-50/10' : 'border-gray-200'">
                            <input type="radio" name="payment" value="cod" x-model="paymentMethod" class="appearance-none w-6 h-6 border-2 border-gray-300 rounded-full checked:bg-[#7d3cff] checked:border-[#7d3cff] cursor-pointer transition-all mr-4">
                            <span class="text-lg font-medium text-gray-900">Thanh toán khi nhận hàng (COD)</span>
                        </label>

                        {{-- === LOGIC HIỂN THỊ NỘI DUNG CON === --}}

                        {{-- 1. Form nhập thẻ (Chỉ hiện khi paymentMethod == 'card') --}}
                        <div x-show="paymentMethod === 'card'" x-transition.opacity.duration.300ms class="pt-6 space-y-4 border-t border-gray-100 mt-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">Số thẻ*</label>
                                <input type="text" placeholder="1234 5678 9012 1234" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] outline-none">
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-700">Ngày hết hạn*</label>
                                    <input type="text" placeholder="MM/YY" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] outline-none">
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-700">CVV*</label>
                                    <input type="text" placeholder="123" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] outline-none">
                                </div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">Tên trên thẻ *</label>
                                <input type="text" name="card_holder" placeholder="NGUYEN VAN A" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] outline-none">
                            </div>
                        </div>

                        {{-- 2. Mã QR (Chỉ hiện khi paymentMethod == 'momo') --}}
                        <div x-show="paymentMethod === 'momo'" x-transition.opacity.duration.300ms class="pt-6 flex flex-col items-center justify-center border-t border-gray-100 mt-4">
                            <div class="w-48 h-48 bg-white border-2 border-gray-800 flex items-center justify-center mb-4 shadow-sm">
                                <span class="text-xl font-bold text-gray-900">QR CODE</span>
                            </div>
                            <p class="text-gray-500">Quét mã để thanh toán</p>
                        </div>

                         {{-- 3. Thông báo COD (Chỉ hiện khi paymentMethod == 'cod') --}}
                        <div x-show="paymentMethod === 'cod'" x-transition.opacity.duration.300ms class="pt-6 text-center border-t border-gray-100 mt-4">
                            <p class="text-gray-600 italic">Bạn sẽ thanh toán tiền mặt cho shipper khi nhận được hàng.</p>
                        </div>

                    </div>
                </div>

                 {{-- Nút Quay lại --}}
                 <div>
                    <a href="{{ route('client.carts.index') }}" class="text-gray-500 font-bold hover:text-gray-900 flex items-center gap-2 transition-colors w-fit">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại giỏ hàng
                    </a>
                 </div>

            </div>

            {{-- ==================== CỘT PHẢI (4 PHẦN) ==================== --}}
            <div class="lg:col-span-4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h3 class="text-xl font-extrabold text-gray-900 mb-6">Tóm tắt đơn hàng</h3>

                    <div class="space-y-4 mb-6">
                        <div class="flex gap-4">
                            <div class="w-16 h-16 rounded-lg border border-gray-100 overflow-hidden relative shrink-0">
                                <img src="https://placehold.co/100x100?text=Ao+Jean" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800 text-sm line-clamp-2">Áo Khoác Jean The Original</h4>
                                <p class="text-gray-500 text-xs mt-1">Size: S - Màu: Đen</p>
                                <div class="mt-1 font-bold text-gray-900 text-sm">1.000.000₫</div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200 my-4">

                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Tạm tính</span>
                            <span class="font-bold text-gray-900">1.000.000₫</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Phí vận chuyển</span>
                            {{-- Logic hiển thị giá ship dựa trên lựa chọn bên trái --}}
                            <span class="font-bold text-gray-900" x-text="shippingMethod === 'standard' ? '30.000₫' : '50.000₫'"></span>
                        </div>
                        <div class="flex justify-between items-center text-[#7d3cff]">
                            <span>Giảm giá</span>
                            <span class="font-bold">-0₫</span>
                        </div>
                    </div>

                    <hr class="border-gray-200 my-4">

                    <div class="flex justify-between items-center mb-6">
                        <span class="font-extrabold text-gray-900 text-lg">Tổng cộng</span>
                        <span class="text-2xl font-black text-gray-900" x-text="shippingMethod === 'standard' ? '1.030.000₫' : '1.050.000₫'"></span>
                    </div>

                    <a href="{{ route('client.carts.success') }}"
                        class="block text-center w-full bg-[#8b5cf6] hover:bg-[#7c3aed] text-white font-bold text-lg py-4 rounded-xl shadow-lg shadow-purple-200 transition-all active:scale-95 flex items-center justify-center gap-2">
                            <span>Hoàn tất đơn hàng</span>
                            <i class="fa-solid fa-arrow-right"></i>
                    </a>


                </div>
            </div>

        </form>
    </div>
</div>
@endsection

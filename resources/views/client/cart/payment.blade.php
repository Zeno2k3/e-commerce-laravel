@extends('client.layouts.app')

@section('content')
<script src="//unpkg.com/alpinejs" defer></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('checkoutForm', (initialSubtotal, processUrl) => ({
            shippingMethod: 'standard',
            paymentMethod: 'card',
            voucherCode: '',
            discount: 0,
            subtotal: initialSubtotal,
            
            // Form Data
            form: {
                name: '',
                phone: '',
                address: '',
                email: '',
                province: '',
                district: '',
                ward: '',
                note: ''
            },
            
            // Validation State
            errors: {},
            isSubmitting: false,

            // Address Logic Vars
            provinces: [],
            districts: [],
            wards: [],
            selectedProvince: '',
            selectedDistrict: '',
            selectedWard: '',

            get total() {
                let ship = this.shippingMethod === 'standard' ? 30000 : 50000;
                return this.subtotal + ship - this.discount;
            },
            
            validate() {
                this.errors = {};
                if (!this.form.name) this.errors.name = 'Vui lòng nhập họ tên.';
                if (!this.form.phone) this.errors.phone = 'Vui lòng nhập số điện thoại.';
                if (!this.form.address) this.errors.address = 'Vui lòng nhập địa chỉ.';
                if (!this.selectedProvince) this.errors.province = 'Vui lòng chọn Tỉnh/Thành phố.';
                if (!this.selectedDistrict) this.errors.district = 'Vui lòng chọn Quận/Huyện.';
                if (!this.selectedWard) this.errors.ward = 'Vui lòng chọn Phường/Xã.';
                
                return Object.keys(this.errors).length === 0;
            },

            get isValid() {
                return this.form.name && this.form.phone && this.form.address && 
                       this.selectedProvince && this.selectedDistrict && this.selectedWard;
            },

            submitOrder() {
                if (!this.validate()) return;
                
                this.isSubmitting = true;
                
                // Prepare FormData instead of JSON to ensure session cookies work properly
                const formData = new FormData();
                
                // Add form fields
                formData.append('name', this.form.name);
                formData.append('phone', this.form.phone);
                formData.append('address', this.form.address);
                formData.append('email', this.form.email);
                formData.append('province', this.provinces.find(p => p.code == this.selectedProvince)?.name || '');
                formData.append('district', this.districts.find(d => d.code == this.selectedDistrict)?.name || '');
                formData.append('ward', this.wards.find(w => w.code == this.selectedWard)?.name || '');
                formData.append('payment_method', this.paymentMethod);
                formData.append('shipping_method', this.shippingMethod);
                
                if (this.voucherCode) {
                    formData.append('voucher_code', this.voucherCode);
                }
                
                if (this.form.note) {
                    formData.append('note', this.form.note);
                }
                
                // Add CSRF token
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                fetch(processUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin', // Ensure cookies are sent
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    this.isSubmitting = false;
                    if (data.status === 'success') {
                        window.location.href = data.redirect_url;
                    } else {
                        alert(data.message || 'Có lỗi xảy ra!');
                    }
                })
                .catch(err => {
                    this.isSubmitting = false;
                    console.error('Checkout error:', err);
                    alert('Lỗi kết nối đến máy chủ!');
                });
            },
            
            init() {
               fetch('https://provinces.open-api.vn/api/?depth=1')
                   .then(response => response.json())
                   .then(data => this.provinces = data)
                   .catch(error => console.error('Error loading provinces:', error));
            },

            getDistricts() {
               if (!this.selectedProvince) {
                   this.districts = [];
                   this.wards = [];
                   this.selectedDistrict = '';
                   this.selectedWard = '';
                   return;
               }
               fetch(`https://provinces.open-api.vn/api/p/${this.selectedProvince}?depth=2`)
                   .then(response => response.json())
                   .then(data => {
                       this.districts = data.districts;
                       this.wards = [];
                       this.selectedDistrict = '';
                       this.selectedWard = '';
                   });
            },

            getWards() {
               if (!this.selectedDistrict) {
                   this.wards = [];
                   this.selectedWard = '';
                   return;
               }
               fetch(`https://provinces.open-api.vn/api/d/${this.selectedDistrict}?depth=2`)
                   .then(response => response.json())
                   .then(data => {
                       this.wards = data.wards;
                       this.selectedWard = '';
                   });
            }
        }));
    });
</script>

{{-- KHAI BÁO DỮ LIỆU TÍNH TOÁN --}}
<div class="bg-[#f9fafb] min-h-screen font-sans pb-20 pt-10"
     x-data="checkoutForm({{ $subtotal }}, '{{ route('client.checkout.process') }}')">

    <div class="container mx-auto px-4 max-w-6xl">

        <form @submit.prevent="submitOrder()" class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- ==================== CỘT TRÁI (GIỮ NGUYÊN) ==================== --}}
                <div class="lg:col-span-8 space-y-8">

                    {{-- 1. THÔNG TIN GIAO HÀNG --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        {{-- Header... --}}
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
                                    <input type="text" x-model="form.name" placeholder="Nguyễn Văn A" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] focus:bg-white outline-none transition-all" :class="{'border-red-500': errors.name}">
                                    <p x-show="errors.name" x-text="errors.name" class="text-red-500 text-xs mt-1"></p>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Số điện thoại <span class="text-red-500">*</span></label>
                                    <input type="text" x-model="form.phone" placeholder="0909 123 456" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] focus:bg-white outline-none transition-all" :class="{'border-red-500': errors.phone}">
                                    <p x-show="errors.phone" x-text="errors.phone" class="text-red-500 text-xs mt-1"></p>
                                </div>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Địa chỉ nhận hàng <span class="text-red-500">*</span></label>
                                <input type="text" x-model="form.address" placeholder="Số nhà, tên đường..." class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] focus:bg-white outline-none transition-all" :class="{'border-red-500': errors.address}">
                                <p x-show="errors.address" x-text="errors.address" class="text-red-500 text-xs mt-1"></p>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Email (Để nhận thông báo)</label>
                                <input type="email" x-model="form.email" placeholder="customer@example.com" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] focus:bg-white outline-none transition-all" :class="{'border-red-500': errors.address}">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                {{-- Tỉnh / Thành phố --}}
                                <div x-data="{ open: false, search: '' }" class="relative" @click.outside="open = false">
                                    <label class="block text-gray-500 font-medium mb-1 text-xs">Tỉnh / Thành phố</label>
                                    <button type="button" 
                                            @click="open = !open; if(open) $nextTick(() => $refs.searchProvince.focus())"
                                            class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 flex items-center justify-between outline-none focus:ring-2 focus:ring-[#7d3cff] transition-all"
                                            :class="{'border-red-500': errors.province}">
                                        <span class="truncate" x-text="provinces.find(p => p.code == selectedProvince)?.name || 'Chọn Tỉnh / Thành phố'"></span>
                                        <i class="fa-solid fa-chevron-down text-gray-500 text-sm"></i>
                                    </button>
                                    
                                    <div x-show="open" 
                                         x-transition.opacity.duration.200ms
                                         class="absolute top-full left-0 w-full bg-white border border-gray-100 shadow-xl rounded-xl mt-2 z-50 max-h-60 overflow-y-auto overflow-x-hidden">
                                        <div class="p-2 sticky top-0 bg-white border-b border-gray-50">
                                            <input x-ref="searchProvince" x-model="search" type="text" placeholder="Tìm kiếm..." class="w-full px-3 py-2 bg-gray-50 rounded-lg text-sm outline-none focus:ring-1 focus:ring-purple-500">
                                        </div>
                                        <template x-for="province in provinces.filter(p => !search || p.name.toLowerCase().includes(search.toLowerCase()))" :key="province.code">
                                            <div @click="selectedProvince = province.code; getDistricts(); open = false; search = ''" 
                                                 class="px-4 py-3 hover:bg-purple-50 cursor-pointer text-sm transition-colors border-b border-gray-50 last:border-0"
                                                 :class="{'font-bold text-purple-600 bg-purple-50': selectedProvince == province.code}">
                                                <span x-text="province.name"></span>
                                            </div>
                                        </template>
                                        <div x-show="provinces.filter(p => !search || p.name.toLowerCase().includes(search.toLowerCase())).length === 0" class="px-4 py-3 text-sm text-gray-400 text-center">
                                            Không tìm thấy
                                        </div>
                                    </div>
                                    <p x-show="errors.province" x-text="errors.province" class="text-red-500 text-xs mt-1"></p>
                                </div>

                                {{-- Quận / Huyện --}}
                                <div x-data="{ open: false, search: '' }" class="relative" @click.outside="open = false">
                                    <label class="block text-gray-500 font-medium mb-1 text-xs">Quận / Huyện</label>
                                    <button type="button" 
                                            @click="if(selectedProvince) { open = !open; if(open) $nextTick(() => $refs.searchDistrict.focus()) }"
                                            class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 flex items-center justify-between outline-none focus:ring-2 focus:ring-[#7d3cff] transition-all disabled:bg-gray-50 disabled:cursor-not-allowed"
                                            :class="{'border-red-500': errors.district}"
                                            :disabled="!selectedProvince">
                                        <span class="truncate" x-text="districts.find(d => d.code == selectedDistrict)?.name || 'Chọn Quận / Huyện'"></span>
                                        <i class="fa-solid fa-chevron-down text-gray-500 text-sm"></i>
                                    </button>

                                    <div x-show="open" 
                                         x-transition.opacity.duration.200ms
                                         class="absolute top-full left-0 w-full bg-white border border-gray-100 shadow-xl rounded-xl mt-2 z-50 max-h-60 overflow-y-auto overflow-x-hidden">
                                        <div class="p-2 sticky top-0 bg-white border-b border-gray-50">
                                            <input x-ref="searchDistrict" x-model="search" type="text" placeholder="Tìm kiếm..." class="w-full px-3 py-2 bg-gray-50 rounded-lg text-sm outline-none focus:ring-1 focus:ring-purple-500">
                                        </div>
                                        <template x-for="district in districts.filter(d => !search || d.name.toLowerCase().includes(search.toLowerCase()))" :key="district.code">
                                            <div @click="selectedDistrict = district.code; getWards(); open = false; search = ''" 
                                                 class="px-4 py-3 hover:bg-purple-50 cursor-pointer text-sm transition-colors border-b border-gray-50 last:border-0"
                                                 :class="{'font-bold text-purple-600 bg-purple-50': selectedDistrict == district.code}">
                                                <span x-text="district.name"></span>
                                            </div>
                                        </template>
                                         <div x-show="districts.filter(d => !search || d.name.toLowerCase().includes(search.toLowerCase())).length === 0" class="px-4 py-3 text-sm text-gray-400 text-center">
                                            Không tìm thấy
                                        </div>
                                    </div>
                                    <p x-show="errors.district" x-text="errors.district" class="text-red-500 text-xs mt-1"></p>
                                </div>

                                {{-- Phường / Xã --}}
                                <div x-data="{ open: false, search: '' }" class="relative" @click.outside="open = false">
                                    <label class="block text-gray-500 font-medium mb-1 text-xs">Phường / Xã</label>
                                    <button type="button" 
                                            @click="if(selectedDistrict) { open = !open; if(open) $nextTick(() => $refs.searchWard.focus()) }"
                                            class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 flex items-center justify-between outline-none focus:ring-2 focus:ring-[#7d3cff] transition-all disabled:bg-gray-50 disabled:cursor-not-allowed"
                                            :class="{'border-red-500': errors.ward}"
                                            :disabled="!selectedDistrict">
                                        <span class="truncate" x-text="wards.find(w => w.code == selectedWard)?.name || 'Chọn Phường / Xã'"></span>
                                        <i class="fa-solid fa-chevron-down text-gray-500 text-sm"></i>
                                    </button>

                                    <div x-show="open" 
                                         x-transition.opacity.duration.200ms
                                         class="absolute top-full left-0 w-full bg-white border border-gray-100 shadow-xl rounded-xl mt-2 z-50 max-h-60 overflow-y-auto overflow-x-hidden">
                                         <div class="p-2 sticky top-0 bg-white border-b border-gray-50">
                                            <input x-ref="searchWard" x-model="search" type="text" placeholder="Tìm kiếm..." class="w-full px-3 py-2 bg-gray-50 rounded-lg text-sm outline-none focus:ring-1 focus:ring-purple-500">
                                        </div>
                                        <template x-for="ward in wards.filter(w => !search || w.name.toLowerCase().includes(search.toLowerCase()))" :key="ward.code">
                                            <div @click="selectedWard = ward.code; open = false; search = ''" 
                                                 class="px-4 py-3 hover:bg-purple-50 cursor-pointer text-sm transition-colors border-b border-gray-50 last:border-0"
                                                 :class="{'font-bold text-purple-600 bg-purple-50': selectedWard == ward.code}">
                                                <span x-text="ward.name"></span>
                                            </div>
                                        </template>
                                         <div x-show="wards.filter(w => !search || w.name.toLowerCase().includes(search.toLowerCase())).length === 0" class="px-4 py-3 text-sm text-gray-400 text-center">
                                            Không tìm thấy
                                        </div>
                                    </div>
                                    <p x-show="errors.ward" x-text="errors.ward" class="text-red-500 text-xs mt-1"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. PHƯƠNG THỨC VẬN CHUYỂN --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-[#7d3cff]">
                                <i class="fa-solid fa-truck-fast text-xl"></i>
                            </div>
                            <h2 class="text-2xl font-extrabold text-gray-900">Phương thức vận chuyển</h2>
                        </div>

                        <div class="space-y-4">
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

                    {{-- 3. PHƯƠNG THỨC THANH TOÁN --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-[#7d3cff]">
                                <i class="fa-regular fa-credit-card text-xl"></i>
                            </div>
                            <h2 class="text-2xl font-extrabold text-gray-900">Phương thức thanh toán</h2>
                        </div>

                        <div class="space-y-4">
                            <label class="flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:border-gray-400"
                                   :class="paymentMethod === 'card' ? 'border-[#7d3cff] bg-purple-50/10' : 'border-gray-200'">
                                <input type="radio" name="payment" value="card" x-model="paymentMethod" class="appearance-none w-6 h-6 border-2 border-gray-300 rounded-full checked:bg-[#7d3cff] checked:border-[#7d3cff] cursor-pointer transition-all mr-4">
                                <span class="text-lg font-medium text-gray-900">Thẻ tín dụng/ghi nợ</span>
                            </label>

                            <label class="flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:border-gray-400"
                                   :class="paymentMethod === 'momo' ? 'border-[#7d3cff] bg-purple-50/10' : 'border-gray-200'">
                                <input type="radio" name="payment" value="momo" x-model="paymentMethod" class="appearance-none w-6 h-6 border-2 border-gray-300 rounded-full checked:bg-[#7d3cff] checked:border-[#7d3cff] cursor-pointer transition-all mr-4">
                                <span class="text-lg font-medium text-gray-900">Ví MoMo</span>
                            </label>

                            <label class="flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:border-gray-400"
                                   :class="paymentMethod === 'cod' ? 'border-[#7d3cff] bg-purple-50/10' : 'border-gray-200'">
                                <input type="radio" name="payment" value="cod" x-model="paymentMethod" class="appearance-none w-6 h-6 border-2 border-gray-300 rounded-full checked:bg-[#7d3cff] checked:border-[#7d3cff] cursor-pointer transition-all mr-4">
                                <span class="text-lg font-medium text-gray-900">Thanh toán khi nhận hàng (COD)</span>
                            </label>
                            
                            <div x-show="paymentMethod === 'card'" class="pt-6 space-y-4 border-t border-gray-100 mt-4">
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-700">Tên chủ thẻ*</label>
                                    <input type="text" placeholder="NGUYEN VAN A" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] outline-none">
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-700">Số thẻ*</label>
                                    <input type="text" placeholder="1234 5678 9012 1234" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] outline-none">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block mb-2 text-sm font-semibold text-gray-700">Ngày hết hạn (MM/YY)*</label>
                                        <input type="text" placeholder="12/25" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] outline-none">
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm font-semibold text-gray-700">CVV*</label>
                                        <input type="text" placeholder="123" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] outline-none">
                                    </div>
                                </div>
                            </div>
                            <div x-show="paymentMethod === 'momo'" class="pt-6 flex flex-col items-center justify-center border-t border-gray-100 mt-4">
                                 <p class="text-gray-500">Quét mã để thanh toán</p>
                            </div>
                            <div x-show="paymentMethod === 'cod'" class="pt-6 text-center border-t border-gray-100 mt-4">
                                <p class="text-gray-600 italic">Bạn sẽ thanh toán tiền mặt cho shipper khi nhận được hàng.</p>
                            </div>
                        </div>
                    </div>

                     {{-- Nút Quay lại --}}
                     <div>
                        <a href="{{ route('client.cart.index') }}" class="text-gray-500 font-bold hover:text-gray-900 flex items-center gap-2 transition-colors w-fit">
                            <i class="fa-solid fa-arrow-left"></i> Quay lại giỏ hàng
                        </a>
                     </div>
                </div>

                {{-- ==================== CỘT PHẢI ==================== --}}
                 <div class="lg:col-span-4">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                         {{-- ... Tóm tắt đơn hàng ... --}}
                         <h3 class="text-xl font-extrabold text-gray-900 mb-6">Tóm tắt đơn hàng</h3>

                        {{-- Sản phẩm --}}
                         <div class="space-y-4 mb-6">
                            @foreach($cart->cartItem as $item)
                            <div class="flex gap-4">
                                {{-- Image --}}
                                 <div class="w-16 h-16 rounded-lg border border-gray-100 overflow-hidden relative shrink-0">
                                    @php
                                        $imageUrl = 'https://placehold.co/100x100?text=No+Image';
                                        if ($item->variant && $item->variant->url_image) {
                                            $imageUrl = asset($item->variant->url_image);
                                        } elseif ($item->product && $item->product->variants->first() && $item->product->variants->first()->url_image) {
                                            $imageUrl = asset($item->product->variants->first()->url_image);
                                        }
                                    @endphp
                                    <img src="{{ $imageUrl }}" class="w-full h-full object-cover">
                                </div>
                                {{-- Info --}}
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-800 text-sm line-clamp-2">{{ $item->product->product_name }}</h4>
                                    <p class="text-gray-500 text-xs mt-1">
                                        Size: {{ $item->variant->size ?? 'N/A' }} - 
                                        Màu: {{ $item->variant->color ?? 'N/A' }} 
                                        | SL: {{ $item->quantity }}
                                    </p>
                                    <div class="mt-1 font-bold text-gray-900 text-sm">{{ number_format($item->total_price, 0, ',', '.') }}₫</div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <hr class="border-gray-200 my-4">

                         {{-- Các dòng tính tiền --}}
                        <div class="space-y-3 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Tạm tính</span>
                                <span class="font-bold text-gray-900">{{ number_format($subtotal, 0, ',', '.') }}₫</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Phí vận chuyển</span>
                                <span class="font-bold text-gray-900" x-text="shippingMethod === 'standard' ? '30.000₫' : '50.000₫'"></span>
                            </div>
                            {{-- Voucher --}}
                            <div class="flex justify-between items-center mt-4">
                                 <div class="flex gap-2">
                                    <input type="text"
                                           x-model="voucherCode"
                                           placeholder="Nhập voucher"
                                           class="border border-gray-400 rounded px-3 py-2 w-40 focus:outline-none focus:border-[#8b5cf6] text-sm text-gray-700">

                                    <button type="button"
                                            @click="if(voucherCode.trim()){ discount = 100000 } else { discount = 0 }"
                                            class="bg-[#8b5cf6] hover:bg-[#7c3aed] text-white px-4 py-2 rounded text-sm font-bold shadow-sm transition-colors">
                                        Áp dụng
                                    </button>
                                </div>
                                <span class="font-medium text-gray-900"
                                      x-show="discount > 0"
                                      x-text="'-' + discount.toLocaleString('vi-VN') + 'đ'"
                                      x-transition.opacity>
                                </span>
                            </div>
                        </div>

                        <hr class="border-gray-200 my-4">

                         {{-- TỔNG CỘNG --}}
                        <div class="flex justify-between items-center mb-6">
                            <span class="font-extrabold text-gray-900 text-xl">Tổng cộng</span>
                            <span class="text-2xl font-black text-gray-900" x-text="total.toLocaleString('vi-VN') + 'đ'"></span>
                        </div>

                        <button type="submit"
                            class="block text-center w-full bg-[#8b5cf6] hover:bg-[#7c3aed] disabled:bg-gray-300 disabled:cursor-not-allowed disabled:shadow-none text-white font-bold text-lg py-3 rounded-md shadow-lg shadow-purple-200 transition-all active:scale-95"
                            :disabled="isSubmitting || !isValid">
                                <span x-show="!isSubmitting">Hoàn tất đơn hàng</span>
                                <span x-show="isSubmitting">Đang xử lý...</span>
                        </button>
                    </div>
                </div>

        </form>
    </div>
</div>
@endsection

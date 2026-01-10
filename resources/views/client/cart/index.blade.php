@extends('client.layouts.app')

@section('content')
<script src="//unpkg.com/alpinejs" defer></script>

<div class="bg-white min-h-screen font-sans py-12" x-data="cartManager()">
    <div class="container mx-auto px-4 max-w-7xl">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800">Giỏ hàng của bạn</h1>

            @if($cart && $cart->cartItem->count() > 0)
            <button @click="clearCart()" class="flex items-center gap-2 text-gray-900 hover:text-red-600 font-bold transition-colors bg-white border border-gray-200 px-5 py-2.5 rounded-lg shadow-sm hover:shadow-md">
                <i class="fa-regular fa-trash-can"></i>
                <span>Xóa tất cả</span>
            </button>
            @endif
        </div>

        @if(!$cart || $cart->cartItem->count() == 0)
            {{-- EMPTY CART STATE --}}
            <div class="flex flex-col items-center justify-center py-20">
                <div class="text-gray-300 mb-6">
                    <i class="fa-solid fa-cart-shopping text-9xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Giỏ hàng đang trống</h2>
                <a href="{{ route('client.products.index') }}" class="mt-8 bg-[#7d3cff] hover:bg-[#6c2bd9] text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-all">
                    Khám phá sản phẩm
                </a>
            </div>
        @else
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- LEFT COLUMN: PRODUCT LIST --}}
            <div class="lg:col-span-8 space-y-6">

                @foreach($cart->cartItem as $item)
                <div class="bg-[#eff2f5] rounded-xl p-6 flex flex-col sm:flex-row items-center gap-6 border border-transparent hover:border-gray-200 transition-all"
                     x-data="{ 
                        qty: {{ $item->quantity }}, 
                        itemId: {{ $item->cart_item_id }},
                        price: {{ $item->unit_price }},
                        updating: false,
                        
                        changeQty(delta) {
                            if (this.updating) return;
                            let newQty = this.qty + delta;
                            if (newQty < 1) return;

                            let oldQty = this.qty;
                            this.qty = newQty; // Optimistic update
                            this.updating = true;

                            // Call parent function
                            updateQuantity(this.itemId, newQty)
                                .then(() => { this.updating = false; })
                                .catch(() => { 
                                    this.qty = oldQty; // Revert
                                    this.updating = false;
                                });
                        }
                     }">

                    {{-- Image Logic --}}
                    <div class="w-32 h-32 flex-shrink-0 bg-white rounded-lg overflow-hidden border border-gray-200 p-2 relative">
                        @php
                            // Priority 3: Default Placeholder
                            $imageUrl = 'https://placehold.co/300x300?text=No+Image';

                            // Priority 1: Variant Image
                            if ($item->variant && $item->variant->url_image) {
                                $imageUrl = asset($item->variant->url_image);
                            } 
                            // Priority 2: Product Image (Fallback if no variant image)
                            elseif ($item->product && $item->product->image) {
                                $imageUrl = asset($item->product->image);
                            }
                        @endphp
                        <img src="{{ $imageUrl }}" class="w-full h-full object-contain" alt="Product Image">
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 w-full space-y-2">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-gray-800 text-lg leading-tight pr-4">
                                {{ $item->product->product_name ?? 'Sản phẩm không tồn tại' }}
                            </h3>
                            <button @click="removeItem(itemId)" class="text-gray-400 hover:text-red-500 transition-colors">
                                <i class="fa-regular fa-trash-can text-xl"></i>
                            </button>
                        </div>

                        <div class="text-sm text-gray-500 flex flex-col gap-1">
                            @if($item->variant)
                                <span>Size: <span class="font-semibold text-gray-700">{{ $item->variant->size }}</span></span>
                                <span>Màu: <span class="font-semibold text-gray-700">{{ $item->variant->color }}</span></span>
                            @endif
                        </div>

                        {{-- Item Total Price (Client-side Calc) --}}
                        <div class="pt-2">
                             <span class="text-[#7d3cff] font-extrabold text-xl" x-text="formatPrice(price * qty)"></span>
                        </div>
                    </div>

                    {{-- Quantity Controls --}}
                    <div class="flex items-center gap-3 bg-white rounded-lg p-1 border border-gray-200 shadow-sm">
                        <button @click="changeQty(-1)" 
                                class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-[#7d3cff] hover:bg-purple-50 rounded transition-all active:scale-95 disabled:opacity-50"
                                :disabled="updating || qty <= 1">
                            <i class="fa-solid fa-minus text-xs"></i>
                        </button>
                        
                        <input type="text" x-model="qty" class="w-10 text-center bg-transparent font-bold text-gray-900 border-none focus:ring-0 p-0" readonly>
                        
                        <button @click="changeQty(1)" 
                                class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-[#7d3cff] hover:bg-purple-50 rounded transition-all active:scale-95 disabled:opacity-50"
                                :disabled="updating">
                            <i class="fa-solid fa-plus text-xs"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- RIGHT COLUMN: SUMMARY --}}
            <div class="lg:col-span-4">
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xl shadow-purple-50/50 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-receipt text-[#7d3cff]"></i>
                        Tóm tắt đơn hàng
                    </h2>

                    <div class="space-y-4 mb-6 pb-6 border-b border-gray-100">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-500">Số lượng sản phẩm</span>
                            <span class="font-bold text-gray-900" x-text="totalItems"></span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-500">Tạm tính</span>
                            <span class="font-bold text-gray-900" x-text="formatPrice(subtotal)"></span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-500">Phí vận chuyển</span>
                            <span class="font-bold text-green-600">Miễn phí</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-end mb-8">
                        <span class="text-lg font-bold text-gray-900">Tổng thanh toán</span>
                        <span class="text-2xl font-black text-[#7d3cff]" x-text="formatPrice(subtotal)"></span>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('client.cart.payment') }}" class="w-full block bg-gradient-to-r from-[#7d3cff] to-[#6c2bd9] hover:from-[#6c2bd9] hover:to-[#5b21b6] text-white text-center font-bold py-4 rounded-xl shadow-lg shadow-purple-200 transition-all transform active:scale-[0.98]">
                            Tiến hành thanh toán
                        </a>

                        <a href="{{ route('client.products.index') }}" class="w-full block bg-gray-50 text-gray-600 hover:bg-gray-100 hover:text-gray-900 text-center font-bold py-3 rounded-xl transition-colors">
                            Tiếp tục mua sắm
                        </a>
                    </div>
                </div>
            </div>

        </div>
        @endif
    </div>
</div>

<script>
function cartManager() {
    return {
        subtotal: {{ $subtotal ?? 0 }},
        totalItems: {{ $totalItems ?? 0 }},

        formatPrice(price) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
        },

        // Returns a Promise for logic in the child component
        updateQuantity(itemId, newQty) {
            return new Promise((resolve, reject) => {
                fetch('{{ route("client.cart.updateQuantity") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        cart_item_id: itemId,
                        quantity: newQty
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Update Global State
                        this.subtotal = data.cart_subtotal;
                        this.totalItems = data.total_items;
                        
                        // Update Header
                        let cartHeader = document.getElementById('cart-count');
                        if (cartHeader) cartHeader.innerText = data.total_items;
                        
                        resolve(data);
                    } else {
                        alert(data.message);
                        reject(data.message);
                    }
                })
                .catch(error => {
                    console.error('API Error:', error);
                    alert('Lỗi kết nối!');
                    reject(error);
                });
            });
        },

        removeItem(itemId) {
            if (!confirm('Bạn có chắc muốn xóa sản phẩm này?')) return;

            fetch('{{ route("client.cart.removeItem") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ cart_item_id: itemId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.reload(); // Reload needed to remove DOM element cleanly
                } else {
                    alert(data.message);
                }
            });
        },

        clearCart() {
            if (!confirm('Xóa toàn bộ giỏ hàng?')) return;
            fetch('{{ route("client.cart.clear") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(() => window.location.reload());
        }
    }
}
</script>
@endsection

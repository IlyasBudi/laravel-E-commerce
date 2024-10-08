@extends('front-layouts.app')

@section('title', 'Welcome')

@section('content')
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Fresh and Organic</p>
						<h1>Check Out Product</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- check out section -->
	<section class="wrapper flex flex-col gap-2.5">
        <div class="flex items-center justify-between">
            <p class="text-base font-bold">
                Items
            </p>
            <button type="button" class="p-2 bg-white rounded-full" data-expand="itemsList">
                <img src="{{ asset('assets/svgs/ic-chevron.svg') }}"
                    class="transition-all duration-300 -rotate-180 size-5" alt="">
            </button>
        </div>
        <div class="flex flex-col gap-4" id="itemsList">
            <!-- Softovac Rami -->
            @forelse ($my_carts as $cart)
                <div class="py-3.5 pl-4 pr-[22px] bg-white rounded-2xl flex gap-1 items-center relative">
                    <img src="{{ Storage::url($cart->product->photo) }}"
                        class="w-full max-w-[70px] max-h-[70px] object-contain" alt="">
                    <div class="flex flex-wrap items-center justify-between w-full gap-1">
                        <div class="flex flex-col gap-1">
                            <h3 class="text-base font-semibold whitespace-nowrap w-[150px] truncate">
                                {{ $cart->product->name }}
                            </h3>
                            <p class="text-sm text-grey product-price" data-price="{{ $cart->product->price }}">
                                RP {{ $cart->product->price }}
                            </p>
                        </div>
                        <form action="{{ route('carts.destroy', $cart) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <img src="{{ asset('assets/svgs/ic-trash-can-filled.svg') }}" class="size-[30px]"
                                    alt="">
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p>
                    Belum ada transaksi tersedia.
                </p>
            @endforelse

        </div>
    </section>

    <!-- Details Payment -->
    <section class="wrapper flex flex-col gap-2.5">
        <div class="flex items-center justify-between">
            <p class="text-base font-bold">
                Details Payment
            </p>
            <button type="button" class="p-2 bg-white rounded-full" data-expand="__detailsPayment">
                <img src="{{ asset('assets/svgs/ic-chevron.svg') }}" class="transition-all duration-300 size-5"
                    alt="">
            </button>
        </div>
        <div class="p-6 bg-white rounded-3xl" id="__detailsPayment" style="display: none;">
            <ul class="flex flex-col gap-5">
                <li class="flex items-center justify-between">
                    <p class="text-base font-semibold first:font-normal">
                        Sub Total
                    </p>
                    <p class="text-base font-semibold first:font-normal" id="checkout-sub-total">

                    </p>
                </li>
                <li class="flex items-center justify-between">
                    <p class="text-base font-semibold first:font-normal">
                        PPN 11%
                    </p>
                    <p class="text-base font-semibold first:font-normal" id="checkout-ppn">

                    </p>
                </li>
                <!-- <li class="flex items-center justify-between">
                    <p class="text-base font-semibold first:font-normal">
                        Insurance 23%
                    </p>
                    <p class="text-base font-semibold first:font-normal" id="checkout-insurance">

                    </p>
                </li> -->
                <!-- <li class="flex items-center justify-between">
                    <p class="text-base font-semibold first:font-normal">
                        Delivery Fee
                    </p>
                    <p class="text-base font-semibold first:font-normal" id="checkout-delivery-fee">

                    </p>
                </li> -->
                <li class="flex items-center justify-between">
                    <p class="text-base font-bold first:font-normal">
                        Grand Total
                    </p>
                    <p class="text-base font-bold first:font-normal text-primary" id="checkout-grand-total">

                    </p>
                </li>
            </ul>
        </div>
    </section>

    <!-- Delivery to -->
    <section class="wrapper flex flex-col gap-2.5 pb-20">
        <div class="flex items-center justify-between">
            <p class="text-base font-bold">
                Delivery to
            </p>
            <button type="button" class="p-2 bg-white rounded-full" data-expand="deliveryForm">
                <img src="{{ asset('assets/svgs/ic-chevron.svg') }}"
                    class="transition-all duration-300 -rotate-180 size-5" alt="">
            </button>
        </div>
        <form action="{{ route('product_transactions.store') }}" method="POST" class="p-6 bg-white rounded-3xl"
            id="deliveryForm" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col gap-5">
                <!-- Address -->
                <div class="flex flex-col gap-2.5">
                    <label for="address" class="text-base font-semibold">Address</label>
                    <input style="background-image: url('{{ asset('assets/svgs/ic-location.svg') }}')"
					type="text" name="address" id="address__" class="form-input" value="Tedjamudita 3">
                </div>
                <!-- Phone Number -->
                <div class="flex flex-col gap-2.5">
                    <label for="phonenumber" class="text-base font-semibold">Phone Number</label>
                    <input style="background-image: url('{{ asset('assets/svgs/ic-phone.svg') }}')"
					type="text" name="phone_number" id="phonenumber__" class="form-input" value="602192301923">
                </div>
                <!-- Add. Notes -->
                <div class="flex flex-col gap-2.5">
                    <label for="notes" class="text-base font-semibold">Add. Notes</label>
                    <span class="relative">
                        <img src="{{ asset('assets/svgs/ic-edit.svg') }}" class="absolute size-5 top-4 left-4"
                            alt="">
                        <textarea name="notes" id="notes__" class="form-input !rounded-2xl w-full min-h-[150px]">nearby with local shops that close with the big river next to aftermarket place.</textarea>
                    </span>
                </div>
                
            </div>
    </section>
    <div
        class="relative z-50 bottom-[50px] bg-black rounded-3xl p-5 left-1/2 -translate-x-1/2 w-[calc(100dvw-32px)] max-w-[425px]">
        <section class="flex items-center justify-between gap-5">
            <div>
                <p class="text-sm text-grey mb-0.5">
                    Grand Total
                </p>
                <p class="text-lg min-[350px]:text-2xl font-bold text-white" id="checkout-grand-total-price">

                </p>
            </div>
            <button type="submit"
                class="inline-flex items-center justify-center px-5 py-3 text-base font-bold text-white rounded-full w-max whitespace-nowrap"
				style="background-color: #F28123;">
                Confirm
            </button>
        </section>
    </div>

    </form>
	<!-- end check out section -->
@endsection

@push('after-styles')
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
	<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
	<script src="https://cdn.tailwindcss.com"></script>
@endpush

@push('after-scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('scripts/global.js') }}"></script>
    <script>
        function calculatePrice() {
            let subTotal = 0;
            let deliveryFee = 10000;

            document.querySelectorAll('.product-price').forEach(item => {
                subTotal += parseFloat(item.getAttribute('data-price'));
            });

            // document.getElementById('checkout-delivery-fee').textContent = 'Rp ' + deliveryFee.toLocaleString('id', {
            //     minimumFractionDigits: 2,
            //     maximumFractionDigits: 2
            // });

            document.getElementById('checkout-sub-total').textContent = 'Rp ' + subTotal.toLocaleString('id', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            const tax = 11 * subTotal / 100;
            document.getElementById('checkout-ppn').textContent = 'Rp ' + tax.toLocaleString('id', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            // const insurance = 23 * subTotal / 100;
            // document.getElementById('checkout-insurance').textContent = 'Rp ' + insurance.toLocaleString('id', {
            //     minimumFractionDigits: 2,
            //     maximumFractionDigits: 2
            // });

            const grandTotalPrice = subTotal + tax;
            document.getElementById('checkout-grand-total').textContent = 'Rp ' + grandTotalPrice.toLocaleString('id', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            document.getElementById('checkout-grand-total-price').textContent = 'Rp ' + grandTotalPrice.toLocaleString(
                'id', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 2
                });

        }

        document.addEventListener('DOMContentLoaded', function() {
            calculatePrice();
        });
</script>
<!-- Add the script for validation -->
<script>
        document.getElementById('phonenumber__').addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
@endpush
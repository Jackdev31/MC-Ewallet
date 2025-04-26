@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Product Catalog --}}
        <div class="col-md-8">
            <h4 class="text-center mb-4">ISAT U MC - Product Catalog</h4>
            <div class="mb-3 text-center">
                <h6>Filter by Category:</h6>
                <div class="btn-group flex-wrap" role="group" id="category-filters">
                    <button class="btn btn-outline-primary btn-sm active" data-category="all">All</button>
                    @foreach ($categories as $category)
                        <button class="btn btn-outline-primary btn-sm" data-category="{{ $category->id }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="row" id="product-list">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4 product-card" data-category="{{ $product->product_category_id }}">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}"
                                class="card-img-top" style="object-fit: cover; height: 200px;"
                                onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="text-center">{{ $product->name }}</h5>
                                    <p class="text-center mb-1">₱{{ number_format($product->price, 2) }}</p>
                                    <p class="text-center text-muted">Stock: {{ $product->quantity }}</p>
                                </div>
                                <button class="btn btn-success btn-sm mt-auto add-to-checkout-btn w-100"
                                    data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                    data-price="{{ $product->price }}"
                                    data-image="{{ asset('storage/' . $product->product_image) }}">
                                    + {{-- Add to Checkout --}}
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Checkout Overview --}}
        <div class="col-md-4">
            <h4 class="text-center mb-4">Checkout Overview</h4>
            <div class="card">
                <div class="card-body">
                    <ul id="checkout-list" class="list-group mb-3"></ul>
                    <h5 class="text-center">Item Total: ₱<span id="checkout-total">0.00</span></h5>
                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-outline-success w-50 me-2" id="checkout-btn">Checkout</button>
                        <button class="btn btn-outline-danger w-50" id="cancel-btn">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Receipt Modal --}}
<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Checkout Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="receipt-list" class="list-group mb-3"></ul>
                <h5 class="text-center">Total: ₱<span id="receipt-total">0.00</span></h5>

                <div class="mb-3">
                    <label for="payment-method" class="form-label">Payment Method</label>
                    <select class="form-select" id="payment-method">
                        <option value="Cash" selected>Cash</option>
                        <option value="E-wallet">E-wallet</option>
                    </select>
                </div>

                <div id="cash-input-container" class="mb-3">
                    <label for="cash-paid" class="form-label">Cash Paid</label>
                    <input type="number" class="form-control" id="cash-paid" placeholder="Enter cash amount">
                </div>

                <div id="qr-container" class="text-center mt-3" style="display: none;">
                    <div id="qrcode" class="d-inline-block p-2 border rounded bg-light" style="width: 200px; height: 200px;"></div>
                    <div class="mt-2">
                        <label class="form-label d-block text-center">Scan QR to Pay</label>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary w-100" id="confirm-payment-btn">Confirm Payment</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    let checkoutItems = [];

    // Filtering Category
    document.querySelectorAll('#category-filters button').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('#category-filters button').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const category = this.getAttribute('data-category');

            document.querySelectorAll('.product-card').forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    document.querySelectorAll('.add-to-checkout-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const price = parseFloat(this.dataset.price);
            const image = this.dataset.image;

            const existing = checkoutItems.find(item => item.id == id);
            if (existing) {
                existing.quantity += 1;
            } else {
                checkoutItems.push({ id, name, price, image, quantity: 1 });
            }
            renderCheckout();
        });
    });

    function renderCheckout() {
        const list = document.getElementById('checkout-list');
        list.innerHTML = '';
        let total = 0;

        checkoutItems.forEach((item, index) => {
            total += item.price * item.quantity;
            list.innerHTML += `
                <li class="list-group-item d-flex align-items-center">
                    <img src="${item.image}" alt="${item.name}" style="width:40px;height:40px;object-fit:cover;border-radius:5px;margin-right:10px;">
                    <div class="flex-grow-1">
                        <strong>${item.name}</strong>
                        <div class="input-group input-group-sm mt-1" style="max-width: 120px;">
                            <button class="btn btn-outline-secondary" onclick="updateQty(${index}, -1)">−</button>
                            <input type="text" class="form-control text-center" value="${item.quantity}" readonly>
                            <button class="btn btn-outline-secondary" onclick="updateQty(${index}, 1)">+</button>
                        </div>
                    </div>
                    <span>₱${(item.price * item.quantity).toFixed(2)}</span>
                    <button class="btn btn-danger btn-sm ms-2" onclick="removeItem(${index})"><i class="ti ti-trash"></i></button>
                </li>
            `;
        });

        document.getElementById('checkout-total').innerText = total.toFixed(2);
    }

    function updateQty(index, change) {
        checkoutItems[index].quantity += change;
        if (checkoutItems[index].quantity <= 0) {
            checkoutItems.splice(index, 1);
        }
        renderCheckout();
    }

    function removeItem(index) {
        checkoutItems.splice(index, 1);
        renderCheckout();
    }

    document.getElementById('checkout-btn').addEventListener('click', function() {
        if (checkoutItems.length === 0) {
            alert("No items to checkout.");
            return;
        }
        renderReceipt();
        new bootstrap.Modal(document.getElementById('receiptModal')).show();
    });

    document.getElementById('cancel-btn').addEventListener('click', function() {
        if (confirm('Clear all checkout items?')) {
            checkoutItems = [];
            renderCheckout();
        }
    });

    function renderReceipt() {
        const list = document.getElementById('receipt-list');
        list.innerHTML = '';
        let total = 0;
        checkoutItems.forEach(item => {
            total += item.price * item.quantity;
            list.innerHTML += `<li class="list-group-item d-flex justify-content-between">
                <span>${item.name} × ${item.quantity}</span><span>₱${(item.price * item.quantity).toFixed(2)}</span>
            </li>`;
        });
        document.getElementById('receipt-total').innerText = total.toFixed(2);
    }

    document.getElementById('payment-method').addEventListener('change', generateQRCode);

    function generateQRCode() {
        const method = document.getElementById('payment-method').value;
        const cashInput = document.getElementById('cash-input-container');
        const qrContainer = document.getElementById('qr-container');

        if (method === 'Cash') {
            cashInput.style.display = 'block';
            qrContainer.style.display = 'none';
        } else {
            cashInput.style.display = 'none';
            qrContainer.style.display = 'block';

            const qrDiv = document.getElementById('qrcode');
            qrDiv.innerHTML = '';
            const amount = document.getElementById('receipt-total').innerText;
            const qrText = `pay:${amount}`;
            new QRCode(qrDiv, {
                text: qrText,
                width: 200,
                height: 200,
                correctLevel: QRCode.CorrectLevel.M
            });
        }
    }

    document.getElementById('confirm-payment-btn').addEventListener('click', function() {
        const method = document.getElementById('payment-method').value;
        const total = parseFloat(document.getElementById('receipt-total').innerText);

        if (method === 'Cash') {
            const cashPaid = parseFloat(document.getElementById('cash-paid').value);
            if (isNaN(cashPaid) || cashPaid < total) {
                alert('Insufficient cash paid.');
                return;
            }
            const change = cashPaid - total;

            const productData = checkoutItems.map(item => ({
                product_id: item.id,
                quantity: item.quantity,
                total_price: item.price * item.quantity
            }));

            fetch('{{ route('store.cashier.sales') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    products: productData,
                    total_price: total
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`Payment confirmed! Change: ₱${change.toFixed(2)}`);
                    checkoutItems = [];
                    renderCheckout();
                    bootstrap.Modal.getInstance(document.getElementById('receiptModal')).hide();
                } else {
                    alert('Payment failed. Please try again.');
                }
            });
        } else {
            alert('E-wallet payment initiated. Please confirm manually.');
        }
    });
</script>
@endpush

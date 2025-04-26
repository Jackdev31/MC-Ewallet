@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- Left Side: Product Catalog --}}
            <div class="col-md-8">
                <h4>Product Catalog</h4>

                {{-- Category Filter --}}
                <div class="mb-4">
                    <h6>Filter by Category:</h6>
                    <div class="btn-group flex-wrap" role="group">
                        <button class="btn btn-outline-primary btn-sm active" data-category="all">All</button>
                        @foreach ($categories as $category)
                            <button class="btn btn-outline-primary btn-sm" data-category="{{ $category->id }}">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4 mb-4 product-card" data-category="{{ $product->product_category_id }}">
                            <div class="card h-100 shadow-sm border-light rounded">
                                <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}"
                                    class="card-img-top" style="object-fit: cover; height: 200px; width: 100%;"
                                    onerror="this.onerror=null; this.src='{{ asset('images/default.png') }}';">

                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">₱{{ number_format($product->price, 2) }}</p>
                                        <p class="card-text">Qty: {{ $product->quantity }}</p>
                                    </div>
                                    <button class="btn btn-success btn-sm mt-auto add-to-checkout-btn"
                                        data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                        data-price="{{ $product->price }}"
                                        data-image="{{ asset('storage/' . $product->product_image) }}">
                                        Add to Checkout
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Side: Checkout Overview --}}
            <div class="col-md-4">
                <h4>Checkout Overview</h4>
                <div class="card">
                    <div class="card-body">
                        <ul id="checkout-list" class="list-group mb-3"></ul>
                        <h5>Item Total: ₱<span id="checkout-total">0.00</span></h5>
                        <div class="d-flex justify-content-between mt-3">
                            <button class="btn btn-outline-success" id="checkout-btn">Checkout</button>
                            <button class="btn btn-outline-danger" id="cancel-btn">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let checkoutItems = [];

        document.querySelectorAll('.add-to-checkout-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.id;
                const productName = this.dataset.name;
                const productPrice = parseFloat(this.dataset.price);
                const productImage = this.dataset.image;

                const existingItem = checkoutItems.find(item => item.id === productId);

                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    checkoutItems.push({
                        id: productId,
                        name: productName,
                        price: productPrice,
                        image: productImage,
                        quantity: 1
                    });
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
                    <li class="list-group-item d-flex align-items-center gap-3">
                        <img src="${item.image}" alt="${item.name}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px;">
                        <div class="flex-grow-1">
                            <strong>${item.name}</strong><br>
                            <div class="input-group input-group-sm mt-1" style="width: 120px;">
                                <button class="btn btn-outline-secondary btn-sm" onclick="updateQty(${index}, -1)">−</button>
                                <input type="text" class="form-control text-center" value="${item.quantity}" readonly>
                                <button class="btn btn-outline-secondary btn-sm" onclick="updateQty(${index}, 1)">+</button>
                            </div>
                        </div>
                        <span class="text-end fw-bold">₱${(item.price * item.quantity).toFixed(2)}</span>
                        <button class="btn btn-danger btn-sm ms-2" onclick="removeItem(${index})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
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
                alert("Your checkout list is empty!");
                return;
            }

            // Replace this with AJAX request if needed
            console.log("Submitting checkout:", checkoutItems);
            alert("Checkout logic goes here.");
        });

        document.getElementById('cancel-btn').addEventListener('click', function() {
            checkoutItems = [];
            renderCheckout();
        });

        // Category Filter Logic
        document.querySelectorAll('.btn[data-category]').forEach(btn => {
            btn.addEventListener('click', function() {
                const selected = this.dataset.category;

                // Toggle active class on buttons
                document.querySelectorAll('.btn[data-category]').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                // Show/hide product cards
                document.querySelectorAll('.product-card').forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    if (selected === 'all' || selected === cardCategory) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endpush

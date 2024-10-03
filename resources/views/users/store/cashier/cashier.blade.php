<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- CSS Style --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Google font --}}
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@400;700&display=swap" rel="stylesheet">

    {{-- Java Script for Graph --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="main-bg" style="background-color: #FFFCF2">
    <div id="app">
        <main class="py-4">

            <a href="{{ route('store.home') }}" class="fw-bold text-decoration-none main-text btn border-0">
                <div class="h2 fw-semibold">
                    <i class="fa-solid fa-caret-left"></i>
                    <div class="d-inline main-text">Back</div>
                </div>
            </a>

            <div class="container">
                <div class="row">
                    <div class="col mx-3">
                        <div class="card cashier-card" style="height: 650px;">
                            <div class="card-header cashier-card-header">
                                Cashier
                            </div>

                            <div class="m-4">
                                <div class="d-flex justify-content-center">
                                    <form id="isbn-form" class="d-flex w-75">
                                        @csrf
                                        <input type="text" id="isbn_code" name="isbn_code" class="form-control rounded-pill" placeholder="ISBN code..." style="margin-right: 8px;">
                                        <button type="submit" class="btn btn-orange rounded-pill">Add</button>
                                    </form>
                                </div>

                                <ul id="book-list" class="table-list mt-3"></ul>

                                <script>
                                    const isbnForm = document.getElementById('isbn-form');
                                    const isbnInput = document.getElementById('isbn_code');
                                    const bookList = document.getElementById('book-list');
                                    const totalSumElement = document.getElementById('total-sum');

                                    isbnForm.addEventListener('submit', function(e) {
                                        e.preventDefault();
                                        const isbnCode = isbnInput.value.trim();

                                        if (isbnCode) {
                                            // サーバーにISBNコードを送信して、対応するタイトルと価格を取得する
                                            fetch('/store/books/find', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                },
                                                body: JSON.stringify({ isbn_code: isbnCode })
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.title && data.price) {
                                                    addBookToList(data.title, data.price);
                                                    isbnInput.value = ''; // フォームをクリア
                                                } else {
                                                    alert('Book not found');
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                                alert('Error occurred while fetching book data.');
                                            });
                                        }
                                    });

                                    function addBookToList(title, price) {
                                        const bookLi = document.createElement('li');
                                        bookLi.classList.add('table-row');

                                        bookLi.innerHTML = `
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center fs-5">
                                                    <div class="d-flex flex-grow-1 align-items-center">
                                                        <span class="book-title">${title}</span>
                                                        <span class="book-price ms-3">${parseFloat(price).toFixed(2)}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span> × </span>
                                                        <input type="number" value="1" min="1" class="book-count rounded-pill fw-bold" onchange="updateTotal(this)">
                                                        <button class="delete-btn btn ms-2"><i class="fa-regular fa-trash-can"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="calculation">
                                                = <span class="total-price">¥ ${parseFloat(price).toFixed(2)}</span>
                                            </div>
                                        `;

                                        bookList.appendChild(bookLi);

                                        const deleteBtn = bookLi.querySelector('.delete-btn');
                                        deleteBtn.addEventListener('click', function() {
                                            bookList.removeChild(bookLi);  // リストからこの行を削除
                                            updateTotalSum();  // 合計金額を更新
                                        });

                                        updateTotalSum();  // 合計金額を更新
                                    }

                                    function updateTotal(input) {
                                        const bookLi = input.closest('.table-row');
                                        const priceElement = bookLi.querySelector('.book-price');
                                        const totalPriceElement = bookLi.querySelector('.total-price');

                                        const price = parseFloat(priceElement.textContent); // 価格を取得
                                        const quantity = parseInt(input.value); // 数量を取得

                                        // 個別の合計金額を計算
                                        const total = price * quantity;

                                        // 表示を更新
                                        totalPriceElement.textContent = ' ¥ ' + total.toFixed(2); // 合計価格を更新

                                        updateTotalSum();  // 全体の合計金額を更新
                                    }

                                    function updateTotalSum() {
                                        let totalSum = 0;
                                        let totalQty = 0;

                                        // リスト内の全ての行を取得
                                        const bookRows = bookList.querySelectorAll('.table-row');
                                        bookRows.forEach(row => {
                                            const priceElement = row.querySelector('.book-price');
                                            const quantityElement = row.querySelector('.book-count');
                                            const price = parseFloat(priceElement.textContent);
                                            const quantity = parseInt(quantityElement.value);
                                            const total = price * quantity;

                                            totalSum += total;  // 合計金額に加算
                                            totalQty += quantity;  // 合計数量に加算
                                        });

                                        // 合計金額と合計数量を表示
                                        document.querySelector('#total-qty').textContent = totalQty;  // 合計数量を表示
                                        document.querySelector('#total-sum').textContent = totalSum.toFixed(2);  // 合計金額を表示
                                        document.getElementById('total-sum').textContent = '¥ ' + totalSum.toFixed(2);
                                    }
                                </script>

                            </div>
                            {{-- <p style="position: absolute; bottom: 2%; left: 25%; width: 50%;">
                                <button type="submit" class="btn btn-primary cashier-submit-button">Subtotal</button>
                            </p> --}}
                        </div>
                    </div>

                    <div class="col mx-3">
                        <div>
                            <div class="card cashier-card cashier-button">
                                <div class="d-flex align-items-center">
                                    <div>User ID:</div>
                                    <form action="" class="ms-auto" style="margin-left: 8px; background-color: inherit;">
                                        <input type="number" name="user_id" class="text-end rounded-pill" style="border: none; color: white; font-weight: bold; background-color: inherit;">
                                    </form>
                                </div>
                            </div>
                        <div>
                            <div class="card cashier-card my-4 cashier-button">
                                <div class="d-flex align-items-center">
                                    <div>Select Payment:</div>
                                    <select id="payment-method" class="form-select w-50 ms-auto text-end" style="border: none; background-color: inherit; color: white; font-size: 1.5rem; font-weight: bold;">
                                        <option value="" disabled selected></option>
                                        <option value="cash">Cash</option>
                                        <option value="credit-card">Credit Card</option>
                                        <option value="debit-card">Debit Card</option>
                                        <option value="paypal">PayPal</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="card cashier-card">
                            <div class="card-header cashier-card-header">Total Price</div>
                            <div class="card-body cashier-card-body mx-5" style="height: 290px;">
                                <div class="cashier-total-price">Total Qty:
                                    <span id="total-qty" class="align-items-end" style="float: right; margin-right: 17px;">0</span><hr>
                                </div>
                                <div class="cashier-total-price">Total Price:
                                    <span id="total-sum" class="align-items-end" style="float: right; margin-right: 17px;">0.00</span><hr>
                                </div>
                                <div class="cashier-total-price d-flex justify-content-end align-items-center">
                                    <span style="margin-right: 35px;">Current Total:</span>
                                    <form action="" class="d-flex justify-content-end">
                                        <input type="number" class="fw-bold rounded-pill text-end" style="font-size: 1.5rem; border: none; width: 70%;">
                                    </form>
                                </div>
                                <button type="submit" class="btn btn-danger cashier-submit-button" style="position: absolute; bottom: 8%; left: 25%; width: 50%;">
                                    Checkout
                                </button>
                            </div>
                        </div>

                        <div class="card cashier-card my-4" style="height: 120px">
                            <div class="card-header cashier-card-header">Change</div>
                            <div class="card-body cashier-total-price mx-5">
                                ¥ <span class="align-items-end" style="float: right; margin-right: 17px;">0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end;">
                    <a href="{{ url('/store/receipt') }}" class="cashier-button d-block text-decoration-none text-center" style="width: 15%; border-radius: 16px;">
                        Receipt <i class="fa-solid fa-caret-right"></i>
                    </a>
                </div>
            </div>

            <style>
                .cashier-card{
                    width: 100%;
                    background-color: white;
                    font-weight: bold;
                    border: none;
                    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                    border-radius: 16px;
                }

                .cashier-button{
                    height: 60px;
                    background-color: #D3DD53;
                    color: white;
                    font-size: 1.5rem;
                    font-weight: bold;
                    padding: 12px;
                    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                }

                .cashier-card-header{
                    background-color: #80D89D;
                    height: 3rem;
                    border: none;
                    color: white;
                    font-size: 1.5rem;
                    border-top-left-radius: 16px !important;
                    border-top-right-radius: 16px !important;
                }

                #book-list {
                    list-style-type: none;
                    width: 100%;
                    border-collapse: collapse;
                    max-height: 480px;
                    overflow-y: auto;
                    padding: 10px;
                    list-style-type: none;
                }

                .table-row:nth-child(even) {
                    background-color: #f9f9f9;
                }

                .table-row span{
                    flex: 1;
                    text-align: left;
                }

                .table-list li {
                    padding: 8px;
                    border-bottom: 1px solid #ddd;
                }

                .table-list li:last-child {
                    border-bottom: none;
                }

                .book-count {
                    width: 50px;
                    text-align: center;
                    border: none;
                }

                .delete-btn {
                    color: red;
                    border: none;
                    padding: 5px 10px;
                    border-radius: 5px;
                    cursor: pointer;
                }

                .calculation {
                    flex: 0 0 auto;
                    text-align: right;
                    opacity: 0.5;
                }

                .cashier-submit-button {
                    font-weight: bold;
                    font-size: 1.5rem;
                    height: 3rem;
                    width: 100%;
                    border-radius: 16px;
                }

                .cashier-total-price {
                    font-weight: bold;
                    font-size: 1.5rem;
                }
            </style>

        </main>
    </div>
</body>
</html>
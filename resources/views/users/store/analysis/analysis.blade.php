@extends('layouts.app')

@section('title', 'Store Analysis')


@section('content')

    <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
        <div class="h2 fw-semibold">
            <i class="fa-solid fa-caret-left"></i>
            <div class="d-inline main-text">Back</div>
        </div>
    </a>


    <form action="#" method="post">
        @csrf
        <div class="row justify-content-center mt-2">
            <div class="col-10 mt-3">
                <h1 class="display-3">Analysis of {{$store->name}}</h1>
                <div class="bg-white rounded mt-4 p-5 profile-list shadow">
                    <div class="row">
                        <div class="col-8">
                            <h2 class="h1 fw-bold text-grey">Customers(All Area)</h2>
                        </div>
                        {{-- order list --}}
                        <div class="col-4">
                            <select name="address" id="" class="form-select">
                                <option value="" hidden>Address</option>
                                <option value="All Area">All Area</option>
                                @foreach ($prefectures as $prefecture)
                                    <option value="{{ $prefecture }}">
                                        {{ $prefecture }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <canvas id="customerChart" width="700" height="300"></canvas>
                </div>

                <div class="bg-white rounded my-5 p-5 profile-list shadow">
                    <div class="row">
                        <div class="col-8">
                            <h2 id="bookTitle" class="h1 fw-bold text-grey">Books(Genre)</h2>
                        </div>
                        {{-- order list --}}
                        <div class="col-4">
                            <select name="book" id="bookType" class="form-select">
                                <option value="genre">Genre</option>
                                <option value="title">Title</option>
                            </select>
                        </div>
                    </div>
                    <canvas id="bookChart" width="700" height="300"></canvas>
                </div>
            </div>


        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('customerChart').getContext('2d');
        var customerChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['0~', '20~', '30~', '40~', '50~', '60~', '70~', '80~'],
                datasets: [{
                        label: 'Female',
                        data: [12, 19, 3, 5, 2, 3, 10, 8],
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Male',
                        data: [10, 15, 4, 8, 6, 4, 7, 9],
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        var bookChart;

        // 初期表示のデータ (Genre)
        var genreData = {
            labels: ['Comic', 'Fantasy', 'Horror', 'Mystery', 'History', 'Literature', 'Kids', 'Travel', 'Science',
                'Romance'
            ],
            datasets: [{
                label: 'Genre',
                data: [25, 20, 18, 15, 14, 12, 10, 6, 5, 2],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Titleのデータ
        var titleData = {
            labels: ['booktitle1', 'booktitle2', 'booktitle3', 'booktitle4', 'booktitle5', 'booktitle6', 'booktitle7',
                'booktitle8', 'booktitle9', 'booktitle10'
            ],
            datasets: [{
                label: 'Title',
                data: [25, 20, 18, 15, 14, 12, 10, 6, 4, 1],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        // グラフを生成する関数
        function createChart(data) {
            var ctx = document.getElementById('bookChart').getContext('2d');
            if (bookChart) {
                bookChart.destroy(); // 既存のグラフを削除
            }
            bookChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // 初期状態でジャンルのグラフを表示
        createChart(genreData);

        // プルダウン選択時にデータを切り替える
        document.getElementById('bookType').addEventListener('change', function() {
            var selectedValue = this.value;
            if (selectedValue === 'genre') {
                createChart(genreData);
            } else if (selectedValue === 'title') {
                createChart(titleData);
            }

            // タイトルの()内のテキストを変更
            document.getElementById('bookTitle').textContent = 'Books(' + selectedValue.charAt(0).toUpperCase() +
                selectedValue.slice(1) + ')';
        });
    </script>

@endsection

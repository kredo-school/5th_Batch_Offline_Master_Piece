@extends('layouts.app')

@section('title', 'Store Analysis')


@section('content')

    <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
        <div class="h2 fw-semibold">
            <i class="fa-solid fa-caret-left"></i>
            <div class="d-inline main-text">Back</div>
        </div>
    </a>


        <div class="row justify-content-center mt-2">
            <div class="col-10 mt-3">
                <h1 class="display-3">Analysis of {{ $store->name }}</h1>
                <div class="bg-white rounded mt-4 p-5 profile-list shadow">
                    <div class="row">
                        <div class="col-8">
                            <h2 class="h1 fw-bold text-grey">Customers ({{ $selectedPrefecture }})</h2>
                        </div>
                        <div class="col-4">
                            <form action="{{ route('store.analysis') }}" method="get">
                                <select name="address" class="form-select">
                                    <option value="All Area" {{ $selectedPrefecture == 'All Area' ? 'selected' : '' }}>All
                                        Area</option>
                                    @foreach ($prefectures as $prefecture)
                                        <option value="{{ $prefecture }}"
                                            {{ $selectedPrefecture == $prefecture ? 'selected' : '' }}>
                                            {{ $prefecture }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var bookChart = null; // 初期化

        // 都道府県選択時に自動でフォームを送信
        document.querySelector('select[name="address"]').addEventListener('change', function() {
            this.form.submit(); // フォームを自動送信
        });

        // 年代・性別のグラフ描画
        var ageLabels = ['0~19', '20~29', '30~39', '40~49', '50~59', '60~69', '70~79', '80~'];
        var maleData = @json(array_column($ageGroups, 'male'));
        var femaleData = @json(array_column($ageGroups, 'female'));

        var ctx = document.getElementById('customerChart').getContext('2d');
        var customerChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ageLabels,
                datasets: [{
                        label: 'Male',
                        data: maleData,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Female',
                        data: femaleData,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
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

        // 本のデータ (ジャンル/タイトル) のグラフ描画
        var genreData = {
            labels: @json(array_keys($genres)),
            datasets: [{
                label: 'Genre',
                data: @json(array_values($genres)),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        var titleData = {
            labels: @json($books->pluck('title')),
            datasets: [{
                label: 'Title',
                data: @json($books->pluck('purchase_count')),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

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

            document.getElementById('bookTitle').textContent = 'Books(' + selectedValue.charAt(0).toUpperCase() +
                selectedValue.slice(1) + ')';
        });

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
                        x: {
                            ticks: {
                                callback: function(value, index, values) {
                                    // ラベルが長すぎる場合に折り返す
                                    var label = this.getLabelForValue(value);
                                    var maxLength = 15; // 1行に表示する文字数の最大値
                                    if (label.length > maxLength) {
                                        return label.match(new RegExp('.{1,' + maxLength + '}',
                                        'g')); // 文字列を分割して配列にする
                                    }
                                    return label;
                                },
                                maxRotation: 0, // ラベルの回転を無効にする
                                minRotation: 0 // ラベルの回転を無効にする
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label.split(/(.{1,30})/g).join("\n");
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>


@endsection

@extends('layouts.app')

@section('title', 'Store Analysis')


@section('content')

    <div>
        <a href="" class="text-decoration-none back ms-4"><i class="fa-solid fa-caret-left"></i> <label
                for="">Back</label></a>
    </div>


    <form action="#" method="post">
        @csrf
        <div class="row justify-content-center mt-2">
            <div class="col-10 mt-3">
                <div class="row">
                    <div class="col-9">
                        <h1 class="display-3">Analysis of $username</h1>
                    </div>
                    {{-- order list --}}
                    <div class="col-3 pt-3">
                        <button type="submit" name="btn-search" class="btn btn-orange form-control">Confirm</button>
                    </div>
                </div>

                <div class="bg-white rounded mt-4 p-5 profile-list shadow">
                    <div class="row">
                        <div class="col-8">
                            <h2 class="h1 fw-bold text-grey">Customers(All Area)</h2>
                        </div>
                        {{-- order list --}}
                        <div class="col-4">
                            <select name="address" id="" class="form-select">
                                <option value="" hidden>Address</option>
                                <option value="hokkaido">Hokkaido</option>
                                <option value="aomori">Aomori</option>
                                <option value="iwate">Iwate</option>
                                <option value="miyagi">Miyagi</option>
                                <option value="akita">Akita</option>
                                <option value="yamagata">Yamagata</option>
                                <option value="fukushima">Fukushima</option>
                                <option value="ibaraki">Ibaraki</option>
                                <option value="tochigi">Tochigi</option>
                                <option value="gunma">Gunma</option>
                                <option value="saitama">Saitama</option>
                                <option value="chiba">Chiba</option>
                                <option value="tokyo">Tokyo</option>
                                <option value="kanagawa">Kanagawa</option>
                                <option value="niigata">Niigata</option>
                                <option value="toyama">Toyama</option>
                                <option value="ishikawa">Ishikawa</option>
                                <option value="fukui">Fukui</option>
                                <option value="yamanashi">Yamanashi</option>
                                <option value="nagano">Nagano</option>
                                <option value="gifu">Gifu</option>
                                <option value="shizuoka">Shizuoka</option>
                                <option value="aichi">Aichi</option>
                                <option value="mie">Mie</option>
                                <option value="shiga">Shiga</option>
                                <option value="kyoto">Kyoto</option>
                                <option value="osaka">Osaka</option>
                                <option value="hyogo">Hyogo</option>
                                <option value="nara">Nara</option>
                                <option value="wakayama">Wakayama</option>
                                <option value="tottori">Tottori</option>
                                <option value="shimane">Shimane</option>
                                <option value="okayama">Okayama</option>
                                <option value="hiroshima">Hiroshima</option>
                                <option value="yamaguchi">Yamaguchi</option>
                                <option value="tokushima">Tokushima</option>
                                <option value="kagawa">Kagawa</option>
                                <option value="ehime">Ehime</option>
                                <option value="kochi">Kochi</option>
                                <option value="fukuoka">Fukuoka</option>
                                <option value="saga">Saga</option>
                                <option value="nagasaki">Nagasaki</option>
                                <option value="kumamoto">Kumamoto</option>
                                <option value="oita">Oita</option>
                                <option value="miyazaki">Miyazaki</option>
                                <option value="kagoshima">Kagoshima</option>
                                <option value="okinawa">Okinawa</option>
                            </select>
                        </div>
                    </div>
                    <canvas id="customerChart" width="700" height="300"></canvas>
                </div>

                <div class="bg-white rounded my-5 p-5 profile-list shadow">
                    <div class="row">
                        <div class="col-8">
                            <h2 class="h1 fw-bold text-grey">Books(Genre)</h2>
                        </div>
                        {{-- order list --}}
                        <div class="col-4">
                            <select name="book" id="" class="form-select">
                                <option value="" hidden>choose</option>
                                <option value="">Genre</option>
                                <option value="">Price</option>
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
        var ctx = document.getElementById('bookChart').getContext('2d');
        var genreChart = new Chart(ctx, {
            type: 'bar', // 棒グラフ
            data: {
                labels: ['Comic', 'Fantasy', 'Horror', 'Mystery', 'History', 'Literature', 'Kids',
                'Travel'], // X軸のラベル (ジャンル)
                datasets: [{
                    label: 'n=120', // グラフのラベル
                    data: [25, 20, 18, 15, 14, 12, 10, 6], // ジャンルごとのn値 (降順)
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // 棒グラフの色
                    borderColor: 'rgba(75, 192, 192, 1)', // 境界線の色
                    borderWidth: 1 // 境界線の幅
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Y軸の開始点を0に設定
                    }
                }
            }
        });
    </script>




@endsection

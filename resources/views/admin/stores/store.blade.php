@extends('layouts.app')

@section('content')
<div>
    <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
        <div class="h2 fw-semibold">
            <i class="fa-solid fa-caret-left"></i>
            <div class="d-inline main-text">Back</div>
        </div>
    </a>
</div>
<div class="upper-container">
    <div class="row align-items-center">
        <div class="col"></div>
        <div class="col-auto">
            <form action="#" method="post"> <!-- action属性を追加 -->
                @csrf
                <div class="row align-items-center">
                    <div class="col pe-0 position-relative">
                        <input type="text" id="searchInput" name="search"
                            class="form-control form-control-sm rounded" placeholder=" Search stores..."
                            style="width: 400px;">
                        <button type="button" id="clearButton"
                            class="btn btn-sm position-absolute end-0 top-50 translate-middle-y rounded"
                            style="display: none; right: 30px;">
                            x
                        </button>
                    </div>
                    <div class="col ps-1">
                        <button type="submit" class="btn btn-warning btn-sm search-icon">
                            <i class="fa-solid fa-magnifying-glass text-white"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-4">
            <form action="#" method="post">
                @csrf
                <select class="form-select w-50 mx-auto" aria-label="admin-sort" id="manage-store-select">
                        <option value="" hidden>area</option>
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
            </form>
        </div>
    </div>

    @include('admin.button')
</div>

<table class="table manage-table border-rounded" id="manage-store-table">
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < 5; $i++)
            <tr class="align-middle">
                <td class="text-center"><img
                        src="https://th.bing.com/th/id/OIP.Khe4un4CrKghna_BBciHDgHaHa?w=148&h=180&c=7&r=0&o=5&dpr=2&pid=1.7"
                        alt="" class="img-admin-store"></td>
                <td>shoki</td>
                <td>motohashi@email</td>
                <td>0120-***-***</td>
                <td>Ibaraki</td>
                <td><a class="text-danger btn fs-24 p-0 border-0" data-bs-toggle="modal"
                        data-bs-target="#delete-store-test">
                        <i class="fa-regular fa-face-frown"></i>
                    </a>
                    <a class="text-primary btn fs-24 p-0 border-0" data-bs-toggle="modal"
                        data-bs-target="#active-store-test">
                        <i class="fa-regular fa-face-frown"></i>
                    </a>
                </td>
            </tr>
        @endfor
    </tbody>
</table>

{{-- jQuery ライブラリ  --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(document).ready(function() {
        var data = {
            // 適切なデータ構造をここで定義する
        };

        $('#manage-store-select').change(function() {
            var selectedData = $(this).val();
            var tableBody = $('#manage-store-table tbody');

            tableBody.empty(); // 既存の行をクリア

            // 選択されたデータが存在する場合、そのデータを表示
            if (selectedData in data) {
                data[selectedData].forEach(function(entry) {
                    tableBody.append(`
                        <tr>
                            <td>${entry.name}</td>
                            <td>${entry.email}</td>
                            <td>${entry.phone}</td>
                            <td>${entry.address}</td>
                            <td>${entry.status}</td>
                        </tr>
                    `);
                });
            } else {
                tableBody.append(`
                    <tr>
                        <td colspan="6">データを選択してください</td>
                    </tr>
                `);
            }
        });
    });
</script>

<div class="under-container mt-5">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled" aria-disabled="true">
                <a class="page-link" href="#" tabindex="-1" aria-label="Previous">
                    Previous
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    Next
                </a>
            </li>
        </ul>
    </nav>
</div>
@endsection


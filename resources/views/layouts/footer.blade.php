<footer>
    <div class="footer-content">
        <div class="row d-flex">
            <div class="col">
                <img src="{{asset("images/white-logo.png")}}" alt="masterpiece-logo" class="footer-logo">
                <div>
                    {{-- SNSのアカウントはないけど一応 --}}
                    <a href="#"><i class="fa-brands fa-instagram fa-2x"></i></a>
                    <a href="#"><i class="fa-brands fa-x-twitter fa-2x"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube fa-2x"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f fa-2x"></i></a>
                </div>
            </div>

            <div class="col mt-3">
                <p>Genre</p>
                <ul class="list-container" style="grid-template-columns: repeat(3, 1fr);">
                    @foreach ($all_genres as $genre)
                        <li><a href="{{route('genreHome.fromfooter', $genre->id)}}">{{ $genre->name }}</a></li>
                    @endforeach
                    <li><a href="#">Others</a></li>
                </ul>
            </div>

            <div class="col" style="flex-grow: 1.2; margin-top: 18px; margin-left: 80px;">
                <p><a href="{{ route('book.store_list') }}">Store</a></p>
                <ul class="list-container" style="grid-template-columns: repeat(3, 1fr);">
                    {{--　store nameを直接載せる場合
                        @foreach ($all_stores as $store )
                            <li><a href="{{ route('guest.show.store', $store->id) }}">{{ $store->name }}</a></li>
                        @endforeach --}}

                    <!-- regionsを使ってループ -->
                    <!-- Hokkaidoだけ外で表示 -->
                @if (isset($regions['Hokkaido']))
                    <li><a href="{{ route('book.store_list', ['area' => 'Hokkaido']) }}">Hokkaido</a></li>
                @endif

                @foreach ($regions as $region => $prefectures)
                    @if ($region !== 'Hokkaido')
                        <li class="has-area-menu">
                            <span class="d-inline-block">{{ $region }}</span>
                            <ul class="area-menu">
                                @foreach ($prefectures as $prefecture)
                                    <li><a href="{{ route('book.store_list', ['area' => $prefecture]) }}">{{ $prefecture }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach


                        </ul>
                    </li>
                </ul>
            </div>

            <div class="col" style="margin-top: 22px;">
                <p><a href="{{route('thread.home')}}">Thread</a></p>
                {{-- thread.homeへ飛ぶ --}}
                    <a href="{{route('thread.create')}}">Post</a>
            </div>

            <div class="col" style="position: relative; margin-top: 22px;">
                <p><a href="{{ route('policy') }}">Our Policy</a></p>
                <p style="position: absolute; top: 30%; left: 30%;">
                    <a href="{{ route('inquiry') }}">Inquiry</a>
                </p>

            </div>
            <div class="col" style="position: relative; margin-top: 22px;">
                <p id="page-top">Page Top <i class="fa-regular fa-circle-up"></i></p>
                <script>
                    // スクロールボタンを取得
                    const pageTop = document.getElementById('page-top');

                    // スクロール位置に応じてボタンを表示
                    window.onscroll = function() {
                        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                            pageTop.style.display = "block";
                        } else {
                            pageTop.style.display = "none";
                        }
                    };

                    // ボタンをクリックした時の処理
                    pageTop.onclick = function() {
                        window.scrollTo({top: 0, behavior: 'smooth'});
                    };
                </script>
            </div>
        </div>

        <div style="text-align: center;">
            &copy;2024 | Kredo IT abroad
            <a href="https://kredo.jp/" class="eraser-button mx-3">
                <svg width="15" height="31" viewBox="0 0 15 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0H15V31H0V0Z" fill="#716D6D"/>
                </svg>
            </a>
        </div>
    </div>
</footer>

<style>
    footer {
        background-color: #357C4A;
        color: white;
        width: 100%;
        margin-top: auto; /* これでフッターが画面下に固定される */
        padding: 20px;
        text-align: center;
        padding-bottom: 0px;
    }

    .footer-logo{
        width: 10rem;
        height: 10rem;
    }

    footer a{
        text-decoration: none;
        color: white;
        display: inline-block;
        transition: transform 0.1s, text-shadow 0.3s;
    }

    footer a:hover{
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.8),
                            0 0 20px rgba(255, 255, 255, 0.6),
                            0 0 30px rgba(255, 255, 255, 0.4),
                            0 0 40px rgba(255, 255, 255, 0.2);
    }

    footer a:active{
        transform: translateY(2px);
    }

    footer .col {
        text-align: center;
    }

    footer p{
        font-size: 1.5rem;
        font-weight: bold;
        text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
        margin-top: 10%;
    }

    footer li{
        width: calc(100% / 10);
        list-style: none;
    }

    #page-top {
        position: fixed;
        bottom: 20px;
        right: 30px;
        display: none;
        padding: 10px 15px;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
    }

    .eraser-button {
        width: 5rem;
        height: 31px;
        background-color: #FFB84C;
        border-radius: 7px;
        transition: transform 0.1s ease;
    }

    .eraser-button:hover {
        transform: translateY(-2px);
    }

    .eraser-button:active {
        transform: translateY(1px);
    }

    .list-container {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        grid-gap: 10px;
    }

    .list-container li{
        position: relative;
    }

    .has-area-menu:hover span{
        transform: translateY(-2px);
        text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
    }

    .area-menu li {
        padding:  10px;
    }

    .area-menu li a {
        text-decoration: none;
        color: #757B9D;
        font-weight: bold;
    }

    .area-menu li a:hover {
        transform: translateY(-2px) !important;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2) !important;

    }
    .area-menu li a:active {
        transform: translateY(2px) !important;
        text-shadow: 0 0 0 !important;
    }


    .has-area-menu .area-menu {
    position: absolute;
    bottom: 100%; /* 親要素の上にメニューを表示 */
    left: 0;
    background-color: #E1FFEB;
    border: 1px solid #ccc;
    border-radius: 16px;
    box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.1);
    padding: 15px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px); /* ちょっと下に隠しておく */
    transition: opacity 0.3s ease, transform 0.3s ease; /* フェードインアニメーション */
    z-index: 1000;
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* グリッドレイアウト */
}

.has-area-menu:hover .area-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0); /* 上に移動して表示される */
}

.has-area-menu .area-menu::before {
    content: "";
    position: absolute;
    bottom: -7px; /* 親要素の下に矢印を表示 */
    left: 25px;
    border-width: 7px 8px 0 8px; /* 下方向に矢印を表示 */
    border-style: solid;
    border-color: #E1FFEB transparent transparent transparent; /* 矢印の色を吹き出しの背景色に合わせる */
}

.has-area-menu .area-menu::after {
    content: "";
    position: absolute;
    bottom: -8px; /* 矢印の影部分を少し下に */
    left: 25px;
    border-width: 8px 9px 0 9px; /* 矢印の影を作成 */
    border-style: solid;
    border-color: #ccc transparent transparent transparent; /* 矢印の影の色を少し暗めに */
    z-index: -1; /* 背景の影が吹き出しの後ろに表示されるようにする */
}
</style>

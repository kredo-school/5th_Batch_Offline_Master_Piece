
<footer>
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

        <div class="col">
            <p>Genre</p>
            <ul class="list-container" style="grid-template-columns: repeat(3, 1fr);">
            {{-- @foreach ($all_genres as $genre)
                    <li><a href="{{ route('', $genre->id) }}" >{{ $genre->name }}</a></li>
                @endforeach --}}
                <li><a href="#">Fantasy</a></li>
                <li><a href="#">Romance</a></li>
                <li><a href="#">History</a></li>
                <li><a href="#">Literature</a></li>
                <li><a href="#">Lifestyle</a></li>
                <li><a href="#">Magazine</a></li>
                <li><a href="#">Comics</a></li>
                <li><a href="#">Art</a></li>
                <li><a href="#">Music</a></li>
                <li><a href="#">Travel</a></li>
                <li><a href="#">Science</a></li>
                <li><a href="#">Technology</a></li>
                <li><a href="#">Engineering</a></li>
                <li><a href="#">Physics</a></li>
                <li><a href="#">Geology</a></li>
                <li><a href="#">Biology</a></li>
                <li><a href="#">Philosophy</a></li>
                <li><a href="#">Psychology</a></li>
                <li><a href="#">Education</a></li>
                <li><a href="#">Qualification</a></li>
                <li><a href="#">Othrers</a></li>
            </ul>
        </div>

        <div class="col mt-2">
            <p><a href="#">Store</a></p>
            {{-- show.storeへ飛ぶ --}}
            <ul class="list-container" style="grid-template-columns: repeat(2, 1fr);">
                {{--　store nameを直接載せる場合
                @foreach ($all_stores as $store )
                    <li><a href="{{ route('guest.show.store', $store->id) }}">{{ $store->name }}</a></li>
                @endforeach --}}
                <li><a href="#">Hokkaido</a></li>
                <li><a href="#">Tohoku</a></li>
                <li><a href="#">Kanto</a></li>
                <li><a href="#">Chubu</a></li>
                <li><a href="#">Kansai</a></li>
                <li><a href="#">Chugoku</a></li>
                <li><a href="#">Shikoku</a></li>
                <li><a href="#">Kyushu</a></li>
            </ul>
        </div>

        <div class="col mt-2">
            <p><a href="{{route('thread.home')}}">Thread</a></p>
            {{-- thread.homeへ飛ぶ --}}
                <a href="{{route('thread.create')}}">Post</a>
        </div>

        <div class="col mt-2" style="position: relative;">
            <p><a href="#">Our Policy</a></p>
            <p style="position: absolute; top: 30%; left: 30%;">
                <a href="#">Inquiry</a>
            </p>

        </div>
        <div class="col mt-2" style="position: relative">
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
</footer>




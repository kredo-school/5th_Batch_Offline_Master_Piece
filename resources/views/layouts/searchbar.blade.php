<script>
    // // 正しいIDを取得
    // const searchInput = document.getElementById('searchInput');
    // const clearBtn = document.getElementById('clearButton');

    // // 入力フィールドのイベントリスナーを設定
    // searchInput.addEventListener('input', function() {
    //     if (searchInput.value.length > 0) {
    //         clearBtn.style.display = 'inline-block';  // テキストがあるときはバツ印を表示
    //     } else {
    //         clearBtn.style.display = 'none';    // テキストがないときは非表示
    //     }
    // });

    // // バツ印をクリックしたときの処理
    // clearBtn.addEventListener('click', function() {
    //     searchInput.value = '';  // 入力フィールドをクリア
    //     clearBtn.style.display = 'none';  // バツ印を非表示
    //     searchInput.focus();  // フィールドにフォーカスを戻す
    // });

    document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const clearBtn = document.getElementById('clearButton');

    searchInput.addEventListener('input', function() {
        clearBtn.style.display = searchInput.value.length > 0 ? 'inline-block' : 'none';
    });

    clearBtn.addEventListener('click', function() {
        searchInput.value = '';
        clearBtn.style.display = 'none';
        searchInput.focus();
    });
});
</script>



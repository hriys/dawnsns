<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}"> <!-- assetでpublicフォルダからパスを組む-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
            <h1>
                <a href="/top"><img src="/images/main_logo.png"></a>
            </h1>
            <div id="menu">
                <div id="user">
                    <p>{{$name->username}}さん<span>▼</span></p><img src="/images/{{$name->images}}" class="icon">
                </div>
                <ul>
                    <li class="red"><a href="/top">ホーム</a></li>
                    <li class="white"><a href="/profile">プロフィール</a></li>
                    <li class="white"><a href="/logout">ログアウト</a></li>
                </ul>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>{{ $name->username }}さんの</p>
                <div id="followcount">
                    <p>フォロー数</p>
                    <div class="count">
                        <p>{{ $followcount }}名</p>
                    </div>
                </div>
                <p class="btn"><a href="/followList">フォローリスト</a></p>
                <div id="followercount">
                    <p>フォロワー数</p>
                    <div class="count">
                        <p>{{ $followercount }}名</p>
                    </div>
                </div>
                <p class="btn"><a href="/followerList">フォロワーリスト</a></p>
            </div>
            <p class="btn search"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
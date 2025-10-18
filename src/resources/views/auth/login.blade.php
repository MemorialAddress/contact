<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ログイン画面</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__title">FashionablyLate</div>
    <form action="/register" method="get"><button>register</button></form>
  </header>

  <main>
    <div class="title">
      Login
    </div>

    <form action="/login" method="post">
      @csrf
      <div class="form">
        <div class="form__contents">
          <div class="form__contents-title">メールアドレス</div>
          <div class="form__contents-input"><input type="text" name="email" value="{{ old('email') }}" placeholder="　例：test@example.com" /></div>
          @if ($errors->any())
            <div class="form__contents-alert">
              @foreach ($errors->all() as $error)
                @if ($error == $errors->first('email'))
                  {{ $error }}
                @endif
              @endforeach
            </div>
          @endif
          <div class="form__contents-title">パスワード</div>
          <div class="form__contents-input"><input type="text" name="password" placeholder="　例：coachtech1106"/></div>
          @if ($errors->any())
            <div class="form__contents-alert">
              @foreach ($errors->all() as $error)
                @if ($error == $errors->first('password'))
                  {{ $error }}
                @endif
              @endforeach
            </div>
          @endif
          <div class="form__contents-button"><button type="submit">ログイン</button></div>
        </div>
      <br>
    </form>
  </main>
</body>

</html>

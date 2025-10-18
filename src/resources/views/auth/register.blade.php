<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>登録画面</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__title">FashionablyLate</div>
    <form action="/login" method="get"><button>login</button></form>
  </header>

  <main>
    <div class="title">
      Register
    </div>

    <form action="/register" method="post">
      @csrf
      <div class="form">
        <div class="form__contents">
          <div class="form__contents-title">お名前</div>
          <div class="form__contents-input"><input type="text" name="name" value="{{ old('name') }}" placeholder="　例：山田 太郎"/></div>
          @if ($errors->any())
            <div class="form__contents-alert">
              @foreach ($errors->all() as $error)
                @if ($error == $errors->first('name'))
                  <li>{{ $error }}</li>
                @endif
              @endforeach
            </div>
          @endif
          <div class="form__contents-title">メールアドレス</div>
          <div class="form__contents-input"><input type="text" name="email" value="{{ old('email') }}" placeholder="　例：test@example.com"/></div>
          @if ($errors->any())
            <div class="form__contents-alert">
              @foreach ($errors->all() as $error)
                @if ($error == $errors->first('email'))
                  <li>{{ $error }}</li>
                @endif
              @endforeach
            </div>
          @endif
          <div class="form__contents-title">パスワード</div>
          <div class="form__contents-input">
            <input type="password" name="password" placeholder="　例：coachtech1106"/>
            <input type="hidden"   name="password_confirmation" value="{{'password'}}"/>
          </div>
          @if ($errors->any())
            <div class="form__contents-alert">
              @foreach ($errors->all() as $error)
                @if ($error == $errors->first('password'))
                  <li>{{ $error }}</li>
                @endif
              @endforeach
            </div>
          @endif
          <div class="form__contents-button"><button type="submit">登録</button></div>
        </div>
      <br>
    </form>
  </main>
</body>

</html>

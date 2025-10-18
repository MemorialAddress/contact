<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>入力画面</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>

<body>
  <header class="header">
    FashionablyLate
  </header>

  <main>
    <div class="title">
      Contact
    </div>
    <form action="/contact/confirm" method="post">
      <div class="form">
        @csrf
        <div class="form__contents">
          <div class="form__contents-title">お名前<font color="red">※</font></div>
          <div class="form__contents-name"><input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="　例：山田">　　　</div>
          <div class="form__contents-name"><input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="　例：太郎"></div>
        </div>
        @if ($errors->any())
          <div class="form__contents-alert">
            @foreach ($errors->all() as $error)
              @if ($error == $errors->first('first_name'))
                <li>{{ $error }}</li>
              @endif
            @endforeach
          </div>
        @endif
        @if ($errors->any())
          <div class="form__contents-alert">
            @foreach ($errors->all() as $error)
              @if ($error == $errors->first('last_name'))
                <li>{{ $error }}</li>
              @endif
            @endforeach
          </div>
        @endif

        <div class="form__contents">
          <div class="form__contents-title">性別<font color="red">※</font></div>
          <div class="form__contents-gender">　<input type="radio" name="gender" value="1">　男性　　</div>
          <div class="form__contents-gender">　<input type="radio" name="gender" value="2">　女性　　</div>
          <div class="form__contents-gender">　<input type="radio" name="gender" value="3">　その他　</div>
        </div>
        @if ($errors->any())
          <div class="form__contents-alert">
            @foreach ($errors->all() as $error)
              @if ($error == $errors->first('gender'))
                <li>{{ $error }}</li>
              @endif
            @endforeach
          </div>
        @endif

        <div class="form__contents">
          <div class="form__contents-title">メールアドレス<font color="red">※</font></div>
          <div class="form__contents-email"><input type="text" name="email" value="{{ old('email') }}" placeholder="　例：test@example.com"></div>
        </div>
        @if ($errors->any())
          <div class="form__contents-alert">
            @foreach ($errors->all() as $error)
              @if ($error == $errors->first('email'))
                <li>{{ $error }}</li>
              @endif
            @endforeach
          </div>
        @endif

        <div class="form__contents">
          <div class="form__contents-title">電話番号<font color="red">※</font></div>
          <div class="form__contents-tel"><input type="text" name="tel1" value="{{ old('tel1') }}" placeholder="080">　-　</div>
          <div class="form__contents-tel"><input type="text" name="tel2" value="{{ old('tel2') }}" placeholder="1234">　-　</div>
          <div class="form__contents-tel"><input type="text" name="tel3" value="{{ old('tel3') }}" placeholder="5678"></div>
        </div>
        @if ($errors->any())
          <div class="form__contents-alert">
          @if ($errors->has('tel1'))
            @foreach ($errors->get('tel1') as $error)
              <li>{{ $error }}</li>
            @endforeach
          @elseif ($errors->has('tel2'))
            @foreach ($errors->get('tel2') as $error)
              <li>{{ $error }}</li>
            @endforeach
          @elseif ($errors->has('tel3'))
            @foreach ($errors->get('tel3') as $error)
              <li>{{ $error }}</li>
            @endforeach
          @endif
          </div>
        @endif

        <div class="form__contents">
          <div class="form__contents-title">住所<font color="red">※</font></div>
          <div class="form__contents-address"><input type="text" name="address" value="{{ old('address') }}" placeholder="　例：東京都渋谷区千駄ヶ谷1-2-3"/></div>
        </div>
        @if ($errors->any())
          <div class="form__contents-alert">
            @foreach ($errors->all() as $error)
              @if ($error == $errors->first('address'))
                <li>{{ $error }}</li>
              @endif
            @endforeach
          </div>
        @endif

        <div class="form__contents">
          <div class="form__contents-title">建物名</div>
          <div class="form__contents-building"><input type="text" name="building" value="{{ old('building') }}" placeholder="　例：千駄ヶ谷マンション101"/></div>
        </div>

        <div class="form__contents">
          <div class="form__contents-title">お問い合わせの種類<font color="red">※</font></div>
          <div class="form__contents-category">
            <select type="text" name="category_id" >
              <option value="">選択してください</option>
              @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
              @endforeach
            </select>
          </div>
        </div>
        @if ($errors->any())
          <div class="form__contents-alert">
            @foreach ($errors->all() as $error)
              @if ($error == $errors->first('category_id'))
                <li>{{ $error }}</li>
              @endif
            @endforeach
          </div>
        @endif

        <div class="form__contents">
          <div class="form__contents-title">お問い合わせ内容<font color="red">※</font></div>
          <div class="form__contents-detail"><textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea></div>
        </div>
        @if ($errors->any())
          <div class="form__contents-alert">
            @foreach ($errors->all() as $error)
              @if ($error == $errors->first('detail'))
                <li>{{ $error }}</li>
              @endif
            @endforeach
          </div>
        @endif

      </div>
        <br>
      <div class="button">
        <button type="submit">確認画面</button>
      </div>
    </form>
  </main>
</body>
</html>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>確認画面</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
</head>

<body>
  <header class="header">
    FashionablyLate
  </header>

  <main>
    <div class="title">
      Confirm
    </div>
    <form action="/thanks" method="POST" id="inputForm">
      <div class="form">
        @csrf
        <div class="form__contents">
          <div class="form__contents-title">お名前</div>
          <div class="form__contents-input">{{ $contact['first_name'] }}　{{ $contact['last_name'] }}</div>
          <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
          <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
        </div>
        <div class="form__contents">
          @php
            $gender = '';
            if ('1' == $contact['gender']) {
              $gender = '男';
            }
            if ('2' == $contact['gender']) {
              $gender = '女';
            }
            if ('3' == $contact['gender']) {
              $gender = 'その他';
            }
          @endphp
          <div class="form__contents-title">性別</div>
          <div class="form__contents-input">{{ $gender }}</div>
          <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
        </div>
        <div class="form__contents">
          <div class="form__contents-title">メールアドレス</div>
          <div class="form__contents-input">{{ $contact['email'] }}</div>
          <input type="hidden" name="email" value="{{ $contact['email'] }}">
        </div>
        <div class="form__contents">
          <div class="form__contents-title">電話番号</div>
          <div class="form__contents-input">{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}</div>
          <input type="hidden" name="tel" value="{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}">
        </div>
        <div class="form__contents">
          <div class="form__contents-title">住所</div>
          <div class="form__contents-input">{{ $contact['address'] }}</div>
          <input type="hidden" name="address" value="{{ $contact['address'] }}">
        </div>
        <div class="form__contents">
          <div class="form__contents-title">建物名</div>
          <div class="form__contents-input">{{ $contact['building'] }}</div>
          <input type="hidden" name="building" value="{{ $contact['building'] }}">
        </div>
        <div class="form__contents">
          <div class="form__contents-title">お問い合わせの種類</div>
            @php
              $categoryName = '';
              foreach ($categories as $category) {
                if ($category['id'] == $contact['category_id']) {
                  $categoryName = $category['content'];
                  break;
                  }
              }
            @endphp
          <div class="form__contents-input">{{ $categoryName }}</div>
          <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
        </div>
        <div class="form__contents">
          <div class="form__contents-title2">お問い合わせ内容</div>
          <div class="form__contents-input2">{{ $contact['detail'] }}</div>
          <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
        </div>
      </div>
      <br><br><br>
      <div class="button">
        <button type="submit">送信</button>　　
        <button type="button" onclick=history.back()>修正</button>
      </div>
    </form>
  </main>
</body>

</html>
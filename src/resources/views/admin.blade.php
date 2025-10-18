<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>管理画面</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__title">FashionablyLate</div>
    <form action="/logout" method="post">@csrf<button>logout</button></form>
  </header>

  <main>
    <div class="title">
      Admin
    </div>

    <form action="/admin/search" method="get">
    @csrf
      <div class="form__contents">
        <div class="form__contents-text"><input type="text" name="keyword" placeholder="　名前やメールアドレスを入力してください" value="{{ old('keyword') }}"/></div>
        <div class="form__contents-gender">
          <select name="gender">
              <option value="">性別</option>
              <option value="1">男性</option>
              <option value="2">女性</option>
              <option value="3">その他</option>
              <option value="4">全て</option>
          </select></div>
        <div class="form__contents-category">
          <select name="category_id">
              <option value="">お問い合わせの種類</option>
              @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
              @endforeach
          </select>
        </diV>
        <div class="form__contents-day"><input type="date" name="date"/></div>
        <div class="form__contents-search"><button type="submit">検索</button></div>
        <div class="form__contents-reset"><button type="reset">リセット</button></div>
      </div>
    </form>

    <div class="form__contents-top">
      <form action="/admin/export" method="get">
        @csrf
        <div class="form__contents-export">
          <button type="submit">エクスポート</button>
          <div class="pagination">{{ $contacts->links() }}</div>
        </div>
      </form>
    </div>

    <div class="form__contents">
      <div class="form__contents-viewTitle">
        <div class="form__contents-viewTitleName">お名前</div>
        <div class="form__contents-viewTitleGender">性別</div>
        <div class="form__contents-viewTitleMail">メールアドレス</div>
        <div class="form__contents-viewTitleCategory">お問い合わせの種類</div>
      </div>
    </div>

    @foreach ($contacts as $contact)
    <div class="form__contents">
      <div class="form__contents-view">
        <div class="form__contents-viewName">{{ $contact['first_name'] }}{{ $contact['last_name'] }}</div>
        <div class="form__contents-viewGender">
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
          {{ $gender }}
        </div>
        <div class="form__contents-viewMail">{{ $contact['email'] }}</div>
        <div class="form__contents-viewCategory">
          @php
            $categoryName = '';
            foreach ($categories as $category) {
              if ($category['id'] == $contact['category_id']) {
                $categoryName = $category['content'];
                break;
              }
            }
          @endphp
          {{ $categoryName }}
        </div>
        <div class="form__contents-viewButton">
          <button id="openModalBtn" class="openModalBtn"
            data-id="{{ $contact['id'] }}"
            data-name="{{ $contact['first_name'] }} {{ $contact['last_name'] }}"
            data-gender="{{ $gender }}"
            data-email="{{ $contact['email'] }}"
            data-tel="{{ $contact['tel'] }}"
            data-address="{{ $contact['address'] }}"
            data-building="{{ $contact['building'] }}"
            data-category="{{ $categoryName }}"
            data-detail="{{ $contact['detail'] }}" >
            詳細
          </button>
        </div>
      </div>
    </div>
    @endforeach

    <div id="modal" class="modal" style="display: none;">
      <div class="modal__content">
        <span id="closeModalBtn">&times;</span>
        <div class="modal__content-detail">
          <div class="modal__content-detailTitle">お名前</div>
          <div class="modal__content-detailText"  id="modalName"></div>
        </div>
        <div class="modal__content-detail">
          <div class="modal__content-detailTitle">性別</div>
          <div class="modal__content-detailText"  id="modalGender"></div>
        </div>
        <div class="modal__content-detail">
          <div class="modal__content-detailTitle">メールアドレス</div>
          <div class="modal__content-detailText"  id="modalEmail"></div>
        </div>
        <div class="modal__content-detail">
          <div class="modal__content-detailTitle">電話番号</div>
          <div class="modal__content-detailText"  id="modalTel"></div>
        </div>
        <div class="modal__content-detail">
          <div class="modal__content-detailTitle">住所</div>
          <div class="modal__content-detailText"  id="modalAddress"></div>
        </div>
        <div class="modal__content-detail">
          <div class="modal__content-detailTitle">建物名</div>
          <div class="modal__content-detailText"  id="modalBuilding"></div>
        </div>
        <div class="modal__content-detail">
          <div class="modal__content-detailTitle">お問い合わせの種類</div>
          <div class="modal__content-detailText"  id="modalCategory"></div>
        </div>
        <div class="modal__content-detail">
          <div class="modal__content-detailTitle">お問い合わせの内容</div>
          <div class="modal__content-detailText2" id="modalDetail"></div>
        </div>
        <div class="modal__content-button">
          <form class="form" action="/admin/delete" method="POST">
            @csrf
            <input type="hidden" name="id" id="modalId">
            <button type="submit">削除</button>
          </form>
        </div>
      </div>
    </div>

  </main>

<style>
  svg.w-5.h-5 {
    width: 32px;
    height: 32px;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');
    const closeBtn = document.getElementById('closeModalBtn');

    document.body.addEventListener('click', (e) => {
      if (e.target.classList.contains('openModalBtn')) {
        document.getElementById('modalId').value = e.target.dataset.id;
        document.getElementById('modalName').textContent = e.target.dataset.name;
        document.getElementById('modalGender').textContent = e.target.dataset.gender;
        document.getElementById('modalEmail').textContent = e.target.dataset.email;
        document.getElementById('modalTel').textContent = e.target.dataset.tel;
        document.getElementById('modalAddress').textContent = e.target.dataset.address;
        document.getElementById('modalBuilding').textContent = e.target.dataset.building;
        document.getElementById('modalCategory').textContent = e.target.dataset.category;
        document.getElementById('modalDetail').textContent = e.target.dataset.detail;
        modal.style.display = 'block';
      }

      if (e.target === closeBtn || e.target === modal) {
        modal.style.display = 'none';
      }
    });
  });
</script>

<style>
svg.w-5.h-5 {
    display:block;
    min-width: 32px;
    height: 31px;
    font-size: 14px;
    margin: 0px 0px 0px 0px;
    color: #D9C6B5;
}
.pagination {
    display:block;
    align-items: center;
    justify-content: center;
    background-color:white;
    width:300px;
    text-align:right;
}

.pagination a,
.pagination span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px !important;
    font-size: 14px;
    border: 1px solid #E0DFDE;
    color: #8B7969;
    box-sizing: border-box;
    text-decoration: none;
    background-color: white;
    min-width: 32px;
}

.pagination span[aria-current="page"] {
    background-color: #8B7969;
    color: white;
}

.pagination svg {
    width: 16px;
    height: 16px;
    vertical-align: middle;
}
</style>

</body>

</html>

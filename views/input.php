<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>お問い合わせフォーム - フォームページ -</title>
    <link href="Honoka-master/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <h1>お問い合わせフォーム - フォームページ -</h1>
      <form class="form-horizontal" action="index.php" method="post">
        <input type="hidden" name="token" value="{{ token }}">
        <input type="hidden" name="action" value="input_submit">
        <!-- 件名 -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">件名</label>
          <div class="col-sm-10">
            <select class="form-control" name="title">
              <option value="0">-- 選択してください --</option>
              <option value="1"{% if input.title == 1 %} selected{% endif %}>ご意見</option>
              <option value="2"{% if input.title == 2 %} selected{% endif %}>ご感想</option>
              <option value="3"{% if input.title == 3 %} selected{% endif %}>その他</option>
            </select>
{% if error.title %}
　　　　　  <div class="alert alert-danger" role="alert">{{ error.title|e }}</div>
{% endif %}
          </div>
        </div>
        <!-- 名前 -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">お名前</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="お名前" value="{{ input.name|e }}">
{% if error.name %}
　　　　　  <div class="alert alert-danger" role="alert">{{ error.name|e }}</div>
{% endif %}
          </div>
        </div>
        <!-- メールアドレス -->
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">メールアドレス</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="inputPassword3" name="address" placeholder="メールアドレス" value="{{ input.address|e }}">
{% if error.address %}
　　　　　  <div class="alert alert-danger" role="alert">{{ error.address|e }}</div>
{% endif %}
          </div>
        </div>
        <!-- 電話番号 -->
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">電話番号</label>
          <div class="col-sm-10">
            <input type="tel" class="form-control" id="inputPassword3" name="tel" placeholder="電話番号" value="{{ input.tel|e }}">
{% if error.tel %}
　　　　　  <div class="alert alert-danger" role="alert">{{ error.tel|e }}</div>
{% endif %}
          </div>
        </div>
        <!-- お問い合わせ内容 -->
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">お問い合わせ内容</label>
          <div class="col-sm-10">
            <textarea class="form-control" rows="3" name="content">{{ input.content|e }}</textarea>
{% if error.content %}
　　　　　  <div class="alert alert-danger" role="alert">{{ error.content|e }}</div>
{% endif %}
          </div>
        </div>
        <!-- 送信ボタン -->
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">送信</button>
          </div>
        </div>
      </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="Honoka-master/dist/js/bootstrap.min.js"></script>
  </body>
</html>

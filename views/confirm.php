<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>お問い合わせフォーム - 確認 -</title>
    <link href="Honoka-master/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <h1>お問い合わせフォーム - 確認 -</h1>
      <form class="form-horizontal" action="index.php" method="post">
        <input type="hidden" name="token" value="{{ token }}">
        <input type="hidden" name="action" value="confirm_submit">
        <dl class="dl-horizontal">
          <dt>件名</dt>
          <dd>{{ input.title|e }}</dd>
          <dt>お名前</dt>
          <dd>{{ input.name|e }}</dd>
          <dt>メールアドレス</dt>
          <dd>{{ input.address|e }}</dd>
          <dt>電話番号</dt>
          <dd>{{ input.tel|e }}</dd>
          <dt>お問い合わせ内容</dt>
          <dd>{{ input.content|e }}</dd>
        </dl>
        <!-- 確認ボタン -->
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">確認</button>
          </div>
        </div>
      </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="Honoka-master/dist/js/bootstrap.min.js"></script>
  </body>
</html>

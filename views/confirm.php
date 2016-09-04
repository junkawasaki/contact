<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
    <link href="Honoka-master/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <h1>お問い合わせフォーム - 確認ページ -</h1>
      <form class="form-horizontal" action="index.php" method="post">
        <input type="hidden" name="token" value="{{ token }}">
        <input type="hidden" name="action" value="complete">
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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="Honoka-master/dist/js/bootstrap.min.js"></script>
  </body>
</html>

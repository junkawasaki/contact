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
      <h1>お問い合わせフォーム - フォームページ -</h1>
      <form class="form-horizontal" action="index.php" method="post">
        <input type="hidden" name="token" value="{{ token }}">
        <input type="hidden" name="action" value="submit">
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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="Honoka-master/dist/js/bootstrap.min.js"></script>
  </body>
</html>

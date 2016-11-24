<html>
<head>
<meta charset="utf-8"/>
</head>
<body>
<h1>掲示板の投稿</h1>
<form action="/boards/done" method="post" enctype="multipart/form-data">


{!! csrf_field() !!}
タイトル<input type="text" name="title"><br>
本文<textarea name="content"></textarea>


<input type="submit" value="送信">
</form>

</body>
</html>
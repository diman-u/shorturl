<!DOCTYPE html>
<html lang="en"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://bootstrap-4.ru/favicon.ico">
    <title>Электронный журнал | Автогород43</title>
    <link href="{{url('/')}}/css/bootstrap.css" rel="stylesheet">
    <link href="{{url('/')}}/css/starter-template.css" rel="stylesheet">
    <link href="{{url('/')}}/css/styles.css" rel="stylesheet">
</head>
<body>
    <form method="post">
        {{ csrf_field() }}
        <div class="form-group col-3">
            <input type="text" class="form-control" placeholder="Введите url" name="url">
            <input type="submit" class="btn btn-primary" value="Получить">
        </div>
    </form>

    @if ($message = Session::get('info'))
        <div class="alert alert-danger alert-block col-5">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
</body>
</html>
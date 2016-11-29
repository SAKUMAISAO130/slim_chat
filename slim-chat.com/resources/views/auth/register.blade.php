{{-- resources/views/auth/register.blade.php --}}

@extends('layout')

@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">新規ユーザー登録</div>
<div class="panel-body">
@if (count($errors) > 0)
	<div class="alert alert-danger">
	<strong>Whoops!</strong> There were some problems with your input.<br><br>
	<ul>
	@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
		</ul>
		</div>
		@endif

		<form class="form-horizontal" role="form" method="POST" action="/auth/register">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group">
		<label class="col-md-4 control-label">ユーザー名</label>
		<div class="col-md-6">
		<input type="text" class="form-control" name="name" value="{{ old('name') }}">
		</div>
		</div>

		<div class="form-group">
		<label class="col-md-4 control-label">メールアドレス</label>
		<div class="col-md-6">
		<input type="email" class="form-control" name="email" value="{{ old('email') }}">
		</div>
		</div>

		<div class="form-group">
		<label class="col-md-4 control-label">パスワード</label>
		<div class="col-md-6">
		<input type="password" class="form-control" name="password">
		</div>
		</div>

		<div class="form-group">
		<label class="col-md-4 control-label">パスワード再入力</label>
		<div class="col-md-6">
		<input type="password" class="form-control" name="password_confirmation">
		</div>
		</div>

		<div class="form-group">
		<div class="col-md-6 col-md-offset-4">
		<button type="submit" class="btn btn-primary">
		ユーザー登録
		</button>
                {{-- 確認メール再送画面へのリンクを追加 --}}
                <a class="btn btn-link" href="{{ url('/auth/resend') }}">ユーザー登録確認メールを再送する</a>
		</div>
		</div>
		
		</form>
		</div><!-- .panel-body -->
		</div><!-- .panel -->
		</div><!-- .col -->
		</div><!-- .row -->
		</div><!-- .container-fluid -->
		@endsection
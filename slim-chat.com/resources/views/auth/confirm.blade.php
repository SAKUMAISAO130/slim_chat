{{-- resources/views/auth/confirm.blade.php --}}

@extends('layout')

@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">ユーザー登録確認メールの再送信</div>
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

		<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/resend') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group">
		<label class="col-md-4 control-label">メールアドレス</label>
		<div class="col-md-6">
		<input type="email" class="form-control" name="email" value="{{ old('email') }}">
		</div>
		</div>

		<div class="form-group">
		<div class="col-md-6 col-md-offset-4">
		<button type="submit" class="btn btn-primary">
		再送信
		</button>
		</div>
		</div>
		</form>
		</div>
		</div>
		</div>
		</div>
		</div>
		@endsection
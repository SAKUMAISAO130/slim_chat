<!-- resources/views/auth/password.blade.php -->
@extends('layout')

@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">パスワードのリセット</div>
<div class="panel-body">

<form class="form-horizontal" method="POST" action="/password/email">
{!! csrf_field() !!}

@if (count($errors) > 0)
	<ul>
	@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
		</ul>
		@endif

		<div class="form-group">
		<label class="col-md-4 control-label">Email</label>
		<input type="email" name="email" value="{{ old('email') }}">
		</div>

		<div class="form-group">
		<div class="col-md-6 col-md-offset-4">
		<button type="submit" class="btn btn-primary">
		パスワードリセットリンクの送信
		</button>
		</div>
		</div>
		</form>
		
</div>
</div>
</div>
</div>
</div>
</div>
		
		
		
@endsection
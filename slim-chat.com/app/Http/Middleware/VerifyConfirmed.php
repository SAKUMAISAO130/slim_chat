<?php // app/Http/Middleware/VerifyConfirmed.php
namespace App\Http\Middleware;

use Closure;
use App\User;

class VerifyConfirmed {
	public function handle($request, Closure $next)
	{
		$user = User::where('email', '=', $request->input('email'))->first();
		if ($user) {
			if(! $user->isConfirmed()) {
				\Session::flash('flash_message', 'ユーザー登録確認メールに従って、ユーザーを有効化してください。');
				return redirect()->back()->withInput($request->only('email'));
			}
		}

		return $next($request);
	}
}
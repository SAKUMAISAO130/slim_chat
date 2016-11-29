<?php



/**
 @startuml{plantuml_seq_sample_2.png}
 title シーケンス図のサンプル
 hide footbox

 actor ユーザー as user
 participant 制御部 as control <<Control>>
 participant "<u>Loader</u>" as model <<Model>>
 participant 画面 as view <<View>> #98FB98

 user -> control : 検索
 activate control
 create model
 control -> model : << new >>
 control -> model : データ検索
 activate model
 control <-- model : 検索結果
 note right : ヒットしたものをリストで返します。
 deactivate model
 destroy model

 control -> view : 表示(検索結果)
 activate view
 deactivate control
 loop 1, データ数
 view -> view : データの表示
 end
 view --> user
 deactivate view

 @enduml
 */



namespace App\Http\Controllers\Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

// 追加
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Config\Repository as Config;


class AuthController extends Controller
{
	/*
	 |--------------------------------------------------------------------------
	 | Registration & Login Controller
	 |--------------------------------------------------------------------------
	 |
	 | This controller handles the registration of new users, as well as the
	 | authentication of existing users. By default, this controller uses
	 | a simple trait to add these behaviors. Why don't you explore it?
	 |
	 */
	use AuthenticatesAndRegistersUsers, ThrottlesLogins;
	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'getLogout']);
	}
	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
				'name' => 'required|max:255',
				'email' => 'required|email|max:255|unique:users',
				'password' => 'required|confirmed|min:6',
		]);
	}
	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data)
	{
		return User::create([
				'name' => $data['name'],
				'email' => $data['email'],
				'password' => bcrypt($data['password']),
		]);
	}
	
	/**
	 * ③ 確認メールの送信
	 *
	 * @param Mailer $mailer
	 * @param User $user
	 */
	private function sendConfirmMail(Mailer $mailer, User $user)
	{
		$mailer->send(
				'emails.confirm',
				['user' => $user, 'token' => $user->confirmation_token],
				function($message) use ($user) {
					$message->to($user->email, $user->name)->subject('ユーザー登録確認');
				}
				);
	}
	
	/**
	 * ④ ユーザー登録アクション
	 * バリデーションチェックを行い、ユーザーを作成する
	 *
	 * @param Request $request
	 * @param Mailer $mailer
	 * @param Config $config
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postRegister(Request $request, Mailer $mailer, Config $config)
	{
		$validator = $this->validator($request->all());
	
		if ($validator->fails()) {
			$this->throwValidationException(
					$request, $validator
					);
		}
	
		$this->create($mailer, $request->all(), $config->get('app.key'));
	
		\Session::flash('flash_message', 'ユーザー登録確認メールを送りました。');
	
		return redirect('auth/login');
	}
	
	/**
	 * ⑤ ユーザーを確認済にする
	 *
	 * @param $token
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getConfirm($token) {
		$user = User::where('confirmation_token', '=', $token)->first();
		if (! $user) {
			\Session::flash('flash_message', '無効なトークンです。');
			return redirect('auth/login');
		}
	
		$user->confirm();
		$user->save();
	
		\Session::flash('flash_message', 'ユーザー登録が完了しました。ログインしてください。');
		return redirect('auth/login');
	}
	
	
	/**
	 * ① 確認メール再送画面を表示する
	 *
	 * @return \Illuminate\View\View
	 */
	public function getResend()
	{
		return view('auth.confirm');
	}
	
	/**
	 * ② 確認メールの再送信する
	 *
	 * @param Request $request
	 * @return $this|\Illuminate\Http\RedirectResponse
	 */
	public function postResend(Request $request, Mailer $mailer, Config $config)
	{
		$this->validate($request, ['email' => 'required|email']);
		$user = User::where('email', '=', $request->input('email'))->first();
		if(! $user) {
			return redirect()->back()
			->withInput($request->only('email'))
			->withErrors(['email' => trans('passwords.user')]);
		}
		if($user->isConfirmed()) {
			\Session::flash('flash_message', '既に、ユーザー登録が完了しています。ログインしてください。');
			return redirect('auth/login');
		}
	
		$this->sendConfirmMail($mailer, $user);
	
		\Session::flash('flash_message', 'ユーザー登録確認メールを送りました。');
		return redirect()->guest('auth/login');
	}
	
	
}
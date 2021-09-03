<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\{Hash, Session, Validator, Cookie};
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /** @inheritDoc */
    public function showRegistrationForm()
    {
        if (request('ref')) {
            Cookie::queue('referral', request('ref'), 60 * 24 * 3);
        }

        $referral = User::firstWhere('ref_code', request('ref', Cookie::get('referral')));

        return view('auth.register', ['referral' => $referral]);
    }

    /**
     * Полуить валидатор для запроса
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:2', 'max:128'],
            'surname' => ['required', 'string', 'min:2', 'max:128'],
            'email' => ['required', 'string', 'email', 'max:128', 'unique:users'],
            'phone' => ['required', 'string', 'min:10', 'max:128'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Создать экземпляр нового пользователя после прохождения регистрации
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        $newUser = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'locale' => Session::get('locale', config('app.locale')),
            'password' => Hash::make($data['password']),
        ]);

        $referralAncestor = Cookie::has('referral')
            ? User::where('ref_code', Cookie::get('referral'))->first()
            : null;

        if ($referralAncestor) {
            $referralAncestor->appendNode($newUser);
        }

        return $newUser;
    }

    /** @inheritDoc */
    protected function registered(Request $request, User $user)
    {
        $referralAncestor = User::query()
            ->where('ref_code', Cookie::get('referral'))->first();

        Cookie::queue(Cookie::forget('referral'));

        if ($referralAncestor) {
            $referralAncestor->sendNotification(trans('messages.new_referral', [
                'name' => $user->getFullName(),
                'email' => $user->email,
                'phone' => $user->phone,
            ], $referralAncestor->locale));
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SignUpMail;
use App\Models\AdminLogin;
use App\Models\ArchivedUser;
use App\Models\Customer;
use App\Models\User;
use App\Notifications\NewRegistrationNotification;
use App\Notifications\OrderPlacedNotification;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

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

//    use RegistersUsers;

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
        $this->middleware('web')->except('logout');
    }

    public function showRegistrationForm()
    {
        return view('auth.admin.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $input = $request->all();
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }
        Mail::to('jimipulsar@github.com')
            ->send(new SignUpMail($user));

        $userAdmin = User::find(1);

        $details = [
            'greeting' => 'You have received a new registration from Test Project',
            'body' => 'Click the button below to view registered users',
            'thanks' => 'Thanks!',
            'subject' => 'New registration on the website',
            'actionText' => 'Reserved Area',
            'actionURL' => url(env('APP_URL') . env('APP_ADMIN_URL')),
            'email' => $user->email,
            'billing_name' => $user->billing_name
        ];
        Notification::send($userAdmin, new NewRegistrationNotification($details));
//        $current_timestamp = Carbon::now()->toDateTimeString();
//        $minutesAdded = Carbon::now()->addMinutes(5);
        ;

        return redirect()->route('home')->with('success', 'Registration done!');
//
//        return $request->wantsJson()
//            ? new JsonResponse([], 201)
//            : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
//            'g-recaptcha-response' => 'required'

        ]);
    }

    protected function create(array $data)
    {

        return User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
        ]);

    }

    // return redirect()->route('home')->with('success', 'Registrazione avvenuta');

    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
}

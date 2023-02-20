<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails, RedirectsUsers;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function verify($id)
    {
        //  dd($remember_token);

        $verifyUser = User::where('id', $id)->first();

        $message = 'Sorry your email cannot be identified' ;
//   dd($verifyUser);
        if($verifyUser ){

            if($verifyUser->email_verified_at == null)         {
                $verifyUser->email_verified_at = now();
                // $verifyUser->user->is_email_verified = 1;
                // dd($unput);

                $verifyUser->save();

                $message = "Thank you for activating your email, please start using our portal services.";
            } else {
                $message = "Your e-mail is already verified.";
            }
        }

        return view('auth.admin.login')->with('success', $message);
    }
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('auth.admin.verification.notice', [
                'pageTitle' => __('Account Verification')
            ]);
    }

}

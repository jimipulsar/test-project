<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SignUpMail;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(['web'], ['except' => [ 'show']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        if (Auth::guard('web')->check()) {
            $users = User::orderBy('id', 'DESC')->paginate(15);
            $currentNotice = Notification::where('read_at', '=', null)->first();

            if (!empty($currentNotice)) {
//                $currentNotice->read_at = Carbon::now();
//                $currentNotice->save();
                $currentNotice->delete();
            }

            if (!$users) {
                abort(404);
            }
            return view('auth.admin.users.index', ['users' => $users]);
        } else {
            return redirect()->route('index');
        }

    }

    public function create()
    {
        $user = User::all();
        if (!$user) {
            abort(404);
        }
        return view('auth.admin.users.create', ['user' => $user]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required']);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['ip_address'] = request()->ip();
        $user = User::create($input);
        Mail::to('jimipulsar@github.com')
            ->send(new SignUpMail($user));
        event(new Registered($user));
        return redirect()->route('users.index')->with('success', 'Utente creato con successo');
    }


    public function show($id)
    {

        $customer = User::findOrFail($id);


        return view('auth.admin.users.show', [
            'customer' => $customer
        ]);

    }


    public function edit($id)
    {
        $user = User::find($id);

        return view('auth.admin.users.edit', compact('user',));

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        /**
         * fetching the user model
         */
        $this->validate($request, ['name' => 'required', 'email' => 'required|email|unique:customers,email,' . $id]);
        $customer = User::findOrFail($id);


        $customer->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'confirm-password' => $request->input('confirm-password'),
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {

            $input['password'] = Hash::make($input['password']);

        }

        $customer->save();

        return redirect()->route('users.index', ['customer' => $customer])->with('success', 'Utente modificato con successo');

    }

    public function destroy($id)
    {
        if (auth()->guard('web')->user()) {
            User::findOrFail($id)->delete();

            return redirect()->route('users.index')
                ->with('success', 'User deleted');
        } else {
            abort(404);
        }
    }
}

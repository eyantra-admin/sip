<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Log;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        log::info($request->email);
        if (DB::table('dummy_emailid')->where('emailid', $request->email)->exists()) 
        {
            event(new Registered($user = $this->create($request->all())));

            $this->guard()->login($user);

            if ($response = $this->registered($request, $user)) {
                return $response;
            }

            return $request->wantsJson()
                        ? new JsonResponse([], 201)
                        : redirect($this->redirectPath());
        }
        else{
            return back()->withErrors('This email id is not registered with us, kindly use email id that was used by you in the competitions.');
        }

        
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
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}

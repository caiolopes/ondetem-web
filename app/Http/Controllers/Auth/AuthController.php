<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use JWTAuth, Validator;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'password' => 'required|min:6|confirmed',
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


    public function refresh(Request $request) {
        if (!JWTAuth::parser()->setRequest($request)->hasToken()) {
            return response()->json(['error' => 'Token not provided'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $token = JWTAuth::parseToken()->refresh();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(compact('token'));
    }

    public function logout() {
        try {
            $token = JWTAuth::parseToken()->getToken();
            JWTAuth::invalidate($token);
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['error' => 'token_absent'], $e->getStatusCode());
        }
        return response()->json([], Response::HTTP_OK);
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request|Request $request
     */
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => [
                    'message'     => $validator->messages()
                ]],
                Response::HTTP_BAD_REQUEST,
                $headers = []
            );
        }
        $credentials = $this->getCredentials($request);

        try
        {
            // attempt to verify the credentials and create a token for the user
            if ( ! $token = JWTAuth::attempt($credentials))
            {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        }
        catch (JWTException $e)
        {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'Could not create token'], 500);
        }
        // all good so return the token
        $user = JWTAuth::user();
        return response()->json(['token' => $token, 'user' => $user], Response::HTTP_OK);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request|Request $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only('email', 'password');
    }
}

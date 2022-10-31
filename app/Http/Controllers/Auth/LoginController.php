<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\TokenController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LibraryController;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use \GuzzleHttp\Psr7\Request as RequestGuzzle;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autentication(Request $request)
    {


        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'teste' => 'Usuário ou Senha incorreto!',
        ]);

        // Log::debug("autentication");

        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required'
        // ]);
        // $head = [
        //     'Content-Type' => 'application/json',
        //     'Accept' => 'application/json'
        // ];
        // $bodyRequest = $request->only(['email', 'password']);
        // $body = json_encode($bodyRequest);

        // $credentials = [];

        // Log::debug("GABRIEL");

        // try {
        //     // $client = new Client();
        //     // $requestUser = new RequestGuzzle('POST', env('END_POINT_BACKEND') . '/api/login/user', $head, $body);
        //     // $promiseCredentials = $client->sendAsync($requestUser)->then(function ($response) {
        //     //     return json_decode($response->getBody()->getContents(),true);
        //     // });
        //     // $credentials = $promiseCredentials->wait();

        //     $teste = AuthController::class;

        //     Log::debug($credentials);

        //     Log::debug("OPA");

        //     return redirect(route('home'));

        // } catch (Exception $e) {
        //     Session::put('fail', 'Email ou senha incorreto');
        //     return view('auth.login', ['credential' => $credentials]);
        // }
        // $tokenController = new TokenController;
        // $tokenController->setCredentials($credentials);
        // $expires_in = Carbon::now()->addSeconds(($credentials['expires_in'] - env('SESSION_EXPIRE')))->format('Y-m-d H:i:s');
        // Session::put('expires_in', $expires_in);
        // Log::debug("PASSOU AQUI");
        // return redirect(route('home.index'));
    }

    public static function logout()
    {

        LibraryController::requestAsync('POST', '/api/logout');
        Session::forget('credentials');
        Session::forget('nameUser');
        Session::forget('last_activity');
        return redirect(route('login'));
    }

    public static function refresh()
    {
        $libraryController = new LibraryController;
        $credentials = $libraryController->requestAsync('POST', '/api/refresh');

        Session::forget('credentials');
        Session::forget('nameUser');
        if (isset($credentials['error'])) {
            Session::put('fail', 'Email ou senha incorreto');
            return view('auth.login', ['credential' => $credentials]);
        }
        $expires_in = Carbon::now()->addSeconds(($credentials['expires_in'] - env('SESSION_EXPIRE')))->format('Y-m-d H:i:s');
        Session::put('credentials', $credentials);
        Session::put('expires_in', $expires_in);
    }
}

<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

//$router->get('/', function () use ($router) {
//    return $router->app->version();
//});


\Illuminate\Support\Facades\Route::get('/', function () {

    $users = \App\Models\User::with('Profile', 'Transaction')->get();

    return view('index', ['users' => $users]);
});

\Illuminate\Support\Facades\Route::get('add', function (\Illuminate\Http\Request $request) {

    $users = \App\Models\User::with('Profile', 'Transaction')->get();
    return view('add', ['users' => $users]);
});
//В зависимости от выбранного знака выбирается нужный if и просиходит операция
\Illuminate\Support\Facades\Route::post('done', function (\Illuminate\Http\Request $request) {
    if ($request->value == '+') {
//        dd($request);
        $profile = \App\Models\Profile::query()->select()->where('user_id', '=', $request->id)->get();
        $profile[0]['balance'] += $request->transaction;
        $profile = \App\Models\Profile::query()->select()->where('user_id', '=', $request->id)->update(['balance' => $profile[0]['balance']]);
        $transaction = \App\Models\Transaction::query()->select()->where('user_id', '=', $request->id)->update(['value' => $request->transaction, 'description' => 'Пополнение на сумму ' . $request->transaction . ' рублей']);
    } elseif ($request->value == '-') {
        $profile = \App\Models\Profile::query()->select()->where('user_id', '=', $request->id)->get();
        $profile[0]['balance'] -= $request->transaction;
        $profile = \App\Models\Profile::query()->select()->where('user_id', '=', $request->id)->update(['balance' => $profile[0]['balance']]);
        $transaction = \App\Models\Transaction::query()->select()->where('user_id', '=', $request->id)->update(['value' => '-' . $request->transaction, 'description' => 'Списание на сумму ' . $request->transaction . ' рублей']);
    } elseif ($request->value == 'cancel') {

    }
    return redirect('/');
});

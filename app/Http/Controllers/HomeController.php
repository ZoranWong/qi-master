<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dingo\Api\Dispatcher;
<<<<<<< HEAD
=======
use Dingo\Api\Routing\Helpers;
>>>>>>> 530dce36ec2cdbde45fa1533280d465cbb5a3597


class HomeController extends Controller
{
<<<<<<< HEAD
=======
    use Helpers, ApiDispatcher;

>>>>>>> 530dce36ec2cdbde45fa1533280d465cbb5a3597
    //
    public function index()
    {
        /**@var User $user * */
        $user = auth()->user();
        /**@var Dispatcher $dispatcher * */
        $dispatcher = $this->dispatcher();
        try {
            $user = $dispatcher->get('/users/profile');
<<<<<<< HEAD
        }catch (\Exception $exception){
=======

        } catch (\Exception $exception) {
>>>>>>> 530dce36ec2cdbde45fa1533280d465cbb5a3597
        }
        $view = null;
        if (isMobile()) {
            $view = view('h5.index');
        } else {
            $view = view('web.index')->with([
                'selected' => '',
                'currentMenu' => ''
            ]);
        }
        $orders = $user->orders()->with(['items', 'offerOrders'])->offset(0)->limit(10)->get();
        $view->with('user', $user)->with('orders', $orders);
        return $view;
    }

    public function register()
    {
        if (isMobile()) {
            return view('h5.register');
        } else {
            return view('web.register');
        }

    }

    public function forgetPassword()
    {
        if (isMobile()) {
            return view('web.forgetpsw');
        } else {
            return view('web.forgetpsw');
        }
    }

    public function login()
    {
        if (!auth()->guest()) {
            return redirect(route('home'));
        }
        if (isMobile()) {
            return view('h5.login')->with([
                'loginRoute' => route('user.login'),
                'homePage' => route('home')
            ]);
        } else {
            return view('web.login')->with([
                'loginRoute' => route('user.login'),
                'homePage' => route('home')
            ]);
        }
    }
}

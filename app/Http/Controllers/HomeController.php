<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class HomeController extends Controller
{
    protected $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $user)
    {
        $this->user = $user;
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      
        $users = $this->user->index();
        dd($users);
       // return view('home');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->user->store($request->all());
        return redirect('/users');
    }

    public function show($id)
    {
        $user = $this->user->show($id);
        dd($user);
        //return view('users.show', [ 'user' => $user ]);
    }

    public function edit($id)
    {
        $user = $this->user->show($id);
        return view('users.edit', [ 'user' => $user ]);
    }

    public function update(Request $request, $id)
    {
        $this->user->update($request->all(), $id);
        return redirect('/users');
    }

    public function destroy($id)
    {
        $this->user->destroy($id);
        return redirect('/users');
    }

    
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\ImgService;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
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

    use RegistersUsers;

    /**
     * @var ImgService
     */
    private $imgService;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/profile" ;

    /**
     * RegisterController constructor.
     * @param ImgService $imgService
     */
    public function __construct(ImgService $imgService)
    {
        $this->middleware('guest');
        $this->imgService = $imgService;
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
            'name' => ['required', 'string', 'max:25'],
            'phone' => 'required|min:6|numeric',
            'surname' => ['required', 'string', 'max:25'],
            'nickname' => ['required', 'string', 'max:25','unique:users'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'avatar'  => 'required|image|mimes:jpeg,png|max:2048'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $icon = request()->file('avatar');

        if ($icon) {
            $fileName = $this->imgService->saveResizeImage($icon);
        }

        /*if ($icon) {
            $fileName = $icon->getClientOriginalName();
            Storage::disk('avatars')->put($fileName,  File::get($icon));
        }*/

        return User::create([
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'surname'=>$data['surname'],
            'phone'=>$data['phone'],
            'sex'=>$data['sex'],
            'avatar' => $fileName ?? ''
        ]);
    }
}

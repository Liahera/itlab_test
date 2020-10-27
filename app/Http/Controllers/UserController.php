<?php

namespace App\Http\Controllers;

use App\Http\Services\ImgService;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{

    /**
     * @var ImgService
     */
    private $imgService;
    public function __construct(ImgService $imgService)
    {
        $this->imgService=$imgService;
    }
    public function profile()
  {
      return view('profile');
  }
  public function edit()
  {
      return view('editProfile');
  }
  public function editRequest()
  {
      $data = request()->validate([
          'name' => ['required', 'string', 'max:25'],
          'phone' => 'required|min:6|numeric',
          'surname' => ['required', 'string', 'max:25'],
          'nickname' => ['required', 'string', 'max:25',],
          'email' => ['required', 'string', 'email', 'max:50', ],
          'avatar'  => '|image|mimes:jpeg,png|max:2048'
      ]);

      $icon = request()->file('avatar');

      if ($icon) {
          $fileName = $this->imgService->saveResizeImage($icon);
      }

      $data['avatar'] = $fileName ?? '';

      $user = Auth::user();
      $user->update($data);
      return view('profile');
  }
}

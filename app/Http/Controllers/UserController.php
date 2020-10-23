<?php

namespace App\Http\Controllers;

use App\Http\Services\ImgService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


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
          "name" => "required|max:255",
          "email" => 'required|email',
          "surname" => "required|max:255",
          "nickname" => "required|max:255",
          "phone" => "required",
          "sex" => "required",
          "avatar"=>"required",
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

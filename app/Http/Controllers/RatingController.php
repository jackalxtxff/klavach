<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index()
    {
        $paginate = 20;
        $user = null;
        $page = null;
        $profiles = Profile::orderBy('avg_speed', 'DESC')->paginate($paginate);
        $showMe = Profile::orderBy('avg_speed', 'DESC')->get();
        for ($i = 0; $i < count($showMe); $i++) {
            if ($showMe[$i]->id == Auth::id()) {
                $page = ceil(($i + 1) / $paginate);
                $user = $showMe[$i];
            }
        }

        return view('user.pages.rating.rating',[
            'profiles' => $profiles,
            'page' => $page,
            'user' => $user
        ]);
    }
}

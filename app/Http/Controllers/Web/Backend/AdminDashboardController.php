<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AdminDashboardController extends Controller
{
    public function index() {
        /* $user= User::where('role','admin')->count('id');
        return view('backend.layout.dashboard',['user'=>$user]); */
        return view('backend.layout.dashboard');
    }

   
}

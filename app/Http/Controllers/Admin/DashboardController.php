<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startOfWeek = $now->startOfWeek();
        $startOfLastWeek = $startOfWeek->copy()->subWeek();
        $endOfLastWeek = $startOfWeek->copy()->subDay();

        $usersThisWeek = User::where('created_at', '>=', $startOfWeek)->count();
        $usersLastWeek = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
        $userGrowthRate = $usersLastWeek > 0 ? (($usersThisWeek - $usersLastWeek) / $usersLastWeek) * 100 : ($usersThisWeek > 0 ? 100 : 0);

        $postsThisWeek = Post::where('created_at', '>=', $startOfWeek)->count();
        $postsLastWeek = Post::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
        $postGrowthRate = $postsLastWeek > 0 ? (($postsThisWeek - $postsLastWeek) / $postsLastWeek) * 100 : ($postsThisWeek > 0 ? 100 : 0);

        $userCount = User::count();
        $postCount = Post::count();

        return view('pages.admin.dashboard', compact('postCount', 'userCount', 'userGrowthRate', 'postGrowthRate'));
    }
}

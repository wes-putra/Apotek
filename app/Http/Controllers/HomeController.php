<?php
  
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Obat;
use App\Models\User; 
  
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function admin(): View
    {
        $obats = Obat::all();
        return view('admin.adminhome', compact('obats'));
    } 
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function super(): View
    {
        $totalUsers = User::count();
        $totalObats = Obat::count();

        return view('super.dashboard', compact('totalUsers', 'totalObats'));
    }
  
}
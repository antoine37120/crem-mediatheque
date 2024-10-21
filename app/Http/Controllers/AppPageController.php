<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CmsPage;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AppPageController extends Controller
{
    
    public function show(string $slug): View
    {
        return view('app-pages.page', [
            'page' => CmsPage::where('slug', $slug)->firstOrFail()
        ]);
    }
}

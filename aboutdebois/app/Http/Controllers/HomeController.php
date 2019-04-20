<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    protected $uploadsFolder = 'uploads/';
    protected $thumbsFolder = 'thumbs/';
    /**
     * 
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
    public function index(ImageRepository $repository)
    {
        $images = $repository->getAll();
        $this->clearStorage($images, $this->uploadsFolder);
        $this->clearStorage($images, $this->thumbsFolder);
        return view('home', compact('images'));
    }

    /**
     * Check if files name stored in storage folder is present in database if not erase from storage
     *
     * @return void
     */
    private function clearStorage($images, $folder)
    {
        $files = Storage::files($folder);
        if (empty($images->items())) {
            Storage::delete($files);
        }
    }
}
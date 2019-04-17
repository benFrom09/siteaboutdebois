<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use App\Repositories\CategoryRepository;

class GaleryController extends Controller
{

    protected $categorieRepository;
    protected $imageRepository;

    public function __construct(CategoryRepository $categoryRepository, ImageRepository $imageRepository)
    {
        $this->categorieRepository = $categoryRepository;
        $this->imageRepository = $imageRepository;
    }
    //
    public function create()
    {
        return view('Admin.page.galerie.create');
    }

    public function store(Request $request)
    {

        $validate = $request->validate([
            'image' => 'required|image|max:2500',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:255'
        ]);

        $this->imageRepository->store($validate);

        return back()->with('ok', __('L\'image a bien été enregistrée'));
    }

    public function category($slug)
    {
        $category = $this->categorieRepository->getBySlug($slug);
        $images = $this->imageRepository->getByCategory($category);
        return view('home', compact('category', 'images'));
    }
}
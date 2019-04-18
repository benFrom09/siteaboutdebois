<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\CategoryRepository;

class GaleryController extends Controller
{

    protected $categorieRepository;
    protected $imageRepository;
    protected $uploadsFolder = 'uploads/';
    protected $thumbsFolder = 'thumbs/';

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

    public function destroy(Image $image)
    {
        $status = $image->delete();

        if ($status) {
            Storage::delete($this->uploadsFolder . $image->name);
            Storage::delete($this->thumbsFolder . $image->name);
            return response()->json('Le fichier ' . $image->name . ' a bien été supprimé!');
        }
    }

    public function edit(Image $image)
    {

        return view('Admin.page.galerie.edit', compact('image'));
    }

    public function get(Image $image)
    {
        return $image;
    }

    public function update(Request $request, Image $image)
    {
        if ($request->description) {
            $validate = $request->validate([
                'description' => 'nullable|string|max:255',
            ]);
        }
        $image->update($request->all());


        return $image;
    }
}
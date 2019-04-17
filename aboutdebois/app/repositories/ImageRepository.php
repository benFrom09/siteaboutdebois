<?php
namespace App\Repositories;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

class ImageRepository extends BaseRepository
{
    public function __construct(Image $image)
    {
        $this->model = $image;
    }

    public function store($request)
    {
        //save image
        $path = basename($request['image']->storeAs('uploads', $request['image']->getClientOriginalName()));
        //save miniature
        $thumb = InterventionImage::make($request['image'])->widen(500)->encode();
        Storage::put('thumbs/' . $path, $thumb);
        //save in database
        Image::updateOrCreate([
            "name" => $path,
            "description" => $request['description'],
            "category_id" => $request['category_id'],
            "published" => false,
        ]);
    }

    /**
     * get all images
     *
     * @return Illuminate\Pagination\LenthAwarePaginator
     */
    public function getAll()
    {
        return Image::Paginate(config('app.paginate'));
    }

    public function getByCategory($category)
    {

        return Image::where('category_id', $category->id)->paginate(config('app.paginate'));
    }
}
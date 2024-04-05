<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();

        return view('news.index', [
            'news' => $news
        ]);
    }
 
    public function view( int $id)
    {
        $news = News::findOrFail($id);

        return view('news.view', [
            'news' => $news
        ]);
    }

    public function formCreate()
    {
      return view('news.create');  
    }

    public function processCreate(Request $request)
    {
        $request->validate(News::$rules, News::$errorMessages);

        $data = $request->except(['_token']);

        if($request->hasFile('image')) {
            $uploadedImage  = $request->file('image');

            /**
             * Redimencíon de imagen small
             */
            $smallImageName      = 'small-' . $uploadedImage->hashName();
            $resizedSmallImage   = Image::make($uploadedImage)->fit(400, 200)->encode('jpg');
            Storage::put('imgs/' . $smallImageName, $resizedSmallImage);
            $data['image_small'] = 'imgs/' . $smallImageName;

            /**
             * Redimencíon de imagen normal
             */
            $normalImageName      = 'normal-' . $uploadedImage->hashName();
            $resizedNormalImage   = Image::make($uploadedImage)->fit(500, 450)->encode('jpg');
            Storage::put('imgs/' . $normalImageName, $resizedNormalImage);
            $data['image'] = 'imgs/' . $normalImageName;
        }

        News::create($data);

        return redirect()
            ->route('news.dashboard')
            ->with('status.message', 'La noticia <b>' . e($data['title']) . '</b> se publicó correctamente');
    }

    public function formEdit(int $id)
    {
        $news = News::findOrFail($id);

        return view('news.edit', [
            'news' => $news
        ]);
    }

    public function processEdit(int $id, Request $request)
    {
        $news = News::findOrFail($id);

        $request->validate(News::$rules, News::$errorMessages);

        $data = $request->except(['_token']);

        if($request->hasFile('image')) {
            if($news->image && Storage::has($news->image)) {
                Storage::delete($news->image);
                Storage::delete($news->image_small);
            }

            $uploadedImage  = $request->file('image');
            $imageName      = 'normal-' . $uploadedImage->hashName();
            $resizedImage   = Image::make($uploadedImage)->fit(500, 450)->encode('jpg');
            Storage::put('imgs/' . $imageName, $resizedImage);
            $data['image'] = 'imgs/' . $imageName;

            $uploadedImage  = $request->file('image');
            $imageName      = 'small-' . $uploadedImage->hashName();
            $resizedImage   = Image::make($uploadedImage)->fit(400, 200)->encode('jpg');
            Storage::put('imgs/' . $imageName, $resizedImage);
            $data['image_small'] = 'imgs/' . $imageName;

        } else {
            $data['image'] = $news->image;
            $data['image_small'] = $news->image_small;

        }

        $news->update($data);

        return redirect()
            ->route('news.dashboard')
            ->with('status.message', 'La noticia <b>' . e($data['title']) . '</b> se editó correctamente');

    }

    public function formDelete(int $id)
    {
        $news = News::findOrFail($id);

        return view('news.delete', [
            'news' => $news
        ]);

    }
    public function processDelete(int $id)
    {
        $news = News::findOrFail($id);

        $news->delete();

        if($news->image && Storage::has($news->image)) {
            Storage::delete($news->image);
            Storage::delete($news->image_small);
        }

        return redirect()
            ->route('news.dashboard')
            ->with('status.message', 'La noticia <b>' . e($news->title) . '</b> se eliminó correctamente');

    }

    public function dashboard()
    {
        $news = News::all();

        return view('news.dashboard', [
            'news' => $news
        ]);
    }
}

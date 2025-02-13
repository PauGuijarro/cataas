<?php

namespace App\Http\Controllers;

use App\Models\CatImage;

class CatImageController extends Controller
{
    /**
     * Mostra la galeria de gats des de la base de dades.
     */
    public function index()
    {
        $cats = CatImage::paginate(6);
        return view('cats.index', compact('cats'));
    }

    public function filterByTag($tag)
    {
        $cats = CatImage::all();

        $filteredCats = $cats->filter(function ($cat) use ($tag) {
            $tags = json_decode($cat->tags);
            return in_array($tag, $tags);
        });

        $perPage = 6;
        $catsPaginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $filteredCats->forPage(request()->get('page', 1), $perPage),
            $filteredCats->count(),
            $perPage,
            request()->get('page', 1)
        );

        $catsPaginated->withPath(route('cats.filter', $tag));

        return view('cats.index', ['cats' => $catsPaginated]);
    }
}

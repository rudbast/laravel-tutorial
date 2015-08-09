<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;

class TagsController extends Controller
{
    /**
     * Show articles related to tag
     *
     * @param  Tag    $tag
     * @return Response
     */
    public function show(Tag $tag)
    {
        $data['articles'] = $tag->articles()->published()->get();

        return view('articles.index', $data);
    }
}

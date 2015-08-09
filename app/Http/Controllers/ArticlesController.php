<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Request;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Tag;
use Auth;
use Carbon\Carbon;

class ArticlesController extends Controller
{
    /**
     * Create a new articles contorller instance
     */
    public function __construct()
    {
        // associate a middleware
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Show all articles.
     *
     * @return Response
     */
    public function index()
    {
        // if (!\Auth::check()) {
        //     return redirect('auth/login');
        // }
        // $data['articles'] =
        //     Article::latest('published_at')
        //         ->where('published_at', '<=', Carbon::now())
        //         ->get();
        $data['articles'] = Article::latest('created_at')->published()->get();

        // $data['latest'] = Article::latest()->first();

        return view('articles.index', $data);
    }

    /**
     * Show a single article.
     *
     * @param  Article $article
     * @return Response
     */
    // public function show($id)
    public function show(Article $article)
    {
        // if (!\Auth::check()) {
        //     return redirect('auth/login');
        // }

        // $data['article'] = Article::findOrFail($id);
        /**
         * Using model binding
         */
        $data['article'] = $article;

        // dd($data['article']->published_at);

        // if (is_null($article)) {
        //     App::abort(404, 'Articles was not found. Our bad.');
        // }

        return view('articles.show', $data);
    }

    /**
     * Create new article.
     *
     * @return Response
     */
    public function create()
    {
        // if (!\Auth::check()) {
        //     return redirect('auth/login');
        // }

        $data['tags'] = Tag::lists('name', 'id');

        return view('articles.create', $data);
    }

    /**
     * Save new article
     *
     * @param  CreateArticleRequest $request
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        /**
         * Validation was triggered here by ArticleRequest automatically
         */

        // $input = Request::all();
        // $input['published_at'] = Carbon::now();
        //
        // Article::create(Request::all());

        // Article::create($request->all());  // need a user_id

        /**
         * Using authentication in form request
         */
        // $article = new Article($request->all()); // User's id is set automatically

        $this->createArticle($request);

        /**
         * Flash a notification using session
         */
        // $request->session()->flash('flash_message', 'Your article has been created!');
        // $request->session()->flash('flash_message_important', true);

        return redirect('articles')->with([
            'flash_message' => 'Your article has been created',
            // 'flash_message_important' => true,
        ]);
    }

    /**
     * Edit current article
     *
     * @param  Article $article
     * @return Response
     */
    // public function edit($id)
    public function edit(Article $article)
    {
        // if (!\Auth::check()) {
        //     return redirect('auth/login');
        // }
        // $data['article'] = Article::findOrFail($id);

        $data['article'] = $article;
        $data['tags'] = Tag::lists('name', 'id');
        return view('articles.edit', $data);
    }

    /**
     * Update edited article
     *
     * @param  Article $article
     * @param  ArticleRequest $request
     * @return Redirect
     */
    // public function update($id, ArticleRequest $request)
    public function update(Article $article, ArticleRequest $request)
    {
        // $article = Article::findOrFail($id);
        $article->update($request->all());

        $tagIds = $request->input('tag_list');  // get tag ids
        $this->syncTags($article, $tagIds);

        return redirect('articles')->with([
            'flash_message' => 'Your article has been updated',
            // 'flash_message_important' => true,
        ]);
    }

    /**
     * Save a new article
     *
     * @param  ArticleRequset $request
     * @return mixed
     */
    public function createArticle(ArticleRequset $request)
    {
        $article = Auth::user()->articles()->create($request->all());

        $tagIds = $request->input('tag_list');  // get tag id
        $article->tags()->attach($tagIds);  // associate tag ids with the article

        return $article;
    }

    /**
     * Re-associate tag ids with the related article
     *
     * @param  Article $article
     * @param  array   $tags
     */
    public function syncTags(Article $article, array $tags)
    {
        $article->tags()->sync($tags);
    }
}

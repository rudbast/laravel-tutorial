# NOTES
Important commands related to Laravel 5 Tutorials, specifically 5.1

## Tinker
Tinkering around with PHP
```BASH
php artisan tinker
```

## Database
Related settings in `.env` file

### Migration
[Related docs](http://laravel.com/docs/5.1/migrations)

1.  Create new migration
    ```BASH
    php artisan make:migration create_articles_table --create="articles"
    ```

2.  Push migration
    ```BASH
    php artisan migrate
    ```

3.  Undo migration
    ```BASH
    php artisan migrate:rollback
    ```

4.  Making new migration to certain table
    ```BASH
    php artisan make:migration add_excerpt_to_articles_table --table="articles"
    ```

### Eloquent (ORM)
Created model will be extended from a default `Model.php` class, which includes a bunch of default methods, review when necessary.
[Related docs](http://laravel.com/docs/5.1/eloquent)

1.  Create a `model`
    ```BASH
    php artisan make:model Article
    ```
2.  Plugin for timestamps
    ```PHP
    Carbon\Carbon::now();
    ```
3.  Creating model
    *  Basic
        ```PHP
        $article = new App\Article;
        ```
    *  Pre-added values
        ```PHP
        $article = App\Article::create(['title' => 'New Article', 'body' = > 'New body']);
        ```
    **Remember**
    Add fillable property inside related model class to avoid `MassAssignment` exception and security breaches. In this case, inside the `App/Article.php` file
    ```PHP
    protected $fillable = ['title', 'body'];
    ```
4.  Saving `model`
    ```PHP
    $article->save();
    ```
5.  Updating `model`
    ```PHP
    $article->update(['body' => 'Updated']);
    ```
6.  Find a `model` using `id`
    ```PHP
    $article = App\Article::find(2);
    ```
7.  Using scope to automatically set things by laravel. Define function in the following format ```set{AttributeName}Attribute({$data})```. With the code body below
    ```PHP
    $this->attributes['password'] = mcrypt($password);
    ```
8.  Define relationship in model class, with a proper function name and a code body below
    ```PHP
    return $this->hasMany('App\Article');
    ```
9.  Using relationship for `User` to save an `Article` of it's own.
    ```PHP
    \Auth::user()->articles()->save($article);
    ```
    Usually would need to get the `User`'s id, but since it's already defined in the relationship, process would be automated
10. Many to many relationship between `Article` and `Tag`
    Use `belongsToMany` as the relationship type in the current `Model`
    ```PHP
    public function {otherModel}s()
    {
        return $this->belongsToMany('App\{otherModel}');
    }
    ```
    Add code below into created migration file
    ```PHP
    /**
     * Format :
     * {singularNameTableOne}_{singularNameTableTwo}
     * Ordered alphabetically
     */
    Schema::table('article_tag', function (Blueprint $table) {
        $table->foreign('article_id')
              ->references('id')
              ->on('articles')
              ->onDelete('cascade');
        $table->foreign('tag_id')
              ->references('id')
              ->on('tags')
              ->onDelete('cascade');
    });
    ```
    Hook them up using `$article->tags()->attach({otherModelId})` and vice versa `$tag->articles()->attach({otherModelId})`

## DEBUG mode
Disable debug mode when in production. Change code below in `.env`
```BASH
APP_DEBUG=false
```

## FORM
Use [Illuminate/Html](https://github.com/illuminate/html) package using Composer
```BASH
composer require illuminate/html
```

[Related docs](http://laravelcollective.com/docs/5.1/html)

Tag open `{!! Form::open() !!}`, tag close `{!! Form::close() !!}`, CSRF tag added automatically using this tag.

Add code below into ```config\app.php``` file
1.  in `providers`
    ```PHP
    Illuminate\Html\HtmlServiceProvider::class,
    ```
2.  in `aliases`
    ```PHP
    'Form'      => Illuminate\Html\FormFacade::class,
    'Html'      => Illuminate\Html\HtmlFacade::class,
    ```
    Illuminate handles all form securities, **NO** SQL injection.

### Validation
1.  Do validation in server side using `Request` class
    ```PHP
    php artisan make:request ArticleRequest
    ```
2.  Insert code below into the `rules()` function
    ```PHP
    return [
        'title'         => 'required|min:3',
        'body'          => 'required',
        'published_at'  => 'required|date',
    ];
    ```
3.  Or use a simpler one just for little validation
    ```PHP
    $this->validate($request, ['title' => 'required'])
    ```

## Authentication
[Related docs](http://laravel.com/docs/5.1/authentication)

## Middleware
1.  Add middleware
    ```BASH
    php artisan make:middleware RedirectIfNotAManager
    ```

## Route Model Binding
1.  Change code in `RouteServiceProvider.php`
    ```PHP
    $router->model('articles', 'App\Article');
    ```
2.  Remove any `$id` as parameter from function in `ArticlesController.php`, change into
    ```PHP
    public function show(Article $article) {
        // remove the code in body : $article = Article::findOrFail($id);
    }
    ```
3.  For complicated logic, change default in number 1 into
    ```PHP
    $router->bind('articles', function($id) {
        return \App\Article::published()->findOrFail($id);
    });
    ```

## Service Provider
[Related docs](http://laravel.com/docs/5.1/container)
1.  Create new service provider
    ```PHP
    php artisan make:provider ViewComposerServiceProvider
    ```
2.  Add the new provider into `config/app.php` file in the `providers`
    ```PHP
    App\Providers\ViewComposerServiceProvider::class,
    ```
3.  Insert related code
    ```PHP
    view()->composer('partials.nav', function($view) {
        $view->with('latest', Article::latest()->first());
    });
    ```

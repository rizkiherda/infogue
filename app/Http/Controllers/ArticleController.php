<?php

namespace Infogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Infogue\Activity;
use Infogue\Article;
use Infogue\Category;
use Infogue\Contributor;
use Infogue\Http\Requests;
use Infogue\Http\Requests\CreateArticleRequest;
use Infogue\Rating;
use Infogue\Subcategory;
use Infogue\Tag;
use Infogue\Uploader;

class ArticleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Article Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling showing article page including
    | archive, latest, headline, featured, random, single article, tags, hit,
    | rate, and article management.
    |
    */

    /**
     * Instance variable of Article.
     *
     * @var Article
     */
    private $article;

    /**
     * Create a new article controller instance.
     *
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Display a listing of the account article.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         * --------------------------------------------------------------------------
         * Filtering article
         * --------------------------------------------------------------------------
         * Populate optional filter on url break down in data, sorting by and sorting
         * method, retrieve the article via archive method with padding contributor
         * id to limit selection by their authenticate author.
         */

        $filter_data = Input::has('data') ? Input::get('data') : 'all-data';
        $filter_by = Input::has('by') ? Input::get('by') : 'date';
        $filter_sort = Input::has('sort') ? Input::get('sort') : 'desc';

        $articles = $this->article->archive($filter_data, $filter_by, $filter_sort, Auth::user()->id);

        return view('contributor.article', compact('articles'));
    }

    /**
     * Display a listing of the account article.
     *
     * @return \Illuminate\Http\Response
     */
    public function stream()
    {
        /*
         * --------------------------------------------------------------------------
         * Stream on the fly
         * --------------------------------------------------------------------------
         * Retrieve authenticate contributor stream, this page implement lazy
         * pagination then return json if page variable exists, return view if it
         * does not.
         */

        $contributor = new Contributor();

        $stream = $contributor->stream(Auth::user()->username);

        if (Input::get('page', false)) {
            return $stream;
        } else {
            return view('contributor.stream', compact('stream'));
        }
    }

    /**
     * Display a listing of the latest article.
     *
     * @return \Illuminate\Http\Response
     */
    public function latest()
    {
        /*
         * --------------------------------------------------------------------------
         * Public latest article
         * --------------------------------------------------------------------------
         * Retrieve full latest page (with false param), this page implement lazy
         * pagination then return json if page variable exists, return view if it
         * does not.
         */

        $latest = $this->article->latest(false);

        $breadcrumb = [
            'Archive' => route('article.archive'),
            'Latest' => route('article.latest'),
        ];

        $next_ref = route('article.headline');

        $prev_ref = '#';

        if (Input::get('page', false)) {
            return $latest;
        } else {
            return view('article.category', compact('breadcrumb', 'next_ref', 'prev_ref'));
        }
    }

    /**
     * Display a listing of the headline article.
     *
     * @return \Illuminate\Http\Response
     */
    public function headline()
    {
        /*
         * --------------------------------------------------------------------------
         * Public headline article
         * --------------------------------------------------------------------------
         * Retrieve full headline page (with false param), this page implement lazy
         * pagination then return json if page variable exists, return view if it
         * does not.
         */

        $headline = $this->article->headline(false);

        $breadcrumb = [
            'Archive' => route('article.archive'),
            'Headline' => route('article.headline'),
        ];

        $next_ref = route('article.trending');

        $prev_ref = route('article.latest');

        if (Input::get('page', false)) {
            return $headline;
        } else {
            return view('article.category', compact('breadcrumb', 'next_ref', 'prev_ref'));
        }
    }

    /**
     * Display a listing of the trending article.
     *
     * @return \Illuminate\Http\Response
     */
    public function trending()
    {
        /*
         * --------------------------------------------------------------------------
         * Public trending article
         * --------------------------------------------------------------------------
         * Retrieve full headline page (with false param), this page implement lazy
         * pagination then return json if page variable exists, return view if it
         * does not.
         */

        $trending = $this->article->trending(false);

        $breadcrumb = [
            'Archive' => route('article.archive'),
            'Trending' => route('article.trending'),
        ];

        $next_ref = route('article.random');

        $prev_ref = route('article.headline');

        if (Input::get('page', false)) {
            return $trending;
        } else {
            return view('article.category', compact('breadcrumb', 'next_ref', 'prev_ref'));
        }
    }

    /**
     * Display a listing of the random article.
     *
     * @return \Illuminate\Http\Response
     */
    public function random()
    {
        /*
         * --------------------------------------------------------------------------
         * Public random article
         * --------------------------------------------------------------------------
         * Random article with SQL order function through article model, this page
         * implement lazy  pagination then return json if page variable exists,
         * return view if it does not.
         */

        $trending = $this->article->random();

        $breadcrumb = [
            'Archive' => route('article.archive'),
            'Random' => route('article.random'),
        ];

        $next_ref = '#';

        $prev_ref = route('article.trending');

        if (Input::get('page', false)) {
            return $trending;
        } else {
            return view('article.category', compact('breadcrumb', 'next_ref', 'prev_ref'));
        }
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        /*
         * --------------------------------------------------------------------------
         * Filtering article
         * --------------------------------------------------------------------------
         * Populate optional filter on url break down in data, sorting by and sorting
         * method, retrieve the article via archive method.
         */

        $filter_data = Input::has('data') ? Input::get('data') : 'all-data';
        $filter_by = Input::has('by') ? Input::get('by') : 'date';
        $filter_sort = Input::has('sort') ? Input::get('sort') : 'desc';

        $archive = $this->article->archive($filter_data, $filter_by, $filter_sort);

        return view('article.archive', compact('archive'));
    }

    /**
     * Show the form for creating a new article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
         * --------------------------------------------------------------------------
         * Show create form
         * --------------------------------------------------------------------------
         * Populate category into list for build drop down, and try catch old
         * subcategory input because it depends on category which accessed via ajax.
         */

        $categories = Category::pluck('category', 'id');

        $subcategories = null;

        if (Input::old('category', '') != '') {
            $subcategories = Category::findOrFail(Input::old('category'))->subcategories;
        }

        return view('contributor.article_create', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created article in storage.
     *
     * @param CreateArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticleRequest $request)
    {
        /*
         * --------------------------------------------------------------------------
         * Populate tags
         * --------------------------------------------------------------------------
         * tags [many-to] -- article_tags -- [many] articles
         *
         * Sync tags and article, extract tags from request, break down between new
         * tags and tags that available in database, collect available tags first
         * then insert new tags and merge new inserted tag id with available tags id
         * finally store them all into article_tags table.
         */

        // get all tags which ALREADY EXIST by tags are given eg:
        // request tags         = [angga, ari, entertainment, happy, trend, 2016]
        // all database tags    = [1 => news, 2 => happy, 3 => angga, 4 => love, 5 => 2016]
        // tags where in        = [3 => angga, 2 => happy, 5 => 2016]
        $tag = Tag::whereIn('tag', explode(',', $request->get('tags')));

        // collect tags which existed into tags_id and leave for a while
        // $tags_id [3, 2, 5]
        $tags_id = $tag->pluck('id')->toArray();

        // retrieve tags label (name) which already exist to compare with given array
        // tags label [angga, happy, 2016]
        $available_tags = $tag->pluck('tag')->toArray();

        // new tags need to insert into tags table
        // $new_tags = [ari, entertainment, trend]
        $new_tags = array_diff(explode(',', $request->get('tags')), $available_tags);

        // loop through new tags and retrieve last inserted id to merge with tags_id that need to insert later
        // new tags will have id [6 => ari, 7 => entertainment, 8 => trend]
        // $tags_id will be [3, 2, 5, 6, 7, 8]
        foreach ($new_tags as $tag_label):
            $newTag = new Tag();
            $newTag->tag = $tag_label;
            $newTag->save();
            array_push($tags_id, $newTag->id);
        endforeach;

        /*
         * --------------------------------------------------------------------------
         * Populate article data
         * --------------------------------------------------------------------------
         * Retrieve all data from request and populate into article object model
         * then store it into database, check if featured is available then attempt
         * to upload to asset directory.
         */

        $article = new Article();
        $article->contributor_id = Auth::user()->id;
        $article->subcategory_id = $request->input('subcategory');
        $article->title = $request->input('title');
        $article->slug = $request->input('slug');
        $article->type = $request->input('type');
        $article->content = $request->input('content');
        $article->excerpt = $request->input('excerpt');
        $article->status = $request->input('status');

        $image = new Uploader();
        if ($image->upload($request, 'featured', base_path('public/images/featured/'), rand(0, 1000) . uniqid())) {
            $article->featured = $request->input('featured');
        }

        $article->save();

        /*
         * --------------------------------------------------------------------------
         * Sync and Attach
         * --------------------------------------------------------------------------
         * We have all tag ids that need to insert on article_tags [3, 2, 5, 6, 7, 8]
         * use attach method we insert them through article model related by article
         * id so everything should be working perfectly.
         */

        Article::find($article->id)->tags()->attach($tags_id);

        /*
         * --------------------------------------------------------------------------
         * Create article activity
         * --------------------------------------------------------------------------
         * Create new instance of Activity and insert create article activity.
         */

        Activity::create([
            'contributor_id' => Auth::user()->id,
            'activity' => Activity::createArticleActivity(Auth::user()->username, $article->title, $article->slug)
        ]);

        return redirect(route('account.article.index'))
            ->with('status', 'success')
            ->with('message', 'The <strong>' . $article->title . '</strong> was created');
    }

    /**
     * Store user rating for the article via AJAX.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request)
    {
        /*
         * --------------------------------------------------------------------------
         * Visitor gives a rating
         * --------------------------------------------------------------------------
         * Find article that needs to be rated, find out client ip address from
         * request, check if the client ip gave rating to this article before, if
         * they did, then update their rating if they didn't then insert new.
         */

        $article = Article::findOrFail($request->input('article_id'));

        $ip = $request->ip();

        $is_rated = $article->ratings()->whereIp($ip)->count();

        if ($is_rated) {
            $rating = Rating::whereArticleId($request->input('article_id'))->whereIp($ip)->firstOrFail();
            $rating->rate = $request->input('rate');
            $rating->save();
        } else {
            $rating = new Rating();
            $rating->article_id = $request->input('article_id');
            $rating->ip = $ip;
            $rating->rate = $request->input('rate');
            $rating->save();
        }

        /*
         * --------------------------------------------------------------------------
         * Create rate article activity
         * --------------------------------------------------------------------------
         * Create new instance of Activity and insert rate article activity.
         */

        Activity::create([
            'contributor_id' => $article->contributor_id,
            'activity' => Activity::giveRatingActivity($article->title, $article->slug, $request->input('rate'))
        ]);

        return ($article->rating()->count() == null) ? 0 : $article->rating->total_rating;
    }

    /**
     * Count +1 every user access the article at least for 30 seconds.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function hit(Request $request)
    {
        $article = Article::findOrFail($request->input('id'));

        $article->view = $article->view + 1;

        $article->save();

        return $article->view;

    }

    /**
     * Display the specified article.
     *
     * @param  int $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        /*
         * --------------------------------------------------------------------------
         * Populate single article view
         * --------------------------------------------------------------------------
         * Find published article by slug, build breadcrumb stack, retrieve article
         * author, article tags, related and popular article.
         */

        $article = $this->article->published()->whereSlug($slug)->firstOrFail();

        $category = $article->subcategory->category->category;

        $subcategory = $article->subcategory->subcategory;

        $breadcrumb = [
            'Archive' => route('article.archive'),
            $category => route('article.category', [str_slug($category)]),
            $subcategory => route('article.subcategory', [str_slug($category), str_slug($subcategory)]),
        ];

        $previous_article = $this->article->navigateArticle($article->id, 'prev');

        $next_article = $this->article->navigateArticle($article->id, 'next');

        $prev_ref = ($previous_article != null) ? route('article.show', [$previous_article->slug]) : '#';

        $next_ref = ($next_article != null) ? route('article.show', [$next_article->slug]) : '#';

        $tags = $article->tags()->get();

        $related = $this->article->related($article->id);

        $popular = $this->article->mostPopular(5);

        $contributor = new Contributor();

        $author = $contributor->profile($article->contributor->username);

        return view('article.article', compact('breadcrumb', 'prev_ref', 'next_ref', 'article', 'author', 'tags', 'related', 'popular'));
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        /*
         * --------------------------------------------------------------------------
         * Show edit form
         * --------------------------------------------------------------------------
         * Populate category into list for build drop down, and try catch old
         * subcategory input because it depends on category, by default subcategory
         * should be exist on edit because all article should have it.
         */

        $article = Article::whereSlug($slug)->firstOrFail();

        $categories = Category::pluck('category', 'id');

        $subcategories = null;

        if (Input::old('category', '') != '') {
            $subcategories = Category::findOrFail(Input::old('category'))->subcategories;
        } else {
            $subcategories = Subcategory::whereCategoryId($article->subcategory->category->id)->get();
        }

        return view('contributor.article_edit', compact('article', 'categories', 'subcategories'));
    }

    /**
     * Update the specified article in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $slug
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
    public function update(Request $request, $slug)
    {
        /*
         * --------------------------------------------------------------------------
         * Validate data
         * --------------------------------------------------------------------------
         * Build validation rules, slug must be unique except its own, featured
         * not required to change or re-upload.
         */

        $article = Article::whereSlug($slug)->firstOrFail();

        $rules = [
            'title' => 'required|max:70',
            'slug' => 'required|alpha_dash|max:100|unique:articles,slug,' . $article->id,
            'type' => 'required|in:standard,gallery,video',
            'category' => 'required',
            'subcategory' => 'required',
            'featured' => 'mimes:jpg,jpeg,gif,png',
            'tags' => 'required',
            'content' => 'required',
            'excerpt' => 'max:300',
            'status' => 'required|in:pending,draft,published,reject',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $request->session()->flash('status', 'danger');
            $request->session()->flash('message', 'Your inputs data are invalid, please check again');

            $this->throwValidationException(
                $request, $validator
            );
        }

        /*
         * --------------------------------------------------------------------------
         * Populate tags
         * --------------------------------------------------------------------------
         * tags [many-to] -- article_tags -- [many] articles
         *
         * This process should be similar with create article, little bit difference
         * at old tags synchronization, some tags maybe removed from article and new
         * tags need to insert again.
         */

        // get all tags which ALREADY EXIST by tags are given
        $tag = Tag::whereIn('tag', explode(',', $request->get('tags')));

        // collect tags which existed into tags_id and leave for a while
        $tags_id = $tag->pluck('id')->toArray();

        // retrieve tags label which already exist to compare with given array
        $available_tags = $tag->pluck('tag')->toArray();

        // new tags need to insert into tags table
        $new_tags = array_diff(explode(',', $request->get('tags')), $available_tags);

        $article->tags()->sync($tags_id);

        foreach ($new_tags as $tag_label):
            $newTag = new Tag();
            $newTag->tag = $tag_label;
            $newTag->save();
            // insert new tag immediately after inserted
            if (!$article->tags->contains($newTag->id)) {
                $article->tags()->save($newTag);
            }
        endforeach;

        /*
         * --------------------------------------------------------------------------
         * Update the article
         * --------------------------------------------------------------------------
         * Finally populate article data like create process and check if featured
         * need to change and upload the image then update the changes.
         */

        $article->subcategory_id = $request->input('subcategory');
        $article->title = $request->input('title');
        $article->slug = $request->input('slug');
        $article->type = $request->input('type');
        $article->content_update = $request->input('content');
        $article->excerpt = $request->input('excerpt');
        $article->status = $request->input('status');

        $image = new Uploader();
        if ($image->upload($request, 'featured', base_path('public/images/featured/'), rand(0, 1000) . uniqid())) {
            $article->featured = $request->input('featured');
        }

        $article->save();

        /*
         * --------------------------------------------------------------------------
         * Update article activity
         * --------------------------------------------------------------------------
         * Create new instance of Activity and insert update article activity.
         */

        Activity::create([
            'contributor_id' => Auth::user()->id,
            'activity' => Activity::updateArticleActivity(Auth::user()->username, $article->title, $article->slug)
        ]);

        return redirect(route('account.article.index'))
            ->with('status', 'success')
            ->with('message', 'The <strong>' . $article->title . '</strong> was updated');
    }

    /**
     * Update the specified article in storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function draft($id)
    {
        $article = Article::whereId($id)->firstOrFail();

        $article->status = 'draft';

        $article->save();

        return redirect(route('account.article.index'))
            ->with('status', 'warning')
            ->with('message', 'The <strong>' . $article->title . '</strong> set to draft');
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        /*
         * --------------------------------------------------------------------------
         * Delete article activity
         * --------------------------------------------------------------------------
         * Create new instance of Activity and insert delete article activity.
         */

        Activity::create([
            'contributor_id' => Auth::user()->id,
            'activity' => Activity::deleteArticleActivity(Auth::user()->username, $article->title, $article->slug)
        ]);

        return redirect(route('account.article.index'))
            ->with('status', 'danger')
            ->with('message', 'The <strong>' . $article->title . '</strong> was deleted');;
    }
}
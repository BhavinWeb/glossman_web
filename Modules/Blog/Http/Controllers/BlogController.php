<?php

namespace Modules\Blog\Http\Controllers;


// use App\Models\Category;
use Illuminate\Http\Request;
use Modules\Tag\Entities\Tag;
use Modules\Blog\Entities\Post;
use Illuminate\Routing\Controller;
use Modules\Blog\Actions\CreatePost;
use Modules\Blog\Actions\DeletePost;
use Modules\Blog\Actions\UpdatePost;
use Modules\Blog\Entities\PostCategory;
use Illuminate\Contracts\Support\Renderable;
use Modules\Blog\Http\Requests\PostFormRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Blog\Entities\PostComment;

class BlogController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the post list.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(!userCan('post.view'), 403);

        $categories = PostCategory::all();
        $authors = Post::select('author_id')->with('author:id,first_name,last_name')->get()->groupBy('author_id');
        $totalPosts = Post::count();
        $totalComments = PostComment::count();
        $totalAuthor = $authors->count();
        $totalCategory = $categories->count();
        $totalDraft = Post::where('status', 'draft')->count();
        $totalPublished = Post::where('status', 'published')->count();

        $query = Post::with('category', 'author:id,first_name,last_name')->withCount('comments');
        if ($request->keyword && $request->keyword != null) {
            $query->where('title', 'LIKE', "%$request->keyword%");
        }

        if ($request->category && $request->category != null) {
            $category = $request->category;
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        if ($request->author && $request->author != null) {
            $author = $request->author;
            $query->whereHas('author', function ($q) use ($author) {
                $q->where('id', $author);
            });
        }

        if ($request->status && $request->status != null) {
            $query->where('status', $request->status);
        }
        $blogs = $query->latest()->paginate('15')->withQueryString();
        return view('blog::index', compact('blogs', 'categories', 'authors', 'totalComments', 'totalAuthor', 'totalPosts', 'totalDraft', 'totalPublished'));
    }

    /**
     * Show the form for creating a new post.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!userCan('post.create'), 403);

        $categories = PostCategory::all();

        return view('blog::create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param PostFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostFormRequest $request)
    {
        abort_if(!userCan('post.create'), 403);

        $post = CreatePost::create($request);

        if ($post) {
            flashSuccess('Post Created Successfully');
            return redirect()->route('module.blog.index');
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Show the form for editing the specified post.
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        abort_if(!userCan('post.update'), 403);

        $categories = PostCategory::all();

        return view('blog::edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     * @param PostFormRequest $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, Post $post)
    {
        abort_if(!userCan('post.update'), 403);

        $post = UpdatePost::update($request, $post);

        if ($post) {
            flashSuccess('Post Updated Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified post from storage.
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        abort_if(!userCan('post.delete'), 403);

        $post = DeletePost::delete($post);

        if ($post) {
            flashSuccess('Post Deleted Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }
}

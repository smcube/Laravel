<?php

namespace App\Http\Controllers\Cms\Post\Post;

use App\Http\Controllers\Cms\Post\Post\Requests\PublishedPostRequest;
use App\Http\Controllers\Cms\Post\Post\Requests\StorePostRequest;
use App\Http\Controllers\Cms\Post\Post\Requests\UpdatePostRequest;
use App\Models\Post\Post;
use App\Services\Cms\Post\PostsService;
use App\Services\Cms\Post\RubricsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class PostsController
 * @package App\Http\Controllers\Cms\Post\Post
 */
class PostsController extends Controller
{
    /** @var PostsService $postService */
    protected $postsService;

    /** @var RubricsService $rubricsService */
    protected $rubricsService;

    public function __construct(PostsService $postsService, RubricsService $rubricsService)
    {
        $this->postsService = $postsService;
        $this->rubricsService = $rubricsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('cms.post.index', [
            'posts' => $this->postsService->paginationList(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return  view(
            'cms.post.create',
            [
                'rubrics' => $this->rubricsService->getArrayList(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePostRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(StorePostRequest $request)
    {
        $url = $this->postsService->store($request);

        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Factory|View
     */
    public function show(Post $post)
    {
        return view(
            'cms.post.show',
            [
                'post' => $post,
                'image' => $this->postsService->getPostImage($post),
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Factory|View
     */
    public function edit(Post $post)
    {
        return view(
            'cms.post.edit',
            [
                'post' => $post,
                'rubrics' => $this->rubricsService->getArrayList(),
                'image' => $this->postsService->getPostImage($post),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePostRequest  $request
     * @param Post $post
     * @return RedirectResponse|Redirector
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $url = $this->postsService->update($post, $request);

        return redirect($url);
    }

    /**
     * Published the specified resource in storage.
     *
     * @param PublishedPostRequest  $request
     * @param Post $post
     * @return RedirectResponse|Redirector
     */
    public function published(PublishedPostRequest $request, Post $post)
    {
        $data = $request->getFormData();

        $url = $this->postsService->published($post, $data);

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse|Redirector
     */
    public function destroy(Post $post)
    {
        $url = $this->postsService->destroy($post);

        return redirect($url);
    }
}

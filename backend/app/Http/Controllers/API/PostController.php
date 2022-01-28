<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\System\EntityDeletedSuccessfullyResource;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\API\Post\PostCreateRequest;
use App\Http\Requests\API\Post\PostUpdateRequest;
use App\Http\Resources\API\PostResource;
use App\Http\Resources\API\PostCreatedResource;
use App\Http\Resources\API\PostUpdatedResource;
use App\Http\Resources\API\System\EntityNotFoundResource;
use App\Http\Resources\API\System\ServerErrorResource;
use Exception;
use \Illuminate\Http\Resources\Json\JsonResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return PostResource::collection(auth()->user()->posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\API\Post\PostCreateRequest  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(PostCreateRequest $request)
    {
        $validated = $request->validated();

        try {
            $post = Post::create($validated);

        } catch (Exception $e) {
            // Error handling
            return new ServerErrorResource(null);
        }

        return new PostCreatedResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id)
    {
        if (!$post = auth()->user()->posts()->find($id)) {
            return new EntityNotFoundResource(null);
        }

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\API\Post\PostUpdateRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(PostUpdateRequest $request, $id)
    {
        if (!$post = auth()->user()->posts()->find($id)) {
            return new EntityNotFoundResource(null);
        }

        $validated = $request->validated();

        try {
            $post->update($validated);

        } catch (Exception $e) {
            // Error handling
            return new ServerErrorResource(null);
        }

        return new PostUpdatedResource(Post::find($post->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function destroy($id)
    {
        if (!$post = auth()->user()->posts()->find($id)) {
            return new EntityNotFoundResource(null);
        }

        Post::destroy($id);

        return new EntityDeletedSuccessfullyResource(null);

    }
}

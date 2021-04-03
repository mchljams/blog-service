<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Http\Requests\DeletePostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Create a new PostsController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $posts = Post::all();

            return response()->json($posts, 200);

        } catch (\Exception $e) {

            return response()->json([], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        try {

            $data = $request->validated();
            $data['user_id'] = Auth::user()->id;

            $post = Post::create($data);

            return response()->json($post, 201);


        } catch (\Exception $e) {

            return response()->json([], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $post = Post::with(['user'])->findOrFail($id);

            $resource = new PostResource($post);

            return response()->json($resource, 200);

        } catch (\Exception $e) {

            return response()->json([], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePostRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {

        try {
            $data = $request->validated();

            Post::where('id', $id)
                ->where('user_id', Auth::user()->id)
                ->firstOrFail()
                ->update($data);

            return response()->json([], 202);

        } catch (\Exception $e) {

            return response()->json([], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeletePostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeletePostRequest $request, $id)
    {
        try {

            Post::where('user_id', Auth::user()->id)->firstOrFail()->delete();

            return response()->json([], 204);

        } catch (\Exception $e) {

            return response()->json([], 400);
        }
    }
}

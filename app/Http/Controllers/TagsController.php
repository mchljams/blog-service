<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\DeleteTagRequest;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\TagResource;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    /**
     * Create a new TagsController instance.
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
        return Tag::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        try {

            $data = $request->validated();
            $data['user_id'] = Auth::user()->id;

            $post = Tag::create($data);

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

            $tag = Tag::with(['user'])->findOrFail($id);

            $resource = new TagResource($tag);

            return response()->json($resource, 200);

        } catch (\Exception $e) {

            return response()->json([], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTagRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, $id)
    {
        try {
            $data = $request->validated();

            Tag::where('id', $id)
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
     * @param  DeleteTagRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteTagRequest $request, $id)
    {
        try {

            Tag::where('id', $id)
                ->where('user_id', Auth::user()->id)
                ->firstOrFail()
                ->delete();

            return response()->json([], 204);

        } catch (\Exception $e) {

            return response()->json([], 400);
        }
    }
}

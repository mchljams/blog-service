<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\DeleteTagRequest;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
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
        //try {

            $data = $request->validated();
            $data['user_id'] = Auth::user()->id;

            $post = Tag::create($data);

            return response()->json($post, 201);


//        } catch (\Exception $e) {
//
//            return response()->json([], 404);
//        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpParser\Node\Stmt\Return_;
use Psy\Util\Str;
use Ramsey\Uuid\Uuid;

class BlogController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth', ['except' => []]);
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = DB::table('blogs')->orderBy('id')->paginate(20, ['id', 'user_id', 'article', 'image', 'created_at', 'updated_at']);
        return Response($blogs, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $valid = Validator::make($request->only('article', 'image'), [
            'article' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        if ($valid->fails()) {
            return Response($valid->errors(), 406);
        }
        try {
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->store('images', 'blogs');
            $file = $request->file('image')->getContent();

            $blog = new Blog();
//        $blog->name = $name;
            $blog->id = Uuid::uuid4();
            $blog->user_id = Auth::id();
            $blog->article = $request->article;
            $blog->image = $path;
            $blog->image_binary = $file;
            $blog->save();

            return Response(["status" => "Object create"], Response::HTTP_CREATED);
        } catch (\Exception $error) {
            echo Str($error);
            return Response(["status" => $error->getMessage()], 204);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::query()->where('id', $id)->first();
        return Response($blog, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

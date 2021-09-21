<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //post unica pag
        // $posts = Post::all();
        // return response()->json([
        //     'successo' => true,
        //     'risultato' => '$posts'

        // ]);

        $posts = Post::paginate(4);
         return response()->json([
             'successo' => true,
             'risultato' => '$posts'

         ]);
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

}

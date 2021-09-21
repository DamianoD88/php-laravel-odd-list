<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Tag;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('admin.posts.index', compact('posts','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:60',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image'
        ]);


        $data = $request->all();


  
        $new_post = new Post();

        $slug = Str::slug($data['title'],'-');

        $slug_base = $slug;

        $slug_presente = Post::where('slug', $slug)->first();

        $contatore = 1;
        while($slug_presente){
            $slug = $slug_base . '-' .$contatore;

            $slug_presente = Post::where('slug', $slug)->first();

            $contatore++;
        }



        $new_post->slug = $slug;

        if(array_key_exists('image',$data)){

            $cover_path = Storage::put('covers', $data['image']);

  
            $data['cover'] = $cover_path;
        }

        $new_post->fill($data);


        $new_post->save();

    
        if(array_key_exists('tags',$data)){
            $new_post->tags()->attach($data['tags']);
        }
        

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

 
     public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   
        $categories = Category::all();
        $tags = Tag::all();
        // dd($categories);
        return view('admin.posts.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:60',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image'
        ]);

        $data = $request->all();
        // dd($data);

        if($data['title'] != $post->title){

            $slug = Str::slug($data['title'],'-'); 
            
            //se lo slug è uguale a un altro 
            $slug_base = $slug; 
            $slug_presente = Post::where('slug', $slug)->first();

            $contatore = 1;
            while($slug_presente){
                
                $slug = $slug_base . '-' . $contatore; 
                $slug_presente = Post::where('slug', $slug)->first();
                $contatore++;
            }

            
            $data['slug'] = $slug;
        } 
        
        
        if(array_key_exists('image',$data)){
            //salviamo l'immagine
            $cover_path = Storage::put('covers', $data['image']);

            Storage::delete($post->cover);
            //salviamo l'immagine con il percorso relativo
            $data['cover'] = $cover_path;
        }


        $post->update($data);


        if(array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        }


        return redirect()->route('admin.posts.index')->with('updated', 'Hai modificato con successo l\'elemento' .$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::delete($post->cover);
        $post->delete();
        // $post->tags()->detach();
        return redirect()->route('admin.posts.index');
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $limit=request('limit')?request('limit'):2;
        return Post::paginate($limit);
    }

    public function store()
    {
        return Post::create($this->post_validate());
    }

    public function update()
    {
        return Post::findOrFail(request('id'))->update($this->post_validate());
    }

    public function delete()
    {
        return Post::findOrFail(request('id'))->delete();
    }

    public function post_validate()
    {
        $post=$this->validate(request(),[
            'author_id' => 'required',
            'title'     => 'required',
            'body'      => 'required',
            'slug'      => 'required|unique:posts',
            'status'    => 'required',
            'featured'  => 'required',
        ]);

        return $post;
    }
}

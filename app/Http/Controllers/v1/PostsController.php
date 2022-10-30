<?php

namespace App\Http\Controllers\v1;

use Exception;
use App\Models\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class PostsController extends Controller
{

    public function create(Request $request)
    {

        try {

            $rules = [
                'title' => 'required|min:5',
                'author' => 'required|min:5',
                'content' => 'required|min:5',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return response()->json(['return' => $validator->messages()], 500);
            }

            $post = new Posts();
            $post->title = $request->input('title');
            $post->author = $request->input('author');
            $post->content = $request->input('content');
            $post->tags = implode(',', $request->input('tags'));

            $post->save();

            $post->tags = explode(',', $post->tags);

            return response()->json($post, 201);

        } catch (Exception $e) {

            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());

        }

    }

    public function readAll()
    {

        try {

            $posts = Posts::all($columns = ['id', 'title', 'author', 'content', 'tags']);

            return response()->json($posts, 200);

        } catch (Exception $e) {

            return response()->json(['error' => true, 'message' => $e->getMessage()], $e->getCode());

        }

    }

    public function read($id)
    {

        try {

            $post = Posts::find($id, $columns = ['id', 'title', 'author', 'content', 'tags']);

            if ($post) {

                $post->tags = explode(',', $post->tags);

                return response()->json($post, 200);

            } else {

                return response()->json(['return' => 'Falha ao encontrar postagem, verifique.'], 500);

            }

        } catch (Exception $e) {

            return response()->json(['return' => $e->getMessage()], $e->getCode());

        }

    }

    public function update(Request $request, $id)
    {

        $rules = [
            'title' => 'required|min:5',
            'author' => 'required|min:5',
            'content' => 'required|min:5',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json(['return' => $validator->messages()], 500);
        }

        $title = $request->input('title');
        $author = $request->input('author');
        $content = $request->input('content');
        $tags = implode(',', $request->input('tags'));

        $post = Posts::find($id, $columns = ['id', 'title', 'author', 'content', 'tags', 'updated_at']);

        if ($post) {

            $title = isset($title) ? $post->title = $title : NULL;
            $author = isset($author) ? $post->author = $author : NULL;
            $content = isset($content) ? $post->content = $content : NULL;
            $tags = isset($content) ? $post->tags = $tags : NULL;

            $post->save();

            $post->tags = explode(',', $post->tags);

            return response()->json($post, 200);

        } else {

            return response()->json(['return' => 'Falha ao encontrar postagem, verifique.'], 500);

        }

    }

    public function delete($id)
    {

        try {

            $post = Posts::find($id);

            if ($post) {

                $post->delete();

                return response()->json([], 204);

            } else {

                return response()->json(['return' => 'Falha ao deletar postagem, verifique.'], 500);

            }

        } catch (Exception $e) {

            return response()->json(['return' => $e->getMessage()], $e->getCode());

        }

    }

}
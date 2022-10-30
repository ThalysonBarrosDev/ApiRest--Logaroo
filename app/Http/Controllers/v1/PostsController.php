<?php

namespace App\Http\Controllers\v1;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PostsController extends Controller
{

    public function create()
    {

        try {

            return response()->json(['success' => true], 200);

        } catch (Exception $e) {

            return response()->json(['return' => $e->getMessage()], $e->getCode());

        }
        
    }

    public function readAll()
    {

        try {

            return response()->json(['success' => true], 200);

        } catch (Exception $e) {

            return response()->json(['return' => $e->getMessage()], $e->getCode());

        }

    }

    public function read($tag)
    {

        try {

            return response()->json(['success' => true], 200);

        } catch (Exception $e) {

            return response()->json(['return' => $e->getMessage()], $e->getCode());

        }

    }

    public function update($id)
    {

        try {

            return response()->json(['success' => true], 200);

        } catch (Exception $e) {

            return response()->json(['return' => $e->getMessage()], $e->getCode());

        }

    }

    public function delete($id)
    {

        try {

            return response()->json(['success' => true], 200);

        } catch (Exception $e) {

            return response()->json(['return' => $e->getMessage()], $e->getCode());

        }

    }

}

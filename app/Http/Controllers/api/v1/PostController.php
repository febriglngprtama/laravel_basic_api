<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'content' => 'required'
            ],
            [
                'title.required' => 'Masukan Title Post !',
                'content.required' => 'Masukan Content Post !'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'silakan Isi Bidang yang Kosong',
                'data' => $validator->errors()
            ], 401);
        } else {
            $post = Post::create([
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ]);
            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Disimpan!'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Disimpan!'
                ], 401);
            }
        }
    }
}

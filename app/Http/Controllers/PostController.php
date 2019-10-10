<?php

namespace App\Http\Controllers;

use App\Librarys\Librarys;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

/**
 * @group 4. Feed
 * Feed endpoints.
 */
class PostController extends Controller
{
    /**
     * Create
     *
     * Creates a new post.
     *
     * @bodyParam name string required Feed`s title
     * @bodyParam description string required Feed`s message
     * @bodyParam photo file Feed`s image
     *
     * @response {"msg":"Feed posted successfully!","data":{"name":"post 1 do usuario 3","description":"praia","photo":null,"user_id":4,"updated_at":"2019-10-09 18:39:35","created_at":"2019-10-09 18:39:35","id":7}}
     * @response 422 {"errors":{"name":["The name field is required."],"description":["The description field is required."]},"status":false}
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lib = Librarys::new ();

        // get current user id
        $request['user_id'] = $lib->me()['id'];

        $validation = $this->validation($request);

        if (!$validation['status']) {
            return response()->json($validation, 422);
        }

        $result = Post::create($request->all());

        // If user is created and have a photo, store photo
        if (!is_null($result) && $request->hasFile('photo')) {
            $lib = Librarys::new ();

            // Defines the feed id as folder name
            $request['id'] = $result->id;
            $path = $lib->storeFile($request, 'post');
        }

        return response()->json(['msg' => 'Feed posted successfully!', 'data' => $result]);
    }

    /**
     * Details
     *
     * Get feed`s details and who liked it.
     *
     * @queryParam id required Post id. No-example
     *
     * @response {"msg":"Feed posted successfully!","data":{"name":"post 1 do usuario 3","description":"praia","photo":null,"user_id":4,"updated_at":"2019-10-09 18:39:35","created_at":"2019-10-09 18:39:35","id":7}}
     * @response 422 {"errors":{"name":["The name field is required."],"description":["The description field is required."]},"status":false}
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lib = Librarys::new ();
        $result = Post::find($id);

        if (is_null($result)) {
            return response()->json(['msg' => 'Feed not found.'], 404);
        }

        $result->likes;

        // get image url
        $result['photo'] = $lib->getFile($result, 'post');

        return response()->json(['data' => $result]);
    }

    // Request validation
    private function validation($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'photo' => 'nullable',
            'user_id' => 'required|numeric',
        ]);

        $data = [
            'errors' => null,
            'status' => true,
        ];

        if ($validator->fails()) {
            $data = [
                'errors' => $validator->errors()->toArray(),
                'status' => false,
            ];
        }

        return $data;
    }
}

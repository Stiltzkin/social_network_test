<?php

namespace App\Http\Controllers;

use App\Librarys\Librarys;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

/**
 * @group 3. User
 * User endpoints.
 */
class UserController extends Controller
{
    // public function index()
    // {
    //     $result = User::all();

    //     return response()->json(['data' => $result]);
    // }

    /**
     * Create
     *
     * Creates a new user.
     *
     * @bodyParam name string required User`s name
     * @bodyParam email string required User`s email
     * @bodyParam password string required User`s password
     * @bodyParam photo file User`s image
     *
     * @response {"msg":"User created successfully!", "data":{"name":"usuario 5","email":"email5@email","address_id":2,"updated_at":"2019-10-09 18:17:32","created_at":"2019-10-09 18:17:32","id":5}}
     * @response 422 {"errors":{"name":["The name field is required."],"email":["The email field is required."],"password":["The password field is required."]},"status":false}
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validation($request);

        if (!$validation['status']) {
            return response()->json($validation, 422);
        }

        $request['password'] = bcrypt($request['password']);

        $result = User::create($request->all());

        // If user is created and have a photo, store photo
        if (!is_null($result) && $request->hasFile('photo')) {
            $lib = Librarys::new ();

            // Defines the user id as folder name
            $request['id'] = $result->id;
            $path = $lib->storeFile($request, 'user');
        }

        return response()->json(['msg' => 'User created successfully!', 'data' => $result]);
    }

    /**
     * Details
     *
     * Get details of an user.
     *
     * @queryParam id required User id. No-example
     *
     * @responseFile responses\show_user.json
     * @response 404 {"msg" => "User not found."}
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lib = Librarys::new ();
        $result = User::find($id);

        if (is_null($result)) {
            return response()->json(['msg' => 'User not found.'], 404);
        }

        $result->addresses;
        $result->follows;
        $result->posts;

        // get image url
        $result['photo'] = $lib->getFile($result, 'user');

        return response()->json(['data' => $result]);
    }

    /**
     * Follow
     *
     * Follows an user.
     *
     * @queryParam id required User to be followed id. No-example
     *
     * @response {"msg":"Following"}
     * @response 404 {"msg" => "User not found."}
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function follow($id)
    {
        $lib = Librarys::new ();
        $userId = $lib->me()['id'];

        $user = User::find($userId);

        $result = DB::select('select user_id, user_following from follows where user_id = ? and user_following = ?',
            [$userId, $id]);

        if (count($result) === 0) {
            $user->follows()->attach($id);
            $msg = 'Following';
        } else {
            $user->follows()->detach($id);
            $msg = 'Unfollowed';
        }

        return response()->json(['msg' => $msg]);
    }

    // Request validation
    private function validation($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
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

    public function test()
    {
        return response()->json(Storage::disk('public')->url('uploads/teste.jpg'));

    }
}

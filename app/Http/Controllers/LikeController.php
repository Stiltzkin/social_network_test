<?php

namespace App\Http\Controllers;

use App\Librarys\Librarys;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group 5. Like
 * Like endpoints.
 */
class LikeController extends Controller
{
    /**
     * Like
     *
     * Likes or dislike a post.
     *
     * @queryParam id required Post id. No-example
     *
     * @response {"msg": "Liked"}
     * @response 404 {"msg": "Feed not found."}
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function like($id)
    {
        $lib = Librarys::new ();

        // get current user id
        $userId = $lib->me()['id'];

        $user = User::find($userId);
        $post = Post::find($id);

        if(is_null($post)){
            return response()->json(['msg' => 'Feed not found.'], 404);
        }

        $result = DB::select('select user_id, post_id from likes where user_id = ? and post_id = ?',
            [$userId, $id]);

        if (count($result) === 0) {
            $user->likes()->attach($id);
            $msg = 'Liked';
        } else {
            $user->likes()->detach($id);
            $msg = 'Disliked';
        }

        return response()->json(['msg' => $msg]);
    }

    /**
     * Most likes in a location
     *
     * List of users with most likes in a location.
     *
     * @queryParam id required Address id. No-example
     *
     * @response {
    "data": [
    {
    "user_id": 2,
    "likes": "3"
    },
    {
    "user_id": 3,
    "likes": "1"
    }
    ]
    }
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mostLikesByLocation($id)
    {
        $result = DB::select("select user_id, sum(likes) as likes from
        (SELECT posts.user_id as user_id, likes.post_id as post_id, count(likes.post_id) as likes
        FROM likes
        INNER JOIN posts ON posts.id = likes.post_id
        WHERE likes.post_id IN (
            SELECT posts.id AS post_id FROM addresses
            INNER JOIN users ON users.address_id = addresses.id
            INNER JOIN posts ON posts.user_id = users.id
            WHERE addresses.id = ?
        )
        GROUP BY post_id)
        AS innerquery
        GROUP BY user_id", [$id]);

        return response()->json(['data' => $result]);
    }
}

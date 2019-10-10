<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Validator;

/**
 * @group 2. Address
 * Address endpoints.
 */
class AddressController extends Controller
{
    /**
     * Addresses list
     *
     * List of all addresses.
     *
     * @response {
    "data": [
        {
            "id": 1,
            "zip_code": "endereco 1"
        },
        {
            "id": 2,
            "zip_code": "endereco 2"
        },
        {
            "id": 3,
            "zip_code": "endereco 3"
        },
        {
            "id": 4,
            "zip_code": "endereco 3"
        }
    ]
}
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Address::get();

        return response()->json(['data' => $result]);
    }

    /**
     * Create
     *
     * Creates a new address
     *
     * @response {"msg":"Address created successfully!", "data":{"zip_code":"endereco 4","id":5}}
     * @response 422 {"errors":{"zip_code":["The zip code field is required."]},"status":false}
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

        $result = Address::create($request->all());

        return response()->json(['msg' => 'Address created successfully!', 'data' => $result]);
    }

    // Requests validation
    private function validation($request)
    {
        $validator = Validator::make($request->all(), [
            'zip_code' => 'required|string'
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

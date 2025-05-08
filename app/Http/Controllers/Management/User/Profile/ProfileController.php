<?php

namespace App\Http\Controllers\Management\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Management\User\User\Actions\Index;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public $model;
    public $table;

    public function __construct()
    {
        $this->model = User::class;
        $this->table = 'users';
    }

    public function update_info()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,' . request()->id,],
            'phone_number' => ['sometimes', 'nullable', 'string', 'min:11'],
        ]);

        if ($validator->fails()) {
            return entityResponse($validator->errors(), 422, 'error', 'Validation Error');
        }

        $data = $this->model::whereId(request()->id)->first()
            ->fill([
                ...request()->except(['id', 'password']),
            ]);

        $data->save();

        return entityResponse($data);
    }

    public function update_password()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required'],
            'old_password' => ['required', 'string'],
            'password' => ['sometimes', 'nullable', 'confirmed', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return entityResponse($validator->errors(), 422, 'error', 'Validation Error');
        }

        $data = $this->model::whereId(request()->id)->first();

        if (!Hash::check(request()->old_password, $data->password)) {
            return entityResponse([
                'old_password' => ['Incorrect old password'],
            ], 422, 'error', 'Password does not match');
        }

        $data->fill([
            ...request()->except(['id', 'password']),
        ]);

        if (request()->password) {
            $data->password = Hash::make(request()->password);
        }

        $data->save();

        return entityResponse($data);
    }

    public function show($id)
    {
        $data = $this->model::find($id);
        if ($data) {
            return entityResponse($data);
        } else {
            return entityResponse([], 404, 'error', 'Data not found');
        }
    }
}

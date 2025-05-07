<?php

namespace App\Http\Controllers\Management\User\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Management\User\User\Actions\Index;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $model;
    public $table;

    public function __construct()
    {
        $this->model = User::class;
        $this->table = 'users';
    }

    public function index()
    {
        $validator = Validator::make(request()->all(), [
            'fields' => ['array'],
            'relations' => ['array'],
            'conditions' => ['array'],
        ]);

        if ($validator->fails()) {
            return entityResponse($validator->errors(), 422, 'error', 'Validation Error');
        }

        $data = (new Index())->execute($this->model);
        return entityResponse($data);
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return entityResponse($validator->errors(), 422, 'error', 'Validation Error');
        }

        $data = $this->model::create([
            ...request()->except(['id', 'password']),
            'password' => Hash::make(request()->password),
        ]);

        return entityResponse($data);
    }

    public function update()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,' . request()->id,],
            'password' => ['sometimes', 'nullable', 'confirmed', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return entityResponse($validator->errors(), 422, 'error', 'Validation Error');
        }

        $data = $this->model::whereId(request()->id)->first()
            ->fill([
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

    public function soft_delete()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:' . $this->table . ',id'],
        ]);

        if ($validator->fails()) {
            return entityResponse($validator->errors(), 422, 'error', 'Validation Error');
        }

        $data = $this->model::where('id', request()->id)->update([
            'status' => 0,
        ]);

        return entityResponse($data);
    }

    public function restore()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:' . $this->table . ',id'],
        ]);

        if ($validator->fails()) {
            return entityResponse($validator->errors(), 422, 'error', 'Validation Error');
        }

        $data = $this->model::where('id', request()->id)->update([
            'status' => 1,
        ]);

        return entityResponse($data);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:' . $this->table . ',id'],
        ]);

        if ($validator->fails()) {
            return entityResponse($validator->errors(), 422, 'error', 'Validation Error');
        }

        $this->model::where('id', request()->id)->delete();

        return entityResponse([]);
    }

    public function import()
    {
        return entityResponse([]);
    }
}

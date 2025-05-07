<?php

namespace App\Http\Controllers\Management\User\Role;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Management\User\User\Actions\Index;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRoleController extends Controller
{
    public $model;
    public $table;

    public function __construct()
    {
        $this->model = UserRole::class;
        $this->table = 'user_roles';
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
            'title' => ['required', 'string', 'max:20'],
        ]);

        if ($validator->fails()) {
            return entityResponse($validator->errors(), 422, 'error', 'Validation Error');
        }

        $data = $this->model::create([
            ...request()->except(['id']),
        ]);

        return entityResponse($data);
    }

    public function update()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required'],
            'title' => ['required', 'string', 'max:20'],
        ]);

        if ($validator->fails()) {
            return entityResponse($validator->errors(), 422, 'error', 'Validation Error');
        }

        $data = $this->model::whereId(request()->id)->first()
            ->fill([
                ...request()->except(['id']),
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

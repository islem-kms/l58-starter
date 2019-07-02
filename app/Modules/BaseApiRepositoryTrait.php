<?php
/**
 * Created by PhpStorm.
 * User: Islem Khemissi
 */

namespace App\Modules;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

trait BaseApiRepositoryTrait
{
    use BaseApiResponse;

    abstract function model();
    abstract function validationRules($resource_id = 0);

    private function classNameForResponse($is_plural = 0)
    {
        $class_name = Str::snake(class_basename($this->model()));
        return $is_plural ? Str::plural($class_name) : $class_name;
    }

    public function index()
    {
        $data = $this->model()::all();

        return $this->success($this->classNameForResponse(1) . '_list', $data);
    }

    public function create($request_data)
    {
        Validator::make($request_data, $this->validationRules())->validate();

        $data = $this->model()::create($request_data);

        return $this->success($this->classNameForResponse() . '_created', $data);
    }

    public function show($resource_id)
    {
        $resource = $this->model()::findOrFail($resource_id);

        return $this->success($this->classNameForResponse(), $resource);
    }

    public function update($resource_id, $request_data)
    {
        $resource = $this->model()::findOrFail($resource_id);

        Validator::make($request_data, $this->validationRules($resource_id))->validate();

        $resource->update($request_data);

        return $this->success($this->classNameForResponse() . '_updated', $resource);
    }

    public function delete($resource_id)
    {
        $resource = $this->model()::findOrFail($resource_id);

        $resource->delete();

        return $this->success($this->classNameForResponse() . '_deleted');
    }
}

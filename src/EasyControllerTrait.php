<?php

namespace MaddyAlj\EasyController;

use Illuminate\Http\Request;

trait EasyControllerTrait
{
    protected $model = '\App\\';
    protected $perPage = 15;

    public function all()
    {
        return $this->model::all();
    }

    public function paginate()
    {
        return $this->model::paginate($this->perPage);
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

    public function create(Request $request)
    {
        return $this->model::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $object = $this->model::find($id);
        if ($object->update($request->all()) === true) {
            return $object->fresh();
        }
        return $object;
    }

    public function delete($id)
    {
        return $this->model::find($id)->delete();
    }
}

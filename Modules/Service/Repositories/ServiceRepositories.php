<?php

namespace Modules\Service\Repositories;

use Modules\Service\Actions\CreateCategory;
use Modules\Service\Actions\DeleteCategory;
use Modules\Service\Actions\UpdateCategory;
use Modules\Service\Entities\Service;

class ServiceRepositories implements ServiceInterface
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

    public function all()
    {
        return Service::latest('id')->get();
    }
    /**
     * Store a newly created resource in storage.
     * @param CategoryFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        return CreateService::create($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(object $data)
    {
        return DeleteService::delete($data);
    }
}

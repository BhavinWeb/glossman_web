<?php

namespace Modules\Driver\Repositories;

use Modules\Driver\Actions\CreateDriver;
use Modules\Driver\Actions\DeleteDriver;
use Modules\Driver\Actions\UpdateDriver;
use Modules\Driver\Entities\Driver;

class DriverRepositories implements DriverInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return Driver::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Object $data
     */
    public function store(Object $data)
    {
        return CreateDriver::create($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Object $request
     * @param Object $product
     * @return \Illuminate\Http\Response
     */
    public function update(Object $request, Object $data)
    {
        return UpdateDriver::update($request, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Object $data
     * @return \Illuminate\Http\Response
     */
    public function destroy(Object $data)
    {
        return DeleteDriver::delete($data);
    }
}

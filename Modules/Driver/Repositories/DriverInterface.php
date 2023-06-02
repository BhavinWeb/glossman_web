<?php

namespace Modules\Driver\Repositories;

interface DriverInterface
{
    public function all();
    public function store(Object $data);
    public function update(Object $request, Object $data);
    public function destroy(Object $data);
}

<?php

namespace Modules\Service\Repositories;


interface ServiceInterface
{
    public function all();
    public function store($data);
    public function destroy(object $data);
}

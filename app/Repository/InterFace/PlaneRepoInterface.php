<?php

namespace App\Repository\InterFace;

interface PlaneRepoInterface
{
    public function index();
    public function edit($id);
    public function store($request);
    public function update($id, $request);
    public function delete($id);
}

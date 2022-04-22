<?php


namespace App\Repository;


interface libraryRepositoryInterface
{
    //index
    public function index();

    //destroy
    public function create();

    //destroy
    public function store($request);

    //destroy
    public function edit($id);

    //destroy
    public function update($request);

    //destroy
    public function destroy($request);

    //download
    public function download($filename);
}

<?php


namespace App\Repository;


interface FeeRepositoryInterface
{
    /// index
    public function index();

    //////Create
    public function Create();

    //////store_fee
    public function store_fee($request);

    ////edit
    public function edit($id);

    ///////updata
    public function updata($request);

    ///destore
    public function destore($request);
}

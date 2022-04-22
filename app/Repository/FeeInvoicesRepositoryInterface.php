<?php


namespace App\Repository;


interface FeeInvoicesRepositoryInterface
{
    // index
    public function index();
    //show
    public function show($id);
    //Get_Amount
    public function Get_Amount($id);
    //store
    public function store($request);

    //edit
    public function edit($id);

    //updata
    public function updata($request);

    //updata
    public function destroy($request);
}

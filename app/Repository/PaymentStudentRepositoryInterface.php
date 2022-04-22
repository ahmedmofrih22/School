<?php


namespace App\Repository;


interface PaymentStudentRepositoryInterface
{
    // index
    public function index();
    //show
    public function show($id);

    //store
    public function store($request);

    //edit
    public function edit($id);

    //updata
    public function updata($request);

    //updata
    public function destroy($request);
}

<?php

namespace App\Repository;

interface QuizzeRepositoryInterface
{


    //index
    public function index();


    //show
    public function creat();


    ////edit
    public function edit($id);


    ///store
    public function store($request);




    ///updata
    public function updata($request);


    public function destroy($request);
}

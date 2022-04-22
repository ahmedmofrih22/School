<?php


namespace App\Repository;


interface StudentPromotionRepositoryInterface
{

    //index
    public function index();

    //store
    public function store($request);


    //create
    public function create();

    //destroy
    public function destroy($request);
}

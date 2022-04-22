<?php


namespace App\Repository;


interface StudentGraduatedRepositoryInterface
{
    //index
    public function index();
    //create
    public function create();

    //storesoftdelete
    public function storesoftdelete($request);
    //ReturnData
    public function ReturnData($request);
    //destroy
    public function destroy($id);
    //det
    public function det($request);
}

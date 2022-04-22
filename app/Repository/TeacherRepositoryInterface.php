<?php

namespace App\Repository;

interface TeacherRepositoryInterface
{

    // get all Teachers
    public function getAllTeachers();



    // Gitspecializations
    public function Getspecializations();
    //  GitGender
    public function GetGender();
    public function StoreTeacher($request);
    public function EditTeacher($id);
    public function updateTeacher($request);
    public function deleteTeacher($request);
}

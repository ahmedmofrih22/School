<?php

namespace App\Repository;

interface StudentRepositoryInterface
{
    //Get add from student
    public function Create_Student();

    //Get_Classrooms
    public function  Get_classrooms($id);

    //Get_Sections
    public function  Get_Sections($id);

    //store_student
    public function  store_student($request);

    //index_student
    public function  index_student();

    //Edit_student
    public function Edit_student($id);
    //Updata_student
    public function Updata_student($request);

    //destroy_student
    public function destroy_student($request);

    //show_student
    public function show_student($id);
    //Upload_attachment
    public function  Upload_attachment($request);
    //Download_attachment
    public function Download_attachment($studentsname, $filename);

    //Delete_attachment
    public function Delete_attachment($request);

    //aad_Graduated
    public function aad_Graduated($request);
}

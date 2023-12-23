<?php

namespace App\Http\Controllers;
use App\Models\Group;
use App\Models\Language;
use App\Models\Profesor;
use App\Models\Room;
use App\Models\Subject;
use App\Models\Type;
use App\Models\User;

use Illuminate\Http\Request;

class SchedulleGenerator extends Controller
{
    private function availableProfessor($day,$lesson,$subject){
        
    }
    private function optimalSubject($group){

    }
    private function optimalRoom($numberStudents,$lab = false){
    
    }
    private function checkHorribleSchedule(){

    }
    private function scheduleScore(){

    }
    private function assignTeacher(){
        //compute if teacher is available to conduct all lessons
        // try to give every teacher a lesson
        $professors= Professor::all();
    }
    public function generate()
    {
        // Retrieve data from the database using the model
        $groups = [Group::pluck('speciality'),Group::pluck('number_pers'),Group::pluck('subject_id')];  

        $teachers = [Profesor::pluck('name'),Profesor::pluck('subject_id')];

        $subjects =  [Subjects::pluck('course'),Subjects::pluck('theory'),Subjects::pluck('practice'),Subjects::pluck('lab'),]

        // Pass the data to the view or perform other operations
        return $groups[0];
    }
}

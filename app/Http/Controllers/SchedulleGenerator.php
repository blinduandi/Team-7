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
use Illuminate\Support\Facades\DB;

class SchedulleGenerator extends Controller
{

    public $groups,$teachers,$subjects,$commputetdTeachers;
    public $torent = [];

    public function __construct()
    {
        $this->groups = [Group::pluck('speciality'),Group::pluck('number_pers'),Group::pluck('subject_id'),Group::pluck('language_id'),Group::pluck('id')];  
        $mon_class_1 = Profesor::pluck('mon_class_1');


        $this->teachers = Profesor::all();

        $this->subjects =  [Subject::pluck('course'),Subject::pluck('theory'),Subject::pluck('practice'),Subject::pluck('lab'),Subject::pluck('total'),Subject::pluck('year'),Subject::pluck('semester'),0,Subject::pluck('id')];

    }

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
    public function assignTeacher(){
        $sortedTeachers = collect($this->commputetdTeachers)->sortBy('total')->values()->all();
        $sortedGroups = collect($this->groups)->sortBy('number_pers')->values()->all();

        foreach ($this->groups as $group){

        }
    }

    private function teachersTime(){
        foreach ($this->teachers as $teacher) {

            $mondayTotal = $teacher['mon_class_1'] +
                        $teacher['mon_class_2'] +
                        $teacher['mon_class_3'] +
                        $teacher['mon_class_4'] +
                        $teacher['mon_class_5'] +
                        $teacher['mon_class_6'] +
                        $teacher['mon_class_7'];
    
            echo "Monday Total: " . $mondayTotal . '<br>';
    
            $tuesdayTotal = $teacher['tue_class_1'] +
                            $teacher['tue_class_2'] +
                            $teacher['tue_class_3'] +
                            $teacher['tue_class_4'] +
                            $teacher['tue_class_5'] +
                            $teacher['tue_class_6'] +
                            $teacher['tue_class_7'];
    
            echo "Tuesday Total: " . $tuesdayTotal . '<br>';
    
            // Wednesday
            $wednesdayTotal = $teacher['wed_class_1'] +
                            $teacher['wed_class_2'] +
                            $teacher['wed_class_3'] +
                            $teacher['wed_class_4'] +
                            $teacher['wed_class_5'] +
                            $teacher['wed_class_6'] +
                            $teacher['wed_class_7'];
            
            echo "Wednesday Total: " . $wednesdayTotal . '<br>';
            
            // Thursday
            $thursdayTotal = $teacher['thu_class_1'] +
                            $teacher['thu_class_2'] +
                            $teacher['thu_class_3'] +
                            $teacher['thu_class_4'] +
                            $teacher['thu_class_5'] +
                            $teacher['thu_class_6'] +
                            $teacher['thu_class_7'];
            
            echo "Thursday Total: " . $thursdayTotal . '<br>';
            
            // Friday
            $fridayTotal = $teacher['fri_class_1'] +
                        $teacher['fri_class_2'] +
                        $teacher['fri_class_3'] +
                        $teacher['fri_class_4'] +
                        $teacher['fri_class_5'] +
                        $teacher['fri_class_6'] +
                        $teacher['fri_class_7'];
            
            echo "Friday Total: " . $fridayTotal . '<br>';
            
            // Saturday
            $saturdayTotal = $teacher['sat_class_1'] +
                            $teacher['sat_class_2'] +
                            $teacher['sat_class_3'] +
                            $teacher['sat_class_4'] +
                            $teacher['sat_class_5'] +
                            $teacher['sat_class_6'] +
                            $teacher['sat_class_7'];
            
            echo "Saturday Total: " . $saturdayTotal . '<br>';
            
            // Sunday
            $sundayTotal = $teacher['sun_class_1'] +
                        $teacher['sun_class_2'] +
                        $teacher['sun_class_3'] +
                        $teacher['sun_class_4'] +
                        $teacher['sun_class_5'] +
                        $teacher['sun_class_6'] +
                        $teacher['sun_class_7'];
            
            echo "Sunday Total: " . $sundayTotal . '<br>';
            
            $total = $sundayTotal+$saturdayTotal+$fridayTotal+$thursdayTotal+$wednesdayTotal+$tuesdayTotal+$mondayTotal;
            echo "TOTAL HOURS AVAILABLE THIS WEEK: " . $total."<hr> \n";
            
            $this->commputetdTeachers = ['id' => $teacher['id'], 'total' => $total];
            
            }

    }

    function countSimilarities($inputArray)
{
    // Initialize an empty matrix
    $matrix = [];

    // Loop through each line in the input array
    foreach ($inputArray as $line1) {
        // Initialize an array to store counts for the current line
        $counts = [];

        // Loop through each line again to compare with the current line
        foreach ($inputArray as $line2) {
            // Count the number of similarities between the two lines
            $similarities = count(array_intersect($line1, $line2));

            // Add the count to the array
            $counts[] = $similarities;
        }

        // Add the counts array to the matrix
        $matrix[] = $counts;
    }
    return $matrix;
}

    private function createTorent(){
        $max = Room::select('nr_pers')->max('nr_pers');

        $groupsSpec = [];
        $counter = 0;
        foreach ($this->groups[2] as $group) {
            $array = explode(', ', $group);
            sort($array);
            $groupsSpec[$counter] = $array; // Use $counter as the key for the sub-array
            $counter++;
        }

        $matrix = $this->countSimilarities($groupsSpec);

// Get the number of rows
$rows = count($matrix);

// Get the number of columns (assuming all rows have the same number of columns)
$columns = count($matrix[0]);

// Display the size of the matrix
// echo "Matrix size: $rows x $columns";
$cnti = 0;
$cntj = 0;
foreach ($this->groups[0] as $i => $subject) {
    
    if (!isset($this->groups[1][$i])) continue;
    $max_value = max($matrix[$i]);
    $indexes = array_keys($matrix[$i], $max_value);
    $arr = [];
    $count = 0;

    for ($j = 0; $j < count($indexes); $j++) {
        $arr[$j] = $this->groups[0][$indexes[$j]];
        $count += $this->groups[1][$indexes[$j]];
        if($count<=$max){
            $this->torent[$cnti][$cntj] = $this->groups[4][$indexes[$j]];
            $cntj++;
        }else{
            $cnti++;
            $cntj=0;
            $count = 0;
            $this->torent[$cnti][$cntj] = $this->groups[4][$indexes[$j]];

        }

    }
    sort($arr);


    for ($i = 0; $i < $cnti; $i++) {

        print_r($this->torent[$i]);
   
    }
    echo '<h1>'.$count.'</h1>';





    //print_r($arr);

    
    echo  "<br>";
}







        // foreach ($groupsSpec as $currentKey =>$group){
        //     for($i = $currentKey+1 ; $i <count($groupsSpec) ;$i++){
        //         if($group == $groupsSpec[$i]) echo $this->groups[0][$i]."===".$this->groups[0][$currentKey]."\n";
        //     }
        // }

        
               
    }

    public function generate()
    {   
        // $this->teachersTime();
        // $this->assignTeacher();
        $this->createTorent(); 
        return $this->groups[0];
    }
}

@php
use App\Models\Group;
use App\Models\Language;
use App\Models\Profesor;
use App\Models\Room;
use App\Models\Subject;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Facades\DB;
$filePath = public_path('app/json/data.json');

if (file_exists($filePath)) {
$contents = file_get_contents($filePath);

// Decode the JSON string into an object
$jsonObject = json_decode($contents);

if ($jsonObject !== null) {
// Successfully decoded the JSON file into an object
// You can now use $jsonObject as an object

// Example: Output the entire JSON object
$jsonArray = (array)$jsonObject;

//print_r($jsonArray['365'][0]);

echo '<table class="table">
    <tr>
        <th>Grupa</th>
        <th>Luni</th>
        <th>Marti</th>
        <th>Miercuri</th>
        <th>Joi</th>
        <th>Vineri</th>
    </tr>';
// $hours = ['8:00-9:30' , '9:45-11:15' , '11:30-13:30' , '13:30-15:00' , '15:15-16:45' , '17:00-18:30', '18:45-20:15'];

foreach ($jsonArray as $key => $value) {
   $group =  DB::select('SELECT speciality FROM groups WHERE id = ?', [$key]);
   echo '<tr>';
        echo '<td>' . (string)$group[0]->speciality . '</td>';
        

    for($i = 0; $i < 5; $i++ ){
        
        echo '<td>';

        for ($j = 0; $j < 7; $j++) { 
            echo '<div class="d-flex justify-content-center"style="height:100px; width:100%;">';
                
            if ($jsonArray[$key][$i][$j] !== null){
                //print_r( $jsonArray[$key][$i][$j]);
                foreach ($jsonArray[$key][$i][$j] as $key1 => $val) {
                    if($key1 == 0){
                    $lesson = DB::select('SELECT course FROM subjects WHERE id = ?', [$jsonArray[$key][$i][$j][0]]); 
                    $room = DB::select('SELECT room_name FROM rooms WHERE id = ?', [$jsonArray[$key][$i][$j][2]]);
                    $prof = DB::select('SELECT prof.name FROM profesors as prof WHERE id = ?', [$jsonArray[$key][$i][$j][3]]);
                        //echo $val."<br>";
                        
                    echo '<span style="color:coral;">'.(string)$lesson[0]->course . "<br>";
                    echo '<span style="color:blue;">'.$jsonArray[$key][$i][$j][1] . "<br>";
                    echo '<span style="color:coral;">'.(string)$room[0]->room_name . "<br>";
                    echo '<span style="color:black;">'.(string)$prof[0]->name . "<br>";
                
                    }
                }
                
                    
            }
            echo '</div>';
            echo '<hr style="color: black">';
        }
        echo '</td>';
    }
    echo '</tr>';
}
echo ' </table>';
} else {
// Handle the case where JSON decoding failed
echo '<h1>Error decoding JSON</h1>';
}
} else {
echo '<h1>File not found</h1>';
}

@endphp
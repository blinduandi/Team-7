<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="css/app.css">
    <meta name="theme-color" content="#000000" />
    <meta
      name="description"
      content="Setup Promobot in your server"
    />

    <title>SchedGen</title>
  </head>
  <body style = "margin-top:0">
    <header class = "mb-5" style="position:relative; top:0;">
        <nav class="navbar navbar-expand-lg navbar-light bg-dark"  >
            <div class="container-fluid">
                <a class="navbar-brand" href="#"  style = "color:white;">SchedGen</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto d-flex justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin" style = "color:white;">
                                                @auth('backpack')
                        {{-- User is logged in --}}
                        Welcome, {{ auth('backpack')->user()->name }}!<br> Access Admin Pannel! 
                    @else
                        {{-- User is not logged in --}}
                        Please log in to access this content.
                    @endauth




                            </a>
                        </li>
                        <!-- Add more menu items as needed -->
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
          <div class="d-flex justify-content-center mb-5">  <h1>SCHEDULE</h1></div>
        @yield('content')
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
            <tr style="font-size:30px;">
                <th class = "p-3">Grupa</th>
                <th class = "p-3">Luni</th>
                <th class = "p-3">Marti</th>
                <th class = "p-3">Miercuri</th>
                <th class = "p-3">Joi</th>
                <th class = "p-3">Vineri</th>
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


        
    </main>
			
  </body>
</html>
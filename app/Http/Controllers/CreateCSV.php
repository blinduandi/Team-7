<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Language;
use App\Models\Profesor;
use App\Models\Room;
use App\Models\Subject;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Facades\Http;


class CreateCSV extends Controller
{
    public $groups,$teachers,$subjects,$rooms;
    public $torent = [];

    public function __construct()
    {
        $this->groups = [Group::pluck('id'),Group::pluck('speciality'),Group::pluck('language_id'),Group::pluck('number_pers'),Group::pluck('subject_id')];  

        $this->subjects =  [Subject::pluck('id'),Subject::pluck('course'),Subject::pluck('theory'),Subject::pluck('practice'),Subject::pluck('lab'),Subject::pluck('total'),Subject::pluck('year'),Subject::pluck('semester')];

        $this->teachers = Profesor::all();

        $this->rooms = [Room::pluck('id'),Room::pluck('room_name'),Room::pluck('is_lab_cab'),Room::pluck('nr_pers')];
    }


    public function saveDataToCSV()
{
// Save groups data to CSV with specific headers
$this->saveToCSV('groups.csv', $this->groups, ['id', 'speciality', 'language_id', 'number_pers', 'subject_id']);

// Save subjects data to CSV with specific headers
$this->saveToCSV('subjects.csv', $this->subjects, ['id', 'course', 'theory', 'practice', 'lab', 'total', 'year', 'semester']);

// Save teachers data to CSV with specific headers
$this->saveToCSVV('teachers.csv', $this->teachers, [
    'id',	
    'name',	
    'subject_id',	
    'type_class_id',	
    'mon_class_1',	
    'mon_class_2',	
    'mon_class_3',	
    'mon_class_4',	
    'mon_class_5',	
    'mon_class_6',	
    'mon_class_7',	
    'tue_class_1',	
    'tue_class_2',	
    'tue_class_3',	
    'tue_class_4',	
    'tue_class_5',	
    'tue_class_6',	
    'tue_class_7',	
    'wed_class_1',	
    'wed_class_2',	
    'wed_class_3',	
    'wed_class_4',	
    'wed_class_5',	
    'wed_class_6',	
    'wed_class_7',	
    'thu_class_1',	
    'thu_class_2',	
    'thu_class_3',	
    'thu_class_4',	
    'thu_class_5',	
    'thu_class_6',	
    'thu_class_7',	
    'fri_class_1',	
    'fri_class_2',	
    'fri_class_3',	
    'fri_class_4',	
    'fri_class_5',	
    'fri_class_6',	
    'fri_class_7',	
    'sat_class_1',	
    'sat_class_2',	
    'sat_class_3',
    'sat_class_4',	
    'sat_class_5',	
    'sat_class_6',	
    'sat_class_7',	
    'created_at',	
    'updated_at',]);

// Save rooms data to CSV with specific headers
$this->saveToCSV('rooms.csv', $this->rooms, ['id', 'room_name', 'is_lab_cab', 'nr_pers']);

$response = Http::get('http://127.0.0.1:5000/upload-csv');
$data = $response->json();

$jsonFilePath = 'app/json/data.json';

// Check if the directory exists, if not, create it
$directory = dirname($jsonFilePath);
if (!is_dir($directory)) {
    mkdir($directory, 0755, true);
}

// Convert the array to a JSON string
$jsonData = json_encode($data, JSON_PRETTY_PRINT);

// Write the JSON data to the file
file_put_contents($jsonFilePath, $jsonData);


    // dd($data);
    
    //return $data;
    return redirect()->route('home');

}

private function saveToCSV($filename, $data, $headers = [])
{
    $filePath = storage_path("app/csv/{$filename}");

    // Open the file for writing
    $file = fopen($filePath, 'w');

    if (empty($data)) {
        fclose($file);
        return;
    }

    // Convert the data to an array
    $dataArray = [];

    // Convert the data to an array with columns as rows
    foreach ($data as $row) {
        $rowData = $row->toArray();
        $dataArray[] = $rowData;
    }

    // If there are no rows, close the file and return
    if (empty($dataArray)) {
        fclose($file);
        return;
    }

    // If specific headers are provided, use them; otherwise, get the headers from the data
    $headers = !empty($headers) ? $headers : array_keys($dataArray[0]);

    // Write the header
    fputcsv($file, $headers);

    // Transpose the data (swap columns with rows)
    $transposedData = array_map(null, ...$dataArray);

    // Write the transposed data
    foreach ($transposedData as $row) {
        fputcsv($file, $row);
    }

    // Close the file
    fclose($file);
}
private function saveToCSVV($filename, $data)
{
    $filePath = storage_path("app/csv/{$filename}");

    // Open the file for writing
    $file = fopen($filePath, 'w');

    if (empty($data)) {
        fclose($file);
        return;
    }

    // If the data is a collection of models
    if ($data[0] instanceof \Illuminate\Database\Eloquent\Model) {
        // Convert the first element to an array and get the keys
        $headers = array_keys($data[0]->toArray());

        // Write the header
        fputcsv($file, $headers);

        // Write the data
        foreach ($data as $row) {
            // Convert each collection to an array
            $rowData = $row->toArray();
            fputcsv($file, $rowData);
        }
    } else {
        // If the data is a simple array
        foreach ($data as $row) {
            fputcsv($file, [$row]);
        }
    }

    // Close the file
    fclose($file);
}

}

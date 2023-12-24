<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Add this line

class DownloadController extends Controller
{
    public function downloadPDF()
    {
        //get all users

        // load view for pdf
        $pdf = PDF::loadView('table');

        //download pdf
        return $pdf->download('users.pdf');
    }

    /**
     * View PDF on the browser
     * @return pdf [description]
     */
    public function viewPDF()
    {
        //get all users

        // load view for pdf
        $pdf = PDF::loadView('table');

        // stream pdf on browser
        return $pdf->stream();
    }
}

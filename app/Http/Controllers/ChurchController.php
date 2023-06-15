<?php

namespace App\Http\Controllers;

use App\Models\Church;
use Illuminate\Http\Request;

class ChurchController extends Controller
{
    //handle the logic to handle the church controller
    public function getCommunities($id)
    {
        $church = Church::findOrFail($id);
        $communities = $church->communities;

        return response()->json($communities);
    }
}

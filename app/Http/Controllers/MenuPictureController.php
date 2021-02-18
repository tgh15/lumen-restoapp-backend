<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UtilityService;
use App\Models\MenuPicture;

class MenuPictureController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
        $this->utilityService = new UtilityService;
        $this->menupic = new MenuPicture;
    }

    public function update(Request $request, $id){
        $data = $this->menupic->updatePic($request, $id);
        if ($data != false) {
            # code...
            $success_message = "menu picture edited successfully";
            return $this->utilityService->is200ResponseWithData($success_message, $data);
        }
        $message = "picture not found";
        return $this->utilityService->is404Response($message);
    }

    public function destroy($id){
        if ($this->menupic->destroyPic($id)) {
            $success_message = "picture deleted successfully";
            return $this->utilityService->is200Response($success_message);
        }
        $message = "picture not found";
        return $this->utilityService->is404Response($message);
    }
}

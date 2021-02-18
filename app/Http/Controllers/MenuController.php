<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use App\Http\Services\UtilityService;
use App\Models\Menu;
use App\Http\Resources\MenuResource;

class MenuController extends Controller
{
    protected $menu;
    protected $utilityService;

    public function __construct(){
        $this->middleware('auth:admin', ['except' => ['show', 'index']]);
        $this->utilityService = new UtilityService;
        $this->menu = new Menu;
    }

    public function index(){
        $data = MenuResource::collection($this->menu->getMenus());
        // $data = $this->menu->getMenus();
        $success_message = "get menus successfully";
        return $this->utilityService->is200ResponseWithData($success_message, $data);
    }
    
    public function store(MenuRequest $request){
        $this->menu->storeMenu($request);
        $success_message = "menu created successfully";
        return $this->utilityService->is200ResponseWithData($success_message, $request->all());
    }

    public function show($id){
        if ($data = $this->menu->showMenu($id)) {
            $response = MenuResource::collection($data);
            $success_message = "get menu successfully";
            return $this->utilityService->is200ResponseWithData($success_message, $response);
        }
        $message = "menu not found";
        return $this->utilityService->is404Response($message);
    }

    public function update(Request $request, $id){
        $this->menu->updateMenu($request, $id);
        $success_message = "menu edited successfully";
        return $this->utilityService->is200ResponseWithData($success_message, $request->all());
    }

    public function destroy($id){
        if ($this->menu->destroyMenu($id)) {
            $success_message = "menu deleted successfully";
            return $this->utilityService->is200Response($success_message);
        }
        $message = "menu not found";
        return $this->utilityService->is404Response($message);
    }
}

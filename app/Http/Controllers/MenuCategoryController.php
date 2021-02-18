<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\UtilityService;
use App\Models\MenuCategory;

class MenuCategoryController extends Controller
{
    protected $category;
    protected $utilityService;

    public function __construct(){
        $this->middleware('auth:admin', ['except' => ['index', 'show']]);
        $this->utilityService = new UtilityService;
        $this->category = new MenuCategory;
    }
    
    public function index(){
        $data = $this->category->getCategories();
        $success_message = "get categories successfully";
        return $this->utilityService->is200ResponseWithData($success_message, $data);
    }

    public function show($id){
        if ($data = $this->category->showCategory($id)) {
            $success_message = "get categories successfully";
            return $this->utilityService->is200ResponseWithData($success_message, $data);
        }
        $message = "category not found";
        return $this->utilityService->is404Response($message);
    }

    public function store(CategoryRequest $request){
        $this->category->storeCategory($request);
        $success_message = "Category created successfully";
        return $this->utilityService->is200Response($success_message);
    }

    public function update(Request $request, $id){
        $this->category->updateCategory($request, $id);
        $success_message = "category edited successfully";
        return $this->utilityService->is200Response($success_message);
    }

    public function destroy($id){
        if ($this->category->destroyCategory($id)) {
            $success_message = "category deleted successfully";
            return $this->utilityService->is200Response($success_message);
        }
        $message = "category not found";
        return $this->utilityService->is404Response($message);
    }
}

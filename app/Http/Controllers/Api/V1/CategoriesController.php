<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FoodType;

//Creation of EndPoint
class CategoriesController extends Controller
{
        
    public function get_categories(Request $request){
  
        $list = FoodType::where('parent_id', 1)->take(10)->orderBy('created_at', 'DESC')->get();
        
                foreach ($list as $item){
                    $item['description']=strip_tags($item['description']);
                    $item['description']=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$item['description']); 
                    
                }
                
                 $data =  [
                    'total_size' => $list->count(),
                    'parent_id' => 1,
                    'offset' => 0,
                    'categories' => $list
                ];
                
         return response()->json($data, 200);
 
    }

}

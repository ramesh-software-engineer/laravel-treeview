<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session; 
use App\Models\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller; 
class AjaxController extends Controller
{
    
    public function dir_to_sql($dir, $parent) 
    {
      global $qry;
      global $id;
      $result = array();
      $cdir = scandir($dir);
      foreach($cdir as $key => $value) {
        if(!in_array($value, array('.', '..'))) {
            $id++;
            $qry[] = "".$id.", ".$dir.", ".$parent.", ".$value."";
            if(is_dir($dir . '/' . $value)) {
                $this->dir_to_sql($dir . '/' . $value, $id);
            }
        }
      }
      return $qry;
    }


    public function membersTree($parentKey){
       
          $category = Category::byParent($parentKey)->get();   
          $out = array();
         foreach ($category as $key => $value) { 
             $id = $value['id'];
             $out[$id]['id'] = $value['id'];
             $out[$id]['name'] = $value['name'];
             $out[$id]['text'] = $value['name'];
             $out[$id]['nodes'] = array_values($this->membersTree($value['id']));
          }

          return $out;
    }
   
    public function store(Request $request) {  
  
            $response =[]; 
            $file_path = $request->input('file_path');
            $sql = $this->dir_to_sql($file_path, 0);
            $category = new Category;
            $category->truncate(); 
            foreach ($sql as $key => $value) {
               /* echo "<pre>";
                print_r($value);
                echo "</pre>";*/
                $value = explode(",", $value); 
                $category = new Category; 
                $category->name = $value[3];
                $category->parent_id = $value[2];   
                $category->folder_id = $value[1];      
                $category->save(); 
                
            } 
            
            $response['status'] = "success"; 
            $response['message'] = '<p style="color:green">Folder parsed successfully and stored in DB!</p>'; 
            
            return response()->json($response); 
    }


    public function list(){
        $parentKey = 0;
        $category = Category::all(); 
          if(count($category) > 0)
          {
              $data = $this->membersTree($parentKey);
          }else{
              $data=["id"=>"0","name"=>"No Members present in list","text"=>"No Members is present in list","nodes"=>[]];
          }
       
           $this->membersTree($parentKey);
      
          return response()->json(array_values($data)); 
    }
    
    
}

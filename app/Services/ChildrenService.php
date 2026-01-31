<?php
namespace App\Services;

use App\Models\Childrens;
use App\Models\ParentsChildrens;
use Illuminate\Support\Facades\Storage;

class ChildrenService
{
    public static function getChildrens(){
        return Childrens::select('id', 'first_name', 'last_name', 'email', 'country', 'birth_date', 'birth_certificate')->get();
    }

    public static function getChildrensPaginate(){
        return Childrens::select('id', 'first_name', 'last_name', 'email', 'country', 'birth_date', 'birth_certificate')->paginate(5);
    }

    public static function getChildren($id){
        return Childrens::find($id);
    }

    public static function addChildren($data, $file){
        if($file){
            $imagePath = $file->store('childrens/certificate', 'public');
        }
        
        $children = Childrens::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'country' => $data['country'],
            'birth_date' => $data['birth_date'],
            'state' => $data['state'],
            'city' => $data['city'],
            'birth_certificate' => $imagePath ?? null
        ]);

        if(isset($data['parents'])){
            foreach($data['parents'] as $parent_id){
                ParentsChildrens::create([
                    'parent_id' => $parent_id,
                    'children_id' => $children->id,
                ]);
            }
        }

        return $children;
    }

    public static function updateChildren($data, $file, $children){
        if($file){
            if(!empty($children->birth_certificate) && Storage::disk('public')->exists($children->birth_certificate)){
                Storage::disk('public')->delete($children->birth_certificate);
            }
            $imagePath = $file->store('childrens/certificate', 'public');
        }

        $childrenParents = $children->parents;

        if($childrenParents->isNotEmpty()){
            $childrenParents->whereNotIn('parent_id', $data['parents'])->each(function($item){
                $item->delete();
            });
        }

        if(isset($data['parents'])){
            foreach($data['parents'] as $parent_id){
                ParentsChildrens::updateOrCreate([
                    'parent_id' => $parent_id,
                    'children_id' => $children->id,
                ]);
            }
        }
        
        return $children->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'country' => $data['country'],
            'birth_date' => $data['birth_date'],
            'state' => $data['state'],
            'city' => $data['city'],
            'birth_certificate' => $imagePath ?? ($children->birth_certificate ?? null)
        ]);
    }

    public static function deleteChildren($children){
        if(!empty($children->birth_certificate) && Storage::disk('public')->exists($children->birth_certificate)){
            Storage::disk('public')->delete($children->birth_certificate);
        }
        return $children->delete();
    }
}
?>
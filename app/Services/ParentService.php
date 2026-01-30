<?php
namespace App\Services;

use App\Models\Parents;
use App\Models\ParentsChildrens;
use Illuminate\Support\Facades\Storage;

class ParentService
{
    public static function getParents(){
        return Parents::select('id', 'first_name', 'last_name', 'email', 'country', 'birth_date', 'profile_image')->get();
    }

    public static function getParent($id){
        return Parents::find($id);
    }

    public static function addParent($data, $proofs, $file){
        if($file){
            $imagePath = $file->store('parents/images', 'public');
        }

        $proofPaths = [];
        if($proofs){
            foreach($proofs as $proof){
                $proofPaths[] = $proof->store('parents/proofs', 'public');
            }
        }
        
        $parent = Parents::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'country' => $data['country'],
            'birth_date' => $data['birth_date'],
            'state' => $data['state'],
            'city' => $data['city'],
            'education' => $data['education'],
            'occupation' => $data['occupation'],
            'profile_image' => $imagePath ?? null,
            'residential_proof' => !empty($proofPaths) ? json_encode($proofPaths) : null
        ]);

        if(isset($data['childrens'])){
            foreach($data['childrens'] as $children){
                ParentsChildrens::create([
                    'parent_id' => $parent->id,
                    'child_id' => $children,
                ]);
            }
        }

        return $parent;
    }

    public static function updateParent($data, $proofs, $file, $parent){
        if($file){
            if(!empty($parent->profile_image) && Storage::disk('public')->exists($parent->profile_image)){
                Storage::disk('public')->delete($parent->profile_image);
            }
            $imagePath = $file->store('parents/images', 'public');
        }

        $proofPaths = [];
        if($proofs){
            if(!empty($parent->residential_proof)){
                foreach(json_decode($parent->residential_proof) as $proof){
                    if(Storage::disk('public')->exists($proof)){
                        Storage::disk('public')->delete($proof);
                    }
                }
            }
            
            foreach($proofs as $proof){
                $proofPaths[] = $proof->store('parents/proofs', 'public');
            }
        }

        $parentChildrens = $parent->childrens;

        if($parentChildrens->isNotEmpty()){
            $parentChildrens->whereNotIn('children_id', $data['childrens'])->each(function($item){
                $item->delete();
            });
        }

        if(isset($data['childrens'])){
            foreach($data['childrens'] as $children){
                ParentsChildrens::updateOrCreate([
                    'parent_id' => $parent->id,
                    'children_id' => $children,
                ]);
            }
        }

        return $parent->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'country' => $data['country'],
            'birth_date' => $data['birth_date'],
            'state' => $data['state'],
            'city' => $data['city'],
            'education' => $data['education'],
            'occupation' => $data['occupation'],
            'profile_image' => $imagePath ?? ($parent->profile_image ?? null),
            'residential_proof' => !empty($proofPaths) ? json_encode($proofPaths) : null
        ]);
    }

    public static function deleteParent($parent){
        if(!empty($parent->profile_image) && Storage::disk('public')->exists($parent->profile_image)){
            Storage::disk('public')->delete($parent->profile_image);
        }

        if(!empty($parent->residential_proof)){
            foreach(json_decode($parent->residential_proof) as $proof){
                if(Storage::disk('public')->exists($proof)){
                    Storage::disk('public')->delete($proof);
                }
            }
        }

        return $parent->delete();
    }
}
?>
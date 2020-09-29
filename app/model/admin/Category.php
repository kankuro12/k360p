<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\model\admin\Product;
class Category extends Model
{
    protected $primaryKey = 'cat_id';
    protected $fillable = [
        'cat_name',
        'cat_description',
        'cat_image',
    ];
    protected $guarded = [];
    use NodeTrait;

    public function child()
    {
        return Category::where('parent_id',$this->cat_id)->get();
    }
    public function count()
    {
        return Category::where('parent_id',$this->cat_id)->count();
    }

    public function childList()
    {
        $data = [$this->cat_id];
        foreach ($this->child() as $child) {
            array_push($data, $child->cat_id);
            if ($child->count() > 0) {
                $data = array_merge($data, $child->childList());
            }
        }
        return $data;
    }

    public function getShippingPrice($weight,$range,$shipping_class_id){
        $data=\App\WeightClass::where('category_id',$this->cat_id)
            ->where('min','<=',$weight)
            ->where('max','>=',$weight)
            ->where('deliver_range',$range)
            ->where('shipping_class_id',$shipping_class_id)
            ->first();
        // dd($data);
        return $data;
    }

    public function closingCharges(){
        return $this->hasMany('\App\ClosingCharge','category_id','cat_id');
    }

    public function subcat(){
        return $this->hasMany(Category::class,'parent_id');
    }
}

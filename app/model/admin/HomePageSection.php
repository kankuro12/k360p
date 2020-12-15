<?php

namespace App\model\admin;

use App\BlogDisplay;
use App\Setting\HomePage;
use App\SliderGroup;
use Illuminate\Database\Eloquent\Model;
use App\BrandDisplay;

class HomePageSection extends Model
{
    //

    public function childCount()
    {
        return HomePageSection::where('parent_id', $this->id)->count();
    }

    public function child()
    {
        return HomePageSection::where('parent_id', $this->id)->get();
    }

    public function childDel()
    {
        $data = [$this->id];
        foreach ($this->child() as $child) {
            array_push($data, $child->id);
            if ($child->childCount() > 0) {
                $data = array_merge($data, $child->childDel());
            }
        }
        return $data;
    }

    public function addElement()
    {
        if ($this->type > 0) {
            switch ($this->type) {
                case 1:
                    $slider = new SliderGroup();
                    $slider->home_page_section_id = $this->id;
                    $slider->name = $this->name;
                    $slider->save();
                    return $slider;
                    break;
                case 2:
                    return '';
                    break;
                case 4:
                    $boxeditemdisplay = new BoxedItemDisplay();
                    $boxeditemdisplay->home_page_section_id = $this->id;
                    $boxeditemdisplay->title = $this->name;
                    $boxeditemdisplay->save();
                    return $boxeditemdisplay;
                    break;
                default:
                    return null;
                    break;
            }
        }
    }

    public function getElement()
    {
        if ($this->type > 0) {
            switch ($this->type) {
                case 1:
                    $slider = SliderGroup::where('home_page_section_id', $this->id)->first();
                    return $slider;
                    break;
                case 2:
                    $addisplay = AdDisplay::where('home_page_section_id', $this->id)->first();
                    return $addisplay;
                    break;
                case 3:
                    $addisplay = CategoryDisplay::where('home_page_section_id', $this->id)->first();
                    return $addisplay;
                    break;
                case 4:
                    $display = BoxedItemDisplay::where('home_page_section_id', $this->id)->first();
                    return $display;
                    break;
                case 5:
                    $display = BrandDisplay::where('home_page_section_id', $this->id)->get();
                    return $display;
                    break;
                case 6:
                    $display = BlogDisplay::where('home_page_section_id', $this->id)->get();
                    return $display;
                    break;
                default:
                    return null;
                    break;
            }
        } else {
            return null;
        }
    }

    public function render()
    {

        // dd($this);
        switch ($this->type) {
            case 0:
                return HomePage::theme('elements.wrapper');
                break;
            case 1:
                return HomePage::theme('elements.slider');
                break;
            case 2:
                return HomePage::theme('elements.ad');
                break;
            case 3:
                return HomePage::theme('elements.category');
                break;
            case 4:
                return HomePage::theme('elements.boxed');
                break;
            case 5:
                return HomePage::theme('elements.brand');
                break;
            case 6: 
                return HomePage::theme('elements.blog');
                break;
            default:
                return '';
                break;
        }
    }
}

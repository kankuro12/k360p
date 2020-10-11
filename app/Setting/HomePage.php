<?php

namespace App\Setting;

class HomePage
{

    const menutype = ['Brand', 'Category', 'Collection', 'Sale'];
    //
    const collectionurl = "/collection-product//";
    const producturl = "/product/";
    const saleurl = "/sale-product/";
    const brandurl = "/shop-by-brand/";
    const categoryurl = "/shop-by-category/";


    const sectiontype = [
        'Section Wrapper',
        'Slider',
        'Advertisment',
        'Category',
        'MultiCategory'
    ];
    const themes = "molla";
    // const CSS=[
    //     "assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css"
    //     ,"assets/css/bootstrap.min.css"
    //     ,"assets/css/plugins/owl-carousel/owl.carousel.css"
    //     ,"assets/css/plugins/magnific-popup/magnific-popup.css"
    //     ,"assets/css/plugins/jquery.countdown.css"
    //     ,"assets/css/style.css"
    // ];
    // const JS=[
    //    "assets/js/jquery.min.js",
    //    "assets/js/bootstrap.bundle.min.js",
    //    "assets/js/jquery.hoverIntent.min.js",
    //    "assets/js/jquery.waypoints.min.js",
    //    "assets/js/superfish.min.js",
    //    "assets/js/owl.carousel.min.js",
    //    "assets/js/bootstrap-input-spinner.js",
    //    "assets/js/jquery.magnific-popup.min.js",
    //    "assets/js/jquery.plugin.min.js",
    //    "assets/js/jquery.countdown.min.js",
    //    "assets/js/main.js",
    // ];


    const CSS = [
        "assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css", "assets/css/bootstrap.min.css", "assets/css/plugins/owl-carousel/owl.carousel.css", "assets/css/plugins/magnific-popup/magnific-popup.css", "assets/css/plugins/jquery.countdown.css", "assets/css/style.css", "assets/css/skins/skin-demo-14.css", "assets/css/demos/demo-14.css"

    ];
    const JS = [
        "assets/js/jquery.min.js",
        "assets/js/bootstrap.bundle.min.js",
        "assets/js/jquery.hoverIntent.min.js",
        "assets/js/jquery.waypoints.min.js",
        "assets/js/superfish.min.js",
        "assets/js/owl.carousel.min.js",
        "assets/js/bootstrap-input-spinner.js",
        "assets/js/jquery.magnific-popup.min.js",
        "assets/js/jquery.plugin.min.js",
        "assets/js/jquery.countdown.min.js",
        "assets/js/wNumb.js",
        "assets/js/main.js",
        "assets/js/demos/demo-14.js",
        "assets/js/axios.js"
    ];
    public static function theme($page)
    {
        return "themes." . self::themes . "." . $page;
    }

    public static function renderCSS()
    {
        $css = "";
        foreach (self::CSS as $link) {
            $css .= '<link rel="stylesheet" href="\themes\\' . self::themes . '\\' . $link . '">';
        }
        return $css;
    }

    public static function renderJS()
    {
        $css = "";
        foreach (self::JS as $link) {
            $css .= '<script src="\themes\\' . self::themes . '\\' . $link . '"></script>';
        }
        return $css;
    }
}

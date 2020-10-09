// Demo 14 Js file
$(document).ready(function() {
    'use strict';
    $('.cat-owl').each(function () {
        var $this = $(this);
        var def={
            "nav": false, 
            "dots": true,
            "margin": 5,
            "loop": false,
            
            "responsive": {
                "0": {
                    "items":1               
                },
                "480": {
                    "items":1
                },
                "768": {
                    "items":2
                },
                "992": {
                    "items":3
                },
                "1200": {
                    "items":4
                },
                "1600": {
                    "items":5
                }
            }
        };
        console.log(this);
        var data=undefined;
        data=$this.data('owl');
        if(data==undefined){
            
            $this.owlCarousel(def).trigger('refresh.owl.carousel');
        }else{
            console.log('data',data);
            var newOwlSettings = $.extend({}, def, data);
            console.log("new setting", newOwlSettings);
            $this.owlCarousel(newOwlSettings).trigger('refresh.owl.carousel');
        }
        console.log($this);
        
    });   
});
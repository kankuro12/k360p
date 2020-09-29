// Demo 14 Js file
$(document).ready(function() {
    'use strict';
    $('.cat-owl').each(function () {
        var $this = $(this);
        $this.owlCarousel({
            "nav": true, 
            "dots": true,
            "margin": 20,
            "loop": true,
            "responsive": {
                "0": {
                    "items":1.5
                },
                "480": {
                    "items":1.5
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
        });
        
    });   
});
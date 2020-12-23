<style>
    .megamenu {
        box-shadow: 1px 0px 20px 20px rgb(0 0 0 / 19%), -5px 10px 16px rgba(51, 51, 51, 0.05) !important;
    }

    .header-14 .header-search .header-search-wrapper {
        border-color: {{env('pop_color',"#FCB941")}};
    }
    .btn-primary:hover, .btn-primary:focus, .btn-primary.focus, .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, .show>.btn-primary.dropdown-toggle {

        background-color: {{env('pop_color',"#FCB941")}};
        border-color: {{env('pop_color',"#FCB941")}};

    }

    .header-14 .header-bottom .menu > li > a::before {
        background-color: {{env('primaryheader_hover_color',"#FCB941")}};
    }
    .header-bottom .menu>li>a:before {
    }

    .menu li:hover>a, .menu li.show>a, .menu li.active>a {
        color:{{env('primaryheader_hover_color',"#FCB941")}};
    }
    .btn-search{
        background-color: {{env('pop_color',"#FCB941")}};
        border-color: {{env('pop_color',"#FCB941")}};
    }

    .btn-search-outline{
        border-color: {{env('pop_color',"#FCB941")}};
        color:{{env('pop_color',"#FCB941")}} !important;
    }

    .btn-search-outline:hover{
        background-color: {{env('pop_color',"#FCB941")}};
        border-color: {{env('pop_color',"#FCB941")}};
        color:white !important;
    }


    .btn-icon:hover{
        color: {{env('pop_color',"#FCB941")}};

    }

    .header-14 .btn-icon-text {
        font-size: 1.1rem;
        font-weight: 300;
        letter-spacing: 0;
        color: #777;
        margin-top: 0.3rem;
        transition: all 0.3s;
    }

    .btn-icon:focus{
        color: {{env('pop_color',"#FCB941")}};

    }

    .wishlist-count{
        background: {{env('pop_color',"#FCB941")}} !important;
    }

    .cart-count{
        background: {{env('pop_color',"#FCB941")}} !important;
    }

    .cart-dropdown:hover .dropdown-toggle,
    .cart-dropdown.show .dropdown-toggle,
    .compare-dropdown:hover .dropdown-toggle,
    .compare-dropdown.show .dropdown-toggle {
        color:{{env('pop_color',"#FCB941")}} !important;
    }
    .page-title{
        color:{{env('page_title_color',"#333")}};
    }

    .page-header h1 span {
        color:{{env('page_subtitle_color'," #FCB941")}};
    }

    .side-link{
        color: {{env('side_color',"#ffffff")}}
    }
    .side-link:hover{
        color: {{env('side_color_hover',"#ffffff")}}
    }
    .side-link:focus{
        color: {{env('side_color_hover',"#ffffff")}}
    }

   .fsem, .footer-bottom{
       background:{{env('footerbg','#333')}};
       color:{{env('footercolor','#ffffff')}};
   }

   .widget-about-title{
        color:{{env('footercolor','#ffffff')}};

   }

   .min-about{
    color:{{env('footercolor','#ffffff')}};

   }

   .widget-title{
    color:{{env('footercolor','#ffffff')}} !important;

   }

   .footer-tel{
        color:{{env('footertelcolor','#ffffff')}} !important;

   }
   .owl-next span{
       font-size:40px;
   }

   .owl-prev span{
       font-size:40px;
   }

   .owl-full .owl-nav [class*="owl-"]:hover, .owl-full .owl-nav [class*="owl-"]:focus{
       background:rgba(0, 0, 0, 0.3);
   }


   @media (max-width:576px){
       div.product-body{
           padding-top:0px;
           padding-bottom:0px;
       }
       div.product-cat{
           margin-bottom:5px;
       }
       div.product-price{
           margin-bottom:5px;
       }

       .tab-content{
       word-break: break-all;
    }

    div.product.product-sm{
        align-items: center !important;
        float: left !important;
        width: calc(50% - 8px) !important;
        display:block !important;
        text-align: center !important;
    }

    div.product.product-sm:nth-child(odd){
        margin-right:15px !important;
    }


    .media-single{
        flex:none !important;
        max-width: initial !important;
    }

        .product-body-single{
            padding:0.25rem !important;
        }

        .product-price-single{
            text-align: center;
            font-size:1.2rem !important;
            display:block !important;

        }

   }
</style>

(function ($) {

    "use strict";



    /*---------------------------

       Commons Variables

    ------------------------------ */

    var $window = $(window),

        $body = $("body");



    /*window.addEventListener("resize", function() {

		"use strict"; window.location.reload(); 

    });*/



    /*-----  Hover Dropdown multi level Navigation Start -----*/

    if (window.innerWidth > 992) {

        document.querySelectorAll('.navbar .nav-item').forEach(function (everyitem) {

            everyitem.addEventListener('mouseover', function (e) {

                let el_link = this.querySelector('a[data-bs-toggle]');

                if (el_link != null) {

                    let nextEl = el_link.nextElementSibling;

                    el_link.classList.add('show');

                    nextEl.classList.add('show');

                    nextEl.setAttribute("data-bs-popper", "static");

                }

            });

            everyitem.addEventListener('mouseleave', function (e) {

                let el_link = this.querySelector('a[data-bs-toggle]');

                if (el_link != null) {

                    let nextEl = el_link.nextElementSibling;

                    el_link.classList.remove('show');

                    nextEl.classList.remove('show');

                    nextEl.removeAttribute("data-bs-popper");

                }

            })

        });

    }

    // make it as accordion for smaller screens

    document.addEventListener("DOMContentLoaded", function(){

    	/////// Prevent closing from click inside dropdown

		document.querySelectorAll('.dropdown-menu').forEach(function(element){

			element.addEventListener('click', function (e) {

			  e.stopPropagation();

			});

		})

		// make it as accordion for smaller screens

		if (window.innerWidth < 992) {

			// close all inner dropdowns when parent is closed

			document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){

				everydropdown.addEventListener('hidden.bs.dropdown', function () {

					// after dropdown is hidden, then find all submenus

					  this.querySelectorAll('.submenu').forEach(function(everysubmenu){

					  	// hide every submenu as well

					  	everysubmenu.style.display = 'none';

					  });

				})

			});

			document.querySelectorAll('.dropdown-menu a').forEach(function(element){

				element.addEventListener('click', function (e) {

		

				  	let nextEl = this.nextElementSibling;

				  	if(nextEl && nextEl.classList.contains('submenu')) {	

				  		// prevent opening link if link needs to open dropdown

				  		e.preventDefault();

				  		console.log(nextEl);

				  		if(nextEl.style.display == 'block'){

				  			nextEl.style.display = 'none';

				  		} else {

				  			nextEl.style.display = 'block';

				  		}

				  	}

				});

			})

		}

		// end if innerWidth

	}); 

	// DOMContentLoaded  end

    /*-----  Hover Dropdown multi level Navigation End  -----*/



    /*-----  enable Tooltip start -----*/

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))

    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {

        return new bootstrap.Tooltip(tooltipTriggerEl)

    })

    /*-----  enable Tooltip end -----*/



    if (window.innerWidth > 767) {

        var headerHeight = $('header').height();

        $(".page_sidebar").height('calc(100% - '+headerHeight+'px)');

    }

    

/*-----  Add item to Cart start -----*/

$('body').on('click', '.cat_product_btn_add', function(){



    /*----- update cart count value -----*/

    var cart = $(".btn_cart_compare");

    var cartCount = $(".btn_cart_compare span");

    // cartCount.html(parseInt(cartCount.html(), 10)+1);



    /*----- get product image -----*/

    var imgtodrag = $(this).parents(".block_type_product").find(".image_wrapper img").eq(0);

    var product_id = $(this).attr("data-id");

    $.ajax({

        type:'GET',

        url: '/add-to-cart/'+$(this).attr("data-id"),
        beforeSend: function(){
            $('.ajax-loader').css("visibility", "visible");
        },
        success:function(result){

            cartCount.html(result);

        },
        complete: function(){
          $('.ajax-loader').css("visibility", "hidden");
          
          
        },
         error:function(result){

            

        }

    });


    // $.ajax({

    //     type:'GET',

    //     url: '/get-cart-count',

    //     success:function(result){

    //         cartCount.html(result);

    //     },

    //     error:function(result){

            

    //     }

    // });

    /*----- product image fly to cart animation -----*/

    if (imgtodrag) {

        var imgclone = imgtodrag

        .clone()

        .offset({

            top: imgtodrag.offset().top,

            left: imgtodrag.offset().left

        })

        .css({

            opacity: "0.5",

            position: "absolute",

            height: "150px",

            width: "150px",

            "z-index": "100"

        })

        .appendTo($("body"))

        .animate(

            {

                top: cart.offset().top + 10,

                left: cart.offset().left + 10,

                width: 75,

                height: 75

            },

            1000

        );

        imgclone.animate(

            {

                width: 0,

                height: 0

            },

            function() {

                $(this).detach();

            }

        );

    }



});

/*-----  Add item to Cart End -----*/

}(jQuery));


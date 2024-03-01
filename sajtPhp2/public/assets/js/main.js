(function ($) {
    "use strict";

    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:4
            },
            992:{
                items:5
            },
            1200:{
                items:6
            }
        }
    });


    // Related carousel
    $('.related-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            }
        }
    });


    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });

})(jQuery);


$(document).ready(function(){
        $('.collapse').on('shown.bs.collapse', function(){
            $(this).prev().find('.fa-chevron-down').removeClass('fa-chevron-down').addClass('fa-chevron-up');
        }).on('hidden.bs.collapse', function(){
            $(this).prev().find('.fa-chevron-up').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        });
                $('.collapse.show').prev().find('.fa-chevron-down').removeClass('fa-chevron-down').addClass('fa-chevron-up');

    });





//my js

$(document).ready(function(){


    if(localStorage.getItem('cart') == null){
        localStorage.setItem('cart', '[]');
    }

    //add to cart
    setTimeout(function(){
    var dugmici = document.getElementsByClassName('addCart');

    for (var i = 0; i < dugmici.length; i++) {
    dugmici[i].addEventListener('click', function(){
    var id = this.getAttribute('data-ProductId');
    console.log(id);
    var quantity=1;

    var elementQuantity=this.parentElement.querySelector('.brojEl');
    if(elementQuantity){
        quantity=elementQuantity.value;
    }
    var cart = JSON.parse(localStorage.getItem('cart'));

    if(cart.length==0){
        cart.push({id:id, quantity:quantity});
    }
    else{
        var found=false;
        for(var i=0; i<cart.length; i++){
            if(cart[i].id==id){
                cart[i].quantity=parseInt(cart[i].quantity)+parseInt(quantity);
                found=true;
                break;
            }
        }
        if(!found){
            cart.push({id:id, quantity:quantity});
        }
    }
    localStorage.setItem('cart', JSON.stringify(cart));





    });
    }

    }, 1000);





});


//cart
$(document).ready(function(){
    var cart = JSON.parse(localStorage.getItem('cart'));
    var element = document.getElementById('korpa');
    var divEl=document.getElementById('TotalOrder');
    $.ajax({
        url: '/api/products',
        method: 'GET',
        success: function(response){
            console.log(response);
            var products = response;
            var total=0;
            var html='';
            var checkout='';

            for(var i=0; i<cart.length; i++){
                for(var j=0; j<products.length; j++){
                    if(cart[i].id==products[j].model_specification_id){
                        var product = products[j];
                        html+='<tr>';
                        html+='<td><img src="'+product.picture+'" alt="Image" class="img-fluid" style="width: 50px;"></td>';
                        html+='<td>'+product.name+'</td>';
                        html+='<td>'+product.price+'</td>';
                        html+='<td>'+cart[i].quantity+'</td>';
                        html+='<td>'+product.price*cart[i].quantity+'</td>';
                        html+='<td><button class="btn btn-primary remove" data-ProductId="'+product.model_specification_id+'">Remove</button></td>';
                        html+='</tr>';
                        total+=product.price*cart[i].quantity;

                    }
                }
            }
            html+='<tr>';
            html+='<td colspan="4">Total</td>';
            html+='<td>'+total+'</td>';
            html+='<td></td>';
            html+='</tr>';


            html+='</tbody></table>';


            element.innerHTML = html;

        }
    });
    var divTotalOrder=document.getElementById('TotalOrder');
    var totalPrice=0;

    $.ajax({
            url: '/api/products',
            method: 'GET',
            success: function(response){

                for(var i=0; i<cart.length; i++){
                    for(var j=0; j<response.length; j++){
                        if(cart[i].id==response[j].model_specification_id){
                            var product = response[j];
                            totalPrice+=product.price*cart[i].quantity;

                            divTotalOrder.innerHTML+=`<div class="d-flex justify-content-between">
                                                                                  <p>${product.name}</p>
                                                                                  <p>${product.price}</p>
                                                                              </div>`;
                        }
                    }

                }
                document.getElementById('subtot').innerHTML=`${totalPrice}</h4>`;


            }
        });

    setTimeout(function(){
        var dugmici = document.getElementsByClassName('remove');
        for (var i = 0; i < dugmici.length; i++) {
            dugmici[i].addEventListener('click', function(){
                var id = this.getAttribute('data-ProductId');
                var cart = JSON.parse(localStorage.getItem('cart'));
                for(var i=0; i<cart.length; i++){
                    if(cart[i].id==id){
                        cart.splice(i, 1);
                        break;
                    }
                }
                localStorage.setItem('cart', JSON.stringify(cart));
                location.reload();
            });
        }
    }, 300);

    var brojElemenataUKorpi=JSON.parse(localStorage.getItem('cart')).length;

    var divCount = document.getElementById('korpaCount');
    divCount.innerHTML = brojElemenataUKorpi;



});

//checkout
$(document).ready(function(){
    var select = document.getElementById('Placanje');
    select.addEventListener('change', function(){
    if(select.value==1){
            $.ajax({
                url: '/api/usercard',
                method: 'GET',
                success: function(response){
                if(response.length!=0){
                var div=document.getElementById('cards');

                var hrml=`<div class="d-flex justify-content-between mb-2"><select class="custom-select col-7" id="IzborKartice">
                                                          <option selected value=0>Choose...</option>`;

                for(var i=0; i<response.length; i++){
                    hrml+=`<option value="${response[i].id}">${response[i].card_name}</option>`;
                }
                hrml+=`</select>
                    <a href="/profile#profilecard" class="btn btn-primary col-2 p-1">Add card</a>
                    <a href="/profile#profilecard" class="btn btn-primary col-2 p-1">Change card info</a>
                    </div>
                `;


                div.innerHTML=hrml;
                var selectedCard = document.getElementById('IzborKartice');
                selectedCard.addEventListener('change', function(){
                    var cardName = selectedCard.value;
                    var cardDetails = document.getElementById('cardDetails');
                    for(var i=0; i<response.length; i++){
                        if(response[i].id==cardName){
                            cardDetails.innerHTML=`<h5 class="mt-3">Card details</h5>`;
                            cardDetails.innerHTML+=`
                                                   <div class="form-group" >
                                                        <label>Card Number</label>
                                                        <input class="form-control" type="text" placeholder="1234 5678 9101 1121" disabled name="cardnumber" value=${response[i].card_number}>
                                                    </div>
                                                    <div class="form-group" >
                                                        <label>Expiration Date</label>
                                                        <input class="form-control" type="text" placeholder="MM/YY" disabled name="expirationdate" value=${response[i].expiration_date}>
                                                    </div>

                                                    <div class="form-group" >
                                                        <label>CVV</label>
                                                        <input class="form-control" type="text" placeholder="123" disabled name="cvv" value=${response[i].cvv}>
                                                    </div>
                                                    </form>
                                                    `;

                        }
                    }
                });
                }
                else {
                    var div=document.getElementById('cards');
                    div.innerHTML=`<a href="/profile#profilecard" class="btn btn-primary mb-2">Add card</a>`;
                    }




                }
            });
        }
    else{
        document.getElementById('cardDetails').innerHTML='';
        var div=document.getElementById('cards');
                            div.innerHTML=``;
    }

    });






    var dugmeZaNarucivanje = document.getElementById('dugmeUpis');
    dugmeZaNarucivanje.addEventListener('click', function(){
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        console.log(csrfToken);

        var select = document.getElementById('Placanje');
        var placanje = select.value;
        var cart = JSON.parse(localStorage.getItem('cart'));
        if(cart.length==0){
            alert('Cart is empty');
            return;
        }
        else{
        if(placanje==1){
            var card = document.getElementById('IzborKartice').value;
            if(card==0){
                alert('Choose card');
                return;
            }
            else{
                 console.log(card);
                 console.log(cart);
                $.ajax({
                    url: '/products/order',
                    method: 'post',
                    headers: {
                            'X-CSRF-TOKEN': csrfToken,
                    },
                    data: {
                        card: card,
                        cart: cart
                    },
                    success: function(response){
                        localStorage.setItem('cart', '[]');
                        document.getElementById('mojModal').style.display='block';
                        setTimeout(function(){
                            document.getElementById('mojModal').style.display='none';
                            location.href='/';
                        }, 3000);


                    }
                });

            }
            }
            else if(placanje==2){
                $.ajax({
                    url: '/products/order',
                    method: 'post',
                    headers: {
                            'X-CSRF-TOKEN': csrfToken,
                    },
                    data: {
                        cart: cart,
                        card : 0
                    },
                    success: function(response){
                        localStorage.setItem('cart', '[]');
                        document.getElementById('mojModal').style.display='block';
                        setTimeout(function(){
                            document.getElementById('mojModal').style.display='none';
                            location.href='/';
                        }, 3000);


                    }
                });
            }
            else{
                alert('Choose payment method');
            }
        }





    });
});

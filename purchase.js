if(document.readyState == 'loading'){
    document.addEventListener('DOMContentLoaded',ready);
}
else{
    ready();
}

function ready(){
    var removeCartBtn = document.getElementsByClassName('rmv-button');
    for(var i=0; i<removeCartBtn.length; i++){
        var button = removeCartBtn[i];
        button.addEventListener('click',removeCartItem);
    }

    var quantityInput = document.getElementsByClassName('cart-quantity-input');
    for(var i=0; i<quantityInput.length; i++){
        var input = quantityInput[i];
        input.addEventListener('change',changeQuantity);
    }

    var addCartBtn = document.getElementsByClassName('cart-add-btn');
    for(var i=0; i<addCartBtn.length; i++){
        var btn = addCartBtn[i];
        btn.addEventListener('click',addToCartClicked);
    }

    document.getElementsByClassName('purchase-btn')[0].addEventListener('click',purchaseClicked);
}

function purchaseClicked(){
    alert('Successfully checked out. Thank you!');
    var cartItems = document.getElementsByClassName('cart-items')[0];
    while(cart-cartItems.hasChildNodes()){
        cartItems.removeChild(cartItems.firstChild);
    }
    updateCartTotal();
}

function removeCartItem(event){
    var buttonClicked = event.target;
    //remove the item entry
    buttonClicked.parentElement.parentElement.remove();
    updateCartTotal();
}

function updateCartTotal(){
    var cartItemConatiner = document.getElementsByClassName('cart-items')[0];
    var cartRows = cartItemConatiner.getElementsByClassName('cart-row');
    var total = 0;
    for(var i=0; i<cartRows.length; i++){
        var cartRow = cartRows[i];
        var priceElement = cartRow.getElementsByClassName('cart-price')[0];
        var quantityElement = cartRow.getElementsByClassName("cart-quantity-input")[0];
        //remove dollar sign so math can be done with this number
        var price = parseFloat(priceElement.innerText.replace('$',''));
        var quantity = quantityElement.value;
        total += price*quantity;
    }
    total = Math.round(total*100)*.01;
    document.getElementsByClassName('cart-total-price')[0].innerText = '$' + total;
}

function changeQuantity(event){
    var input = event.target;
    if(isNaN(input.value) || input.value <= 0){
        input.value = 1;
    }
    updateCartTotal();
}

function addToCartClicked(event){
    var button = event.target;
    var shopItem = button.parentElement;
    var title = shopItem.getElementsByClassName('shop-item-title')[0].innerText;
    var price = shopItem.getElementsByClassName('shop-item-price')[0].innerText;
    addToCart(title,price);
    updateCartTotal();
}

function addToCart(title,price){
    var cartRow = document.createElement('div');
    cartRow.classList.add('cart-row');
    var cartItems = document.getElementsByClassName('cart-items')[0];
    var cartItemsNames = document.getElementsByClassName("cart-item-title");
    for(var i=0; i<cartItemsNames.length; i++){
        if(cartItemsNames[i].innerText == title){
            alert('This item is already in your cart');
            return;
        }
    }
    var newCartRow = `
    <div class="cart-item cart-column">
        <span class="cart-item-name">${title}</span>
    </div>
    <span class="cart-price cart-column">${price}</span>
    <div class="cart-column">
        <input class="cart-quantity-input" type="number" value="1">
        <button class="rmv-button" type="button">Remove item</button>
    </div>`
    cartRow.innerHTML = newCartRow;
    cartItems.append(cartRow);
    cartRow.getElementsByClassName('rmv-button')[0].addEventListener('click',removeCartItem);
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change',changeQuantity);
}

//disable all buttons until page is loaded
if(document.readyState == 'loading'){
    document.addEventListener('DOMContentLoaded',ready);
}
else{
    ready();
}

//only when the page is loaded users can touch buttons
function ready(){
    //button to remove items from cart
    var removeCartBtn = document.getElementsByClassName('rmv-button');
    for(var i=0; i<removeCartBtn.length; i++){
        var button = removeCartBtn[i];
        button.addEventListener('click',removeCartItem);
    }

    //quantity field for cart items
    var quantityInput = document.getElementsByClassName('cart-quantity-input');
    for(var i=0; i<quantityInput.length; i++){
        var input = quantityInput[i];
        input.addEventListener('change',changeQuantity);
    }

    //buttons on shop items for adding to cart
    var addCartBtn = document.getElementsByClassName('cart-add-btn');
    for(var i=0; i<addCartBtn.length; i++){
        var btn = addCartBtn[i];
        btn.addEventListener('click',addToCartClicked);
    }

    document.getElementsByClassName('purchase-btn')[0].addEventListener('click',purchaseClicked);
}

//purchase button stuff
function purchaseClicked(){
    alert('Successfully checked out. Thank you!');
    var cartItems = document.getElementsByClassName('cart-items')[0];
    //delete all items upon purchase (clear cart)
    while(cart-cartItems.hasChildNodes()){
        cartItems.removeChild(cartItems.firstChild);
    }
    updateCartTotal();
}

//remove button
function removeCartItem(event){
    var buttonClicked = event.target;
    //remove the item entry
    buttonClicked.parentElement.parentElement.remove();
    updateCartTotal();
}

//change the total displayed at the bottom
function updateCartTotal(){
    var cartItemConatiner = document.getElementsByClassName('cart-items')[0];
    var cartRows = cartItemConatiner.getElementsByClassName('cart-row');
    var total = 0;
    //get numbers from each item
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

//quantity field functionality
function changeQuantity(event){
    var input = event.target;
    //default to 1 if user inputs 0 or less (should use remove button, not 0 quantity)
    if(isNaN(input.value) || input.value <= 0){
        input.value = 1;
    }
    updateCartTotal();
}

//"add" button functionality
function addToCartClicked(event){
    var button = event.target;
    var shopItem = button.parentElement;
    var title = shopItem.getElementsByClassName('shop-item-title')[0].innerText;
    var price = shopItem.getElementsByClassName('shop-item-price')[0].innerText;
    addToCart(title,price);
    updateCartTotal();
}

//add items to cart
function addToCart(title,price){
    var cartRow = document.createElement('div');
    cartRow.classList.add('cart-row');
    var cartItems = document.getElementsByClassName('cart-items')[0];
    var cartItemsNames = document.getElementsByClassName("cart-item-title");
    //if new item is added, create html entry
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

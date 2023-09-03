
let cart = [];
let buttonsDOM = [];
let couponbtnsDom=[];
let wishbuttonsDOM = [];
let color;
const cart_totl = document.querySelector(".count");
const cart_price = document.querySelector("#cartSubtotal");
const inner_cart_price = document.querySelector("#innercartSubtotal");
const cartContent = document.querySelector('.cart-content');
const clearCartbtn = document.getElementById("clear-cart");

const main_cart=document.querySelector("#table-body");

const color_selector=document.getElementById("color")
const wishlistDom=document.querySelector(".wishlist");



class Product {

  //----->(1)
  async getProducts() {
    try {
      let result = await fetch('/product/details');
      let data = await result.json();
   
      let products = data.items;
      let wishlists = data.wishlists;
    console.log("the products is",products);
      console.log(data);
      return products;
     
     
    } catch (error) {
      console.log(error);
    }

    

  }


  }

  
class UI {

    //3------------------------------------>
  getBagBtns(products) {
   //(3(i))-------------------> starts here//
    const buttons = [...document.querySelectorAll("#add_to_cart")];
    buttonsDOM = buttons;

 
    buttons.forEach(button => {

     
      let id = parseInt(button.dataset.id);
      let inCart = cart.find(item => item.id === id);
      if (inCart) {
        button.disabled = true;
        button.innerHTML = `IN CART`;
      }
     //(3(i)) ends here//

//(3(ii))----------------->starts here//
      let product = products.find(item => item.id === id);// finding the perticular product with the id


      if (product && product.status === 0) {
        button.disabled = true;
    } // if product status is "0" then disable add to cart btn

      button.addEventListener("click", (e) => {
       // const selectedColor = color_selector.value.trim();
       const selectedColor = color_selector.value.trim();

       if (selectedColor === '--Choose Color--') {
         toastr.warning('Please select a color');
         return; // Return early without adding the item to the cart
       }

      else{

      
        button.disabled = true;
        e.target.innerHTML = `IN CART`
        e.preventDefault();
      
      

      //  color=this.getColor();

      //(3(ii))---------> ends here
        let cartItem = { ...Storage.getCartProducts(id), amount: 1,color };
        
        cart = [...cart, cartItem];
        Storage.saveCart(cart);
        this.setValues(cart);
        this.addCartitem(cartItem);
        
        toastr.success('Item added to the cart');

      }
      });
    });
  }




  setValues(cart) {
    let tempTotal = 0;
    let itemsTotal = 0;

    cart.forEach(item => {
      itemsTotal += item.amount;
      if (item.discount_price === null) {
        item.price = item.selling_price;
      } else {
        item.price = item.discount_price;
      }
      tempTotal += item.price * item.amount;
    });

    cart_totl.innerText = itemsTotal;
    cart_price.innerText = tempTotal;
    inner_cart_price.innerHTML = tempTotal;
    console.log("total price is", tempTotal);
  }

  addCartitem(item) {
   //console.log("the arrray is",item);
    let price;
    const div = document.createElement("div");
    div.classList.add("miniCart");
    if (item.discount_price === null) {
      price = item.selling_price;
    } else {
      price = item.discount_price;
    }
    div.innerHTML = `
      <div class="cart-item product-summary">
        <div class="row">
          <div class="col-xs-4">
            <div class="image">
            <a href="">
            <img src="/${item.product_thambnail}" alt="">
          </a>
            </div>
          </div>
          <div class="col-xs-7">
            <h3 class="name">
              <a href="index.php?page-detail">${item.product_name}</a>
            </h3>
            <div class="price"><span>RS.</span>${price}</div>
            <a href="#"><i class="fa fa-trash" data-id=${item.id}></i></a>
          </div>
          <div class="col-xs-1 action">
            <i class="fa fa-chevron-up" data-id=${item.id}></i>
            <p class="item-amount">${item.amount}</p>
            <i class="fa fa-chevron-down" data-id=${item.id}></i>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <hr>`;

    cartContent.appendChild(div);

  }

  setupApp() {
    cart = Storage.getCart();
    this.populateCart(cart);
    this.setValues(cart);
  
  }

  populateCart(cart) {
    cart.forEach(item => this.addCartitem(item));
  }

  cartLogic() {
    clearCartbtn.addEventListener("click", (e) => {
      e.preventDefault();
      this.clearCart();
     
     
    });

    cartContent.addEventListener("click",(e)=>{

      e.preventDefault();
    if(e.target.classList.contains("fa-trash")){
      
      e.preventDefault();
      let removeItem=e.target;
      let id=parseInt(removeItem.dataset.id);

      const removedItemId = parseInt(e.target.dataset.id);
      document.dispatchEvent(new CustomEvent('cartItemRemoved', { detail: removedItemId }));

      this.removeItems(id);
     // cartContent.removeChild(removeItem.parentElement.parentElement.parentElement.parentElement);
     cartContent.removeChild(removeItem.closest(".cart-item").parentElement);
     
    
     toastr.warning('Item is removed from cart');
    }
    else if(e.target.classList.contains("fa-chevron-up")){
  //e.preventDefault();
      let addAmont=e.target;
      let id=parseInt(addAmont.dataset.id);
      let tempItem=cart.find(item=>item.id === id);
  tempItem.amount=tempItem.amount+1;

  Storage.saveCart(cart);
  this.setValues(cart);
  addAmont.nextElementSibling.innerText=tempItem.amount;
  //e.preventDefault();
    }

    else if (e.target.classList.contains("fa-chevron-down")) {
      let lowerAmount = e.target;
      let id = parseInt(lowerAmount.dataset.id);
      let tempItem = cart.find(item => item.id === id);
    
      tempItem.amount = tempItem.amount - 1;
    
      if (tempItem.amount > 0) {
        Storage.saveCart(cart);
        this.setValues(cart);
        lowerAmount.previousElementSibling.innerText = tempItem.amount;
      } else {
        
        const removedItemId = parseInt(e.target.dataset.id);
      document.dispatchEvent(new CustomEvent('cartItemRemoved', { detail: removedItemId }));

        cartContent.removeChild(lowerAmount.closest(".cart-item").parentElement);
        toastr.warning('Item is removed from cart');
        this.removeItems(id)

      }
    }
    
    })
  }

  clearCart(){
    cart=[];
   // let cartItems=cart.map(item=>item.id);
   // cartItems.forEach(id=>this.removeItem(id))

   this.setValues(cart);
   Storage.saveCart(cart);
    
  while(cartContent.children.length >0){
    cartContent.removeChild(cartContent.children[0]);
  }

  buttonsDOM.forEach((button) => {
    button.disabled = false;
    button.innerHTML = `<i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART`;
   
    
  });
  main_cart.innerHTML="";
  toastr.warning('Cart cleared !');


  }
 
  removeItems(id) {
    cart = cart.filter(item => item.id !== id);
   
    this.setValues(cart);
    Storage.saveCart(cart);
  
    let button = this.getSingleButton(id);
    
   
      button.disabled = false;
    
      button.innerHTML = `<i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART`;
     
    

    //console.log("the button is",button);
  
  }

  getSingleButton(id){
    
     return buttonsDOM.find(button => parseInt(button.dataset.id) === id);
   
  }

 
  viewMaincart() {
    console.log(cart);
    let div = "";
  

   
    cart.forEach(item => {
      let price;
  
      if (item.discount_price === null) {
        price = item.selling_price;
      } else {
        price = item.discount_price;
      }
  let id=parseInt(item.id)
  console.log("parsed id",id);
      div += `<tr data-id=${id}>
        <td class="romove-item"><a href="#"><i class="fa fa-trash" data-id=${item.id}></i></a></td>
        <td class="cart-image">
          <a class="entry-thumbnail" href="detail.html">
            <img src="/${item.product_thambnail}" alt="">
          </a>
        </td>
        <td class="cart-product-name-info">
          <h4 class='cart-product-description'><a href="detail.html">${item.product_name}</a></h4>
        </td>
        <td class="cart-product-edit">
          <select class="color-selector" id="color" data-id="${item.id}">
            ${item.product_color.split(',').map(color => `<option value="${color}" ${color === item.color ? 'selected' : ''}>${color}</option>`).join('')}
          </select>
        </td>
        <td class="cart-product-quantity">
          <div class="quant-input">
            <div class="arrows">
              <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"  data-id=${item.id}></i></span></div>
              <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"  data-id=${item.id}></i></span></div>
            </div>
            <input type="text" class="amount" value="1">
          </div>
        </td>
        <td class="cart-product-sub-total"><span class="cart-sub-total-price">${item.price}</span></td>
      </tr>`;
    });
  
    main_cart.innerHTML = div;
    document.addEventListener('cartItemRemoved', (e) => {
      const removedItemId = parseInt(e.detail);
      const cartItemRow = main_cart.querySelector(`tr[data-id="${removedItemId}"]`);
      if (cartItemRow) {
        cartItemRow.remove();
      }
    });
    
    main_cart.addEventListener("click", (e) => {
      if (e.target.classList.contains("fa-trash")) {
        e.preventDefault();
        let removeItem = e.target;
        let id = parseInt(removeItem.dataset.id);
        removeItem.closest("tr").remove();
        toastr.warning('Item is removed from cart');

        this.removeItems(id);
      
      }

      else if(e.target.classList.contains("fa-sort-asc")){
        e.preventDefault();
        let addAmont=e.target;
        let id=parseInt(addAmont.dataset.id);
        let tempItem=cart.find(item=>item.id === id);
        tempItem.amount=tempItem.amount+1;
      
    Storage.saveCart(cart);
    this.setValues(cart);
    document.querySelector('.amount').value=tempItem.amount;
    toastr.info('Cart updated!');

   console.log(tempItem.amount);
      }
     

      else if(e.target.classList.contains("fa-sort-desc")){
  e.preventDefault();
  let lowerAmount = e.target;
  let id = parseInt(lowerAmount.dataset.id);
  let tempItem = cart.find(item => item.id === id);

  tempItem.amount = tempItem.amount - 1;

  if (tempItem.amount > 0) {
    Storage.saveCart(cart);
    this.setValues(cart);
    document.querySelector('.amount').value=tempItem.amount;
  } else {
    
    
    lowerAmount.closest("tr").remove();
    toastr.warning('Item is removed from cart');
    this.removeItems(id)

  }

      }
    });


    main_cart.addEventListener("change", (e) => {

     
    
      if ( e.target.classList.contains("color-selector")) {
         let id=parseInt(e.target.dataset.id);
         console.log("id is",id)
          color = e.target.value;
     
       // console.log("Selected Color:", selectedcolor);
        // You can do something with the selected color here
        const cartItem = cart.find(item => item.id === id);
      if (cartItem) {
        cartItem.color = color;
        Storage.saveCart(cart); // Save the updated cart in local storage
      }
        
        console.log("updated cart is ",cart);
      }
    });
  
    const coupon_btns=[...document.querySelectorAll("#coupon")];
    couponbtnsDom=coupon_btns;

  
    
    coupon_btns.forEach((button)=>{
      button.addEventListener("click",this.applyCoupon)
      
    })
   
  }
  async  applyCoupon() {
    const coupon_name = document.getElementById("coupon_name"); // Replace with the actual coupon name from your form input
  
    console.log(coupon_name.value);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    try {
      const response = await fetch('/coupon/add', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        // Convert coupon to JSON and send it in the request body
        body: JSON.stringify({ coupon_name: coupon_name.value })
      });
  
      if (response.status === 200) {
        const data = await response.json();
        console.log(data);
        coupon_name.disabled=true;
        if (data.success) {
          console.log(data.success);
          toastr.success(data.success);

        } else if (data.error) {
          console.log(data.error);
          toastr.error(data.error);
        }
      }
    } catch (error) {
      // Handle any errors that occurred during the fetch request
      console.error(error);
    }

    let element="";

    element = `<div class="cart-sub-total">
    Subtotal<span class="inner-left-md">$600.00</span>
  </div>
  <div class="cart-grand-total">
    Grand Total<span class="inner-left-md">$600.00</span>
  </div>`
  }
  

  
  

  getColor() {
    return color_selector.value;
  }

 

}

class Storage {

  //---------->(2)
  static saveProducts(products) {
    localStorage.setItem("products", JSON.stringify(products));
  }

   //----------end of (2)

  static getCartProducts(index) {
    let products = JSON.parse(localStorage.getItem("products"));
    return products.find(product => product.id === index);
  }

  static saveCart(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
  }

  static getCart() {
    return localStorage.getItem("cart") ? JSON.parse(localStorage.getItem("cart")) : [];
  }
}

document.addEventListener("DOMContentLoaded", () => {

  const ui = new UI();
  const products = new Product();

  products.getProducts().then(products => {
    

    Storage.saveProducts(products);
    ui.setupApp();
   
   
  }).then((products) => {
  
    ui.getBagBtns(products);
    ui.cartLogic();
   
    ui.viewMaincart()
   
  
  
  })

  
 
});








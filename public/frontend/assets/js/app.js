
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

const check_out_btn=document.getElementById("checkout_cart");

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
      return {products,wishlists};
     
     
    } catch (error) {
      console.log(error);
    }

    

  }


  }

  
class UI {

  //(3)------------------------------------------->

  getBagBtns(products) {
   
   
    const buttons = [...document.querySelectorAll("#add_to_cart")];
    buttonsDOM = buttons;

 
    buttons.forEach(button => {

     
      let id = parseInt(button.dataset.id);
      let inCart = cart.find(item => item.id === id);
      if (inCart) {
        button.disabled = true;
        button.innerHTML = `IN CART`;
      }
     
      let product = products.find(item => item.id === id);

      if (product && product.status === 0) {
        button.disabled = true;
    }
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
      //------------------->end of (3) 
      

        color=this.getColor();

        //---------------------->start of (4)
        let cartItem = { ...Storage.getCartProducts(id), amount: 1,color };
        //------------->end of (4)

        //---------------->(5)
        cart = [...cart, cartItem];

        //------->end of (5)

        //------------.start of (7)
        Storage.saveCart(cart);

        //--------------->end of (7)


        //---------------->start of (9)
        this.setValues(cart);

        //---------------->end  of (9)

//--------------------------start of (11)
        this.addCartitem(cartItem);
        
        toastr.success('Item added to the cart');
//--------------------------->end of (11)
      }
      });
    });
  }



//--------------->start of (8)
  setValues(cart) {
    let tempTotal = 0;
    let itemsTotal = 0;

    cart.map(item => {
      itemsTotal += item.amount;
      if (item.discount_price === null) {
        item.price = item.selling_price;
      } else {
        item.price = item.discount_price;
      }
      tempTotal += item.price * item.amount;
    });

    cart_totl.innerText = itemsTotal;
    cart_price.innerText = parseFloat(tempTotal.toFixed(2));
    inner_cart_price.innerHTML = tempTotal;
    console.log("total price is", tempTotal);
  }


  //----------->end of 8

  //--------->start of (10)
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

  //------------>end of (10)

  //----------.start of (14)
  setupApp() {
    cart = Storage.getCart();
    this.populateCart(cart);
    this.setValues(cart);
  
  }
//end of (14)


//------------>start of (13)
  populateCart(cart) {
    cart.forEach(item => this.addCartitem(item));
  }

  //end of 13


  //----------------->start of (15)
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
  //end of (15)

  //start of (16)
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

  //end of (16)
 
  //start of (17)
  removeItems(id) {
    cart = cart.filter(item => item.id !== id);
   
    this.setValues(cart);
    Storage.saveCart(cart);
  
    let button = this.getSingleButton(id);
    
   
      button.disabled = false;
    
      button.innerHTML = `<i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART`;
     
    

    //console.log("the button is",button);
  
  }
//-------->end of (17)

//--------->start of (18)
  getSingleButton(id){
    
     return buttonsDOM.find(button => parseInt(button.dataset.id) === id);
   
  }
//end of (18)
 
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
            <input type="text" class="amount" value="${item.amount}">
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
   // document.querySelector('.amount').value=tempItem.amount;

   let amountInput = addAmont.closest("tr").querySelector('.amount');
   if (amountInput) {
     amountInput.value = tempItem.amount;
   }
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
   // document.querySelector('.amount').value=tempItem.amount;
   let amountInput = lowerAmount.closest("tr").querySelector('.amount');
   if (amountInput) {
     amountInput.value = tempItem.amount;
   }
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


    check_out_btn.addEventListener("click",(e)=>{
     
    e.preventDefault();

      this.checkOut();


    })


   

    
  
   
   
  }


  async checkOut(){
  
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let final_cart=Storage.getCheckoutcart();
    console.log("the final cart is",final_cart);
    try {
      const response = await fetch('/check_out', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        // Convert coupon to JSON and send it in the request body
        body: JSON.stringify(final_cart)
      });
  
      if (response.status === 200) {
        const data = await response.json();
        console.log(data);
        if (data.success) {
          console.log(data.success);

          //toastr.success(data.success);
          this.clearCart();
         
          window.location.href = '/products/checkout';
        
        } else if (data.error) {
          console.log(data.error);
          toastr.error(data.error);
          window.location.href = data.redirect;
        }
      }
    } catch (error) {
      // Handle any errors that occurred during the fetch request
      console.error(error);
    }

   
  

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

  //--------------------- start of (6)
  static saveCart(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
  }


  //end of (6)


  //------------>start of (12)
  static getCart() {
    return localStorage.getItem("cart") ? JSON.parse(localStorage.getItem("cart")) : [];
  }

  //end of 12

  static getCheckoutcart(){
    return JSON.parse(localStorage.getItem("cart"));
  }
}

document.addEventListener("DOMContentLoaded", () => {

  const ui = new UI();
  const products = new Product();

  products.getProducts().then(({products,wishlists}) => {
    //ui.displayWishlist(products)

    Storage.saveProducts(products);
    ui.setupApp();
   
   return products;
  }).then((products) => {
  
    ui.getBagBtns(products);
    ui.cartLogic();
   
    ui.viewMaincart()
   
  
  
  })

  
 
});

document.addEventListener("DOMContentLoaded", async function() {
    console.log("cart.js loaded");

    document.addEventListener("click", async function(e) {
        if (e.target.matches('img.reload')) {
            let payload =  e.target.id.split("-");
            let id = payload[0];
            let quantity = document.getElementById(`${id}-quantity`).value
            await updateCartQuantity(id, quantity);
        }

        if (e.target.matches('img.remove')) {
            let payload =  e.target.id.split("-");
            let id = payload[0];
            await removeCartItem(id);

        }

        if (e.target.matches('button.checkout')){
            e.preventDefault();
            if (document.getElementById("checkout").reportValidity()){
                await checkout();
            }
        }
    });

});

async function updateCartQuantity(productId,quantity) {
    const request = await fetch(`http://127.0.0.1:8000/product/${productId}/addProductToCart?quantity=${quantity}`);
    if (request.ok) {
        setTimeout(() => {
            location.reload();
        }, 500);
    } else {
        console.log("Fallo modificando carrito");
    }
}


async function removeCartItem(productId){
    const request = await fetch(`http://127.0.0.1:8000/product/${productId}/removeProductCart`);
    if (request.ok){
        setTimeout(() => {
            location.reload();
        }, 500);
    }
    else {
        console.log("Fallo borrando elemento carrito");
    }
}

async function checkout(){

    let full_name = document.getElementById("fullName").value;
    let order_email = document.getElementById("email").value;
    let billing_address = document.getElementById("billingAddress").value;
    let shipping_address = document.getElementById("shippingAddress").value;
    let country = document.getElementById("country").value;
    let phone = document.getElementById("phone").value;
    let ammount = document.getElementById("totalPrice").innerText.replace('€','').trim();
    let csrf = document.getElementById("csrf").value;


    let payload ={
        full_name,
        order_email,
        billing_address,
        shipping_address,
        country,
        phone,
        ammount
    }
    const request = await fetch(`http://127.0.0.1:8000/order`,{
        method:"POST",
        headers:{
            "Content-type": "application/json",
            "X-CSRF-TOKEN": csrf
        },
        body: JSON.stringify(payload),

    });
    if (request.ok){
        let response = await request.text();
        console.log(response);
        setTimeout(() => {
            location.reload();
        },2000 );
    }
    else {
        let response = await request.json();
        console.log(response);
    }

}

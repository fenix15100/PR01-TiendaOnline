document.addEventListener("DOMContentLoaded", async function() {
    console.log("cart.js loaded");

    document.addEventListener("click", async function(e) {
        if (e.target.matches('img.reload')) {
            let payload =  e.target.id.split("-")
            let id = payload[0];
            let quantity = document.getElementById(`${id}-quantity`).value
            await updateCartQuantity(id, quantity)
        }

        if (e.target.matches('img.remove')) {
            let payload =  e.target.id.split("-")
            let id = payload[0];
            await removeCartItem(id)

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

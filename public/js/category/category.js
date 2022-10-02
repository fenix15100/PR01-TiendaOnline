console.log("category.js loaded");

document.addEventListener("DOMContentLoaded", async function() {
    const selectCategoryNode = document.getElementById("categorias")
    let category_id = selectCategoryNode.options[selectCategoryNode.selectedIndex].value;
    await loadProducts(category_id);

    selectCategoryNode.addEventListener("change",async (e)=>{
        await loadProducts(e.target.value);

    })


});

const loadProducts = async (category_id) =>{
    const request = await fetch(`http://127.0.0.1:8000/api/category/${category_id}/products`);
    if (request.ok){
        const productos = await request.text();
        const productosContainerNode = document.getElementById("data[products-container]");
        productosContainerNode.innerHTML = '';
        productosContainerNode.insertAdjacentHTML('afterbegin',productos)
    }
    else {
        console.log("No se ha padido cargar los productos");
    }

}



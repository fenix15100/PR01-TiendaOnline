console.log("admin.js loaded!!")
document.addEventListener("DOMContentLoaded", async function() {
    document.addEventListener("click", async function(event) {
        if (event.target.matches('button')){
            //Parseando ID y accion
            let payload =  event.target.id.split("-")
            let entity = payload[0];
            let id = null;
            if (entity === 'add'){
                id = 'new'
            }else{
                id = payload[1];
            }
            let action = payload[2]

            await dispathEntity(entity,action,id)

        }


    });

    const dispathEntity = async (entity,action,id=null)=>{
        switch (action){
            case 'delete':
                await deleteEntity(entity,id);
                break;
            case 'edit':
                await editEntity(entity,id);
                break;
            case 'add':
                let payload = {}
                await addEntity(entity,payload)
                break;
        }

    }
    const deleteEntity = async (entity,id)=>{
        console.log(`deleteEntity(${entity},${id})`)
        const request = await fetch(`http://127.0.0.1:8000/api/${entity}/${id}`,{
            method:"DELETE"
        });
        let response = null;
        if (request.ok){
            response = await request.json();
            const entityNode = document.getElementById(`data[${entity}-${id}-item]`);
            entityNode.remove();
        }
        else {
            response = await request.json();
            console.log(JSON.stringify(response));
        }
        await setFlashMessage(response);

    }

    const editEntity = async (entity,id)=>{
        console.log(`editEntity(${entity},${id})`)

    }

    const addEntity = async (entity,payload)=>{
        console.log(`addEntity(${entity},${payload})`)

    }

    const setFlashMessage = (response)=>{
        const alertNode = document.getElementById("flash")
        alertNode.innerHTML = '';
        alertNode.insertAdjacentHTML('afterbegin',JSON.stringify(response))
        alertNode.style.display="block";

        setTimeout(() => {
            alertNode.style.display="none";
            location.reload();
            }, 2000);
    }

});

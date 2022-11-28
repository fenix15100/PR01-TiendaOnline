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
        }

    }
    const deleteEntity = async (entity,id)=>{
        console.log(`deleteEntity(${entity},${id})`)
        const request = await fetch(`http://127.0.0.1:8000/api/${entity}/${id}`,{
            method:"DELETE"
        });
        if (request.ok){
            const response = await request.json();
            const entityNode = document.getElementById(`data[${entity}-${id}-item]`);
            entityNode.remove();
        }
        else {
            const response = await request.json();
            console.log(JSON.stringify(response));
        }

    }

    const editEntity = async (entity,id)=>{
        console.log(`editEntity(${entity},${id})`)

    }

    const addEntity = async (entity,payload)=>{
        console.log(`addEntity(${entity},${payload})`)

    }

});

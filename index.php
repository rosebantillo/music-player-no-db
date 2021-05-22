<html>
<head>
</head>
<body>
   <div class="container">
      <h1>Music List</h1>
      <div class="main">
        <div class="form">
            <input id="name" class="input-field" type="text" placeholder="New Music">
            <button id="new" style="width:80vh" class="btn btn-primary" onclick="insertMusic()">New Music</button>
        </div>

        <table class="table" id="data-table">
                <th>#</th>
                <th>Music</th>
                <th>Action</th>
        </table>
      </div>
   </div>
</body>


<script>
let counter = 1

async function  getData(){
    let data = {
        choice: 'index',
    }

    let response = await fetch('http://music.test/music.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json;charset=utf-8'
    },
    body: JSON.stringify(data)
    })

    let result = await response.json()
    console.log(result)

    result.map(d => {
        var node = document.createElement("tr");
        node.setAttribute("id",`row_${d.id}`)
        node.innerHTML  = `<tr>
                               <td class="nr">${counter}</td>
                                 <td style="text-align:center"><input class="nw" type="text"  value="${d.name}"/></td>
                                <td class="btn-display">
                                    <button  class="btn btn-primary" id="update" onclick="updateMusic(${d.id},${counter})">Update</button>
                                    <button  class="btn btn-danger" id="delete" onclick="deleteMusic(${d.id},${counter})">Delete</button>
                                 </td>
                              </tr>
                           `



        document.getElementById("data-table").appendChild(node);
        counter++;   
    })



}

async function updateData(id,value){
    let data = {
        choice: 'update',
        id: id,
        name: value
    }

    let response = await fetch('http://music.test/music.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json;charset=utf-8'
    },
    body: JSON.stringify(data)
    })

    let result = await response.json()

    alert('Successfully update music')

}

async function insertData(value){

    let data = {
        choice: 'store',
        name: value
    }

    let response = await fetch('http://music.test//music.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json;charset=utf-8'
    },
    body: JSON.stringify(data)
    })

    let result = await response.json()

    let d = result.data

    var node = document.createElement("tr");
        node.setAttribute("id",`row_${d.id}`)
        node.innerHTML  = `<tr>
                               <td class="nr">${counter}</td>
                                 <td style="text-align:center"><input class="nw" type="text"  value="${d.name}"/></td>
                                <td class="btn-display">
                                    <button  class="btn btn-primary" id="update" onclick="updateMusic(${d.id},${counter})">Update</button>
                                    <button  class="btn btn-danger" id="delete" onclick="deleteMusic(${d.id},${counter})">Delete</button>
                                 </td>
                              </tr>
                           `



        document.getElementById("data-table").appendChild(node);
        counter++;   

    alert('Successfully insert new music')
}

async function deleteData(id){

    let data = {
        choice: 'delete',
        id: id
    }

    let response = await fetch('http://music.test/music.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json;charset=utf-8'
    },
    body: JSON.stringify(data)
    })

    let result = await response.json()


}


getData()

function updateMusic(id,index){
    let value = document.getElementById("data-table").rows[index].cells[1].children[0].value

    updateData(id,value)
}

function insertMusic(){
    let value =  document.getElementById("name").value

    insertData(value)
}

function deleteMusic(id,index){
    document.getElementById(`row_${id}`).remove()

    deleteData(id)

}

</script>
</html>

<style>
@import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap');

body{
    font-family: 'Dancing Script', cursive;
    font-weight: 600;
    background-image: url('background.jpg');
    background-position: center;
    background-size: cover;
}
h1{
    color: white;
    font-size: 50px;
}
.container{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    height:100vh;
}
.main{
    background-color: white;
    padding: 40px;
    border-radius: 3%;
}
.form{
    display:flex;
    flex-direction:column;
    margin-top: 10px;
}
.btn-display{
    display: flex;
    justify-content: flex-end
}
.btn{
    font-family: 'Dancing Script', cursive;
    font-weight: 100;
    border: 0;
    padding: 10px 20px;
    color: white;
    margin-right: 10px;
}
.btn-danger{
    background-color: #FC427B;
}
.btn-primary{
    background-color: #25CCF7;
}
.btn-danger:hover{
    background-color: #e74c5c;
    cursor: pointer;
}
.btn-primary:hover{
    background-color: #0984e3;
    cursor: pointer;
}
.table{
    width: 80vh;
    border: 2px solid #2d3436;
    margin-top: 50px;
}
.table tr td{
    border-top: 2px solid #2d3436;
    padding: 10px;
}

input{
    padding: 10px;
    outline: none;
    border: none;
    font-family: 'Dancing Script', cursive;
    font-size: 15px;
    font-weight: 700;
    border-bottom: 2px solid black;
}
.input-field{
    border: 1px solid black;
    width:80vh;
    margin-bottom:10px
}
</style>
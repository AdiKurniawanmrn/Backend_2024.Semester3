const fruits =require("./data.js");

const index =() =>{
    for(const fruit of fruits ){
        console.log(fruit);
    }
};

const store=(name)=>{
    fruits.push(name);
    console.log("Method store - Menambahkan buah");
    index();
};

const update = (position, name) => {
    const oldName = fruits[position];
    oldName && (fruits[position] = name);
    console.log ("method update - Mengubah buah");
    index();
};
const destroy = (position) => {
    const removedFruit =fruits.splice(position, 1)[0];
    console.log("method delete - Menghapus buah");
    index();
};



module.exports={index,store,update,destroy};
const{index,store,update,destroy} = require("./fruitController.js");

const main= () => {
    index();
    store("Pisang");
    update(3,"Kelapa");
    destroy(0);
    
};
main();
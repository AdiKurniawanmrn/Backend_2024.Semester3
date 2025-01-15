// import Model Alumni
const Alumni=require("../models/Alumni");

// buat class AlumniController
class AlumniController {
  async index(req,res){
    //memanggil method static dengan await
    const alumni = await Alumni.all();

    //data array lebih dari 0 
    if(alumni.length > 0 ){
        const data ={
            message : "menampilkan seluruh data Alumni",
            data : alumni,
        };
        return res.status(200).json(data);
    } else{
        const data = {
            message : " Resource is empty"
        };
        return res.status(200).json(data);
    }
  } 
  async store(req, res) {
    //descruting object req.body
    const {name,phone,adress,graduation_year,status,company_name,position}= req.body;
    
    //jika data undefined maka krim respons eror
    if(!name || !phone || !adress || !graduation_year|| !status|| !company_name|| !position ){
        const data = {
            message : "All fields must be filled corretlly",
        };
        return res.status(422).json(data);
    }
    else {
        const alumni = await Alumni.create(req.body);
        const data = {
            message : " Resource is added successfuly",
            data : alumni,
        };
        return res.status(201).json(data);
    }
  }
  async update(req,res){
    const{id}=req.params;
    //mencari id Alumni yang ingin di update
    const alumni=await Alumni.find(id);

    if(alumni){
        //melakukan update data
        const alumni=await Alumni.update(id,req.body);
        const data={
            message:"Resource is update successfuly",
            data: alumni,
        };
        res.status(200).json(data);
    }
    else{
        const data={
            message : "Resource not found"
        };
        req.status(400).json(200);
    }
  }
  async destroy(req,res){
    //mencari data yang ingin di delete menggunakan id
    const {id} = req.params;
    const alumni=await Alumni.find(id);

    if(alumni){
      //melakukan delete data
        await Alumni.delete(id);
        const data={
            message :" Resource is delete Successfuly"
        };

        res.status(200).json(data);
    } else{
        const data = {
            message :"Resource not found",
        };
        res.status(400).json(data);
    }
  }
  async show(req,res){
    const {id} = req.params;
    //cari alumni berdasarkan id
    const alumni=await Alumni.find(id);

    if(alumni){
        const data = {
            message : "Get detail resource",
            data : alumni,
        };
        res.status(200).json(data);
    }
    else{
        const data={
          message : "Resource not found",
        };
      res.status(404).json(data);
    }
  }
  async search(req, res) {
    const { name } = req.query; // Ambil nama dari query parameter

    // Memanggil method static dengan await
    const alumni = await Alumni.find(name);

    // Cek apakah data ditemukan
    if (alumni.length > 0) {
        const data = {
            message: "Get searched resource",
            data: alumni,
        };
        return res.status(200).json(data);
    } else {
        const data = {
            message: "Resource not found",
        };
        return res.status(404).json(data);
    }
  }

}

// export object AlumniController
module.exports = new AlumniController();

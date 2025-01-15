// import database

const db =require("../config/database");

// membuat class Alumni
class Alumni {
    // membuat method static all
    static all(){
      //return promise sebagai solusi asynchronous
      return new Promise ((resolve,reject)=>{
      const query = "SELECT * FROM alumni"
      // melakukan query menggunakan method query
      //menerima 2 param query dan callback
      db.query(query, (err,results)=>{
          resolve(results);
      });
      });
  }
  static async create(data, callback) {
    // Promise 1: Melakukan insert data ke database
    const id = await new Promise((resolve, reject) => {
        const sql = "INSERT INTO alumni SET ?";
        db.query(sql, data, (err, results) => {
            if (err) {
                reject(err);  // Menangani error
            }
            resolve(results.insertId); // Mengembalikan insertId yang benar
        });
    });

    // Promise 2: Mengambil data berdasarkan id
    const alumni = await this.find(id);  
    // Menggunakan await untuk menunggu hasilnya
    return alumni;
}

  static find (id){
    return new Promise((resolve, reject) => {
        const sql = "SELECT * FROM alumni WHERE id =?";
        db.query(sql, id, (err, results) => {
            //descruty array
            const[alumni]=results;
            resolve(results);
        });
    });
  } 
  static async update(id,data){
    await new Promise((resolve, reject) => {
        const sql="update alumni SET? WHERE id= ?";
        db.query(sql,[data, id], (err, results)=> {
            resolve(results);
        });
     });
    //mencari data yang baru di update
    const alumni = await this.find(id);
    return alumni;
  }
  static delete(id){
    return new Promise((resolve, reject)=>{
        const sql = "DELETE FROM alumni WHERE id = ?";
        db.query(sql, id,(err,results)=>{
            resolve(results);
        });
    });
  }
  static async find(name) {
        return new Promise((resolve, reject) => {
            const query = 'SELECT * FROM alumni WHERE name LIKE ?'; // Query mencari alumni berdasarkan nama
            db.query(query, [`%${name}%`], (err, results) => {
                if (err) {
                    reject(err); // Menangani error jika ada
                } else {
                    resolve(results); // Mengembalikan hasil pencarian
                }
            });
        });
    }

    static async find() {
        return new Promise((resolve, reject) => {
            const query = 'SELECT * FROM alumni WHERE status = "Bekerja"'; // Query untuk alumni yang sudah bekerja
            db.query(query, (err, results) => {
                if (err) {
                    reject(err); // Menangani error jika ada
                } else {
                    resolve(results); // Mengembalikan hasil pencarian
                }
            });
        });
    }
    static async find() {
        return new Promise((resolve, reject) => {
            const query = 'SELECT * FROM alumni WHERE status = "Tidak bekerja"'; // Query untuk alumni yang sudah bekerja
            db.query(query, (err, results) => {
                if (err) {
                    reject(err); // Menangani error jika ada
                } else {
                    resolve(results); // Mengembalikan hasil pencarian
                }
            });
        });
    }

}

// export class Alumni
module.exports = Alumni;

const Student = require("../data/Student");

class StudentController {
  // Menampilkan data students
  index(req, res) {
    res.json({
      message: "Menampilkan semua students",
      data: Student.map(student => student.name), // Tampilkan hanya nama
    });
  }

  // Menambahkan data students
  store(req, res) {
    const { name } = req.body;


    const newStudent = { name };
    Student.push(newStudent);

    res.json({
      message: `Menambahkan data student: ${name}`,
      data: Student.map(Student => Student.name),
    });
  }

  // Mengupdate data students
  update(req, res) {
    const { id } = req.params;
    const { name } = req.body;

    const student = Student.find(student => student.id === parseInt(id));

    if (student) {
      student.name = name;
      res.json({
        message: `Mengedit student id ${id}, nama ${name}`,
        data: Student.map(student => student.name),
      });
    } else {
      res.status(404).json({ message: "Student not found" });
    }
  }

  // Menghapus data students
  destroy(req, res) {
    const { id } = req.params;
    const studentId = parseInt(id);

    // Cari student dengan id yang cocok
    const index = Student.findIndex(student => student.id === studentId);
  
    if (index >= 0) {
      Student.splice(index, 1); // Hapus student
      return res.json({
        message: `Student dengan id ${studentId} telah dihapus`,
        data: Student.map(student => student.name),
      });
    }
  
    res.status(404).json({ message: "Student tidak ditemukan" });
  }
  
}

module.exports = new StudentController();

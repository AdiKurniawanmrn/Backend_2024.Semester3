import students from '../data/students.js';

class StudentController {
  // Menampilkan data students
  index(req, res) {
    res.json({ message: "Menampilkan semua students",
         data: students });
  }

  // Menambahkan data students
  store(req, res) {
    const { name } = req.body;  
    const newStudent = { id: students.length + 1, name };
    students.push(newStudent);
    res.json({ message: "Menambahkan data student", data: newStudent });
  }

  // Mengupdate data students
  update(req, res) {
    const { id } = req.params;
    const { name } = req.body;
    const student = students.find(student => student.id === parseInt(id));

    if (student) {
      student.name = name;
      res.json({ message: `Mengedit student id ${id}`, data: student });
    } else {
      res.status(404).json({ message: "Student not found" });
    }
  }

  // Menghapus data students
  destroy(req, res) {
    const { id } = req.params;
    const index = students.findIndex(student => student.id === parseInt(id));

    if (index !== -1) {
      const [deletedStudent] = students.splice(index, 1);
      res.json({ message: `Menghapus student id ${id}`, data: deletedStudent });
    } else {
      res.status(404).json({ message: "Student not found" });
    }
  }
}

export default new StudentController();

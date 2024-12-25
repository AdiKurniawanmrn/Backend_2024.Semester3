import express from 'express';
import StudentController from '../controllers/StudentController.js';

const router = express.Router();

// Routes
router.get('/students', StudentController.index);
router.post('/students', StudentController.store);
router.put('/students/:id', StudentController.update);
router.delete('/students/:id', StudentController.destroy);

export default router;

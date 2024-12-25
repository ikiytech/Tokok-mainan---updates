const express = require('express');
const bodyParser = require('body-parser');
const jwt = require('jsonwebtoken');

const app = express();
const SECRET_KEY = 'your_secret_key';

// Middleware
app.use(bodyParser.json());

// Data sementara
const USERS = [
    { id: 1, username: 'john_doe', password: '123456', email: 'john@example.com' }
];

// Endpoint login
app.post('/login', (req, res) => {
    const { username, password } = req.body;
    const user = USERS.find(u => u.username === username && u.password === password);

    if (user) {
        const token = jwt.sign({ id: user.id, username: user.username }, SECRET_KEY, { expiresIn: '1h' });
        res.json({ token });
    } else {
        res.status(401).json({ message: 'Username atau password salah' });
    }
});

// Endpoint dashboard
app.get('/dashboard', (req, res) => {
    const token = req.headers.authorization?.split(' ')[1];

    if (!token) {
        return res.status(401).json({ message: 'Token tidak ditemukan' });
    }

    try {
        const decoded = jwt.verify(token, SECRET_KEY);
        res.json({ message: `Selamat datang, ${decoded.username}` });
    } catch (error) {
        res.status(401).json({ message: 'Token tidak valid' });
    }
});

// Jalankan server
app.listen(3000, () => console.log('Server running on http://localhost:3000'));

const express = require('express');
const app = express();
const cors = require('cors');
const port = process.env.PORT || 3000;

app.use(cors());
app.use(express.json());

app.get('/', (req, res) => {
  res.send('Backend đang chạy ngon lành cành đào!');
});

app.get('/api/v1/employees', (req, res) => {
  console.log("Frontend vừa gọi lấy danh sách nhân viên!"); 
  res.json([
    { id: 1, name: "Nguyen Van A", role: "Developer (Backend)" },
    { id: 2, name: "Tran Thi B", role: "Tester (Frontend)" },
    { id: 3, name: "Le Van C", role: "DevOps (Docker)" }
  ]);
});

app.listen(port, () => {
  console.log(`Backend listening at http://localhost:${port}`);
});
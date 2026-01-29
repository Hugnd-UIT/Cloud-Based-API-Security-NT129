import { useEffect, useState } from 'react'

function App() {
  const [status, setStatus] = useState("⏳ Đang kết nối tới Backend...")
  const [data, setData] = useState(null)

  useEffect(() => {
    fetch('http://localhost:4444/api/v1/employees')
      .then(res => {
        if (!res.ok) throw new Error("Kết nối thất bại!")
        return res.json()
      })
      .then(result => {
        setStatus("✅ KẾT NỐI THÀNH CÔNG!")
        setData(result)
      })
      .catch(err => {
        setStatus("❌ LỖI: Không thấy Backend đâu (Kiểm tra lại cổng 4444)")
        console.error(err)
      })
  }, [])

  return (
    <div style={{ padding: '50px', textAlign: 'center' }}>
      <h1>TEST HỆ THỐNG</h1>
      <h2>{status}</h2>
      {data && (
        <div style={{ background: '#eee', padding: 20, marginTop: 20 }}>
          {data.map(nv => (
            <p key={nv.id}>👤 {nv.name} - {nv.role}</p>
          ))}
        </div>
      )}
    </div>
  )
}

export default App
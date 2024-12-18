// Fungsi untuk menampilkan hasil download
function showDownload(result) {
    console.log("Download selesai");
    console.log("Hasil Download: " + result);
  }
  
  // Fungsi untuk download file yang mengembalikan Promise
  function download() {
    return new Promise((resolve) => {
      setTimeout(() => {
        const result = "windows-10.exe";
        resolve(result);
      }, 3000);
    });
  }
  
  // Menggunakan async/await untuk memulai proses download
  async function startDownload() {
    try {
      const result = await download();
      showDownload(result);
    } catch (error) {
      console.error("Terjadi kesalahan saat mengunduh:", error);
    }
  }
  
  startDownload();
  
  
  
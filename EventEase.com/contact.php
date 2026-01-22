<?php 
// 1. Hubungkan dengan konfigurasi database
include 'config.php';
include 'components/header.php'; 

$statusMsg = "";
$statusType = "";

// 2. Logika Pemrosesan Form
if (isset($_POST['kirim'])) {
    // Sanitasi data agar aman dari SQL Injection
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $tamu     = mysqli_real_escape_string($conn, $_POST['jumlah_tamu']);
    $lokasi   = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $pesan    = mysqli_real_escape_string($conn, $_POST['pesan']);

    if(!empty($nama) && !empty($email) && !empty($pesan)){
        
        // --- SIMPAN KE DATABASE ---
        // Mencocokkan kolom sesuai gambar database Anda: nama, email, kategori, jumlah_tamu, lokasi, pesan
        $query = "INSERT INTO pesan_kontak (nama, email, kategori, jumlah_tamu, lokasi, pesan) 
                  VALUES ('$nama', '$email', '$kategori', '$tamu', '$lokasi', '$pesan')";
        
        $saveToDb = mysqli_query($conn, $query);
        
        // --- KIRIM KE EMAIL (raffi10nugraha@gmail.com) ---
        $to = "raffi10nugraha@gmail.com";
        $subject = "EventEase Inquiry: $kategori - $nama";
        
        $emailContent = "
        <html>
        <body style='font-family: Arial, sans-serif; color: #333; line-height: 1.6;'>
            <div style='background: #000; padding: 25px; text-align: center;'>
                <h1 style='color: #C0C0C0; margin: 0; letter-spacing: 5px;'>NEW EVENT INQUIRY</h1>
            </div>
            <div style='padding: 30px; border: 1px solid #ddd; background: #fff;'>
                <p><strong>Nama Klien:</strong> $nama</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Kategori Acara:</strong> $kategori</p>
                <p><strong>Estimasi Tamu:</strong> $tamu</p>
                <p><strong>Rencana Lokasi:</strong> $lokasi</p>
                <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
                <p><strong>Pesan Tambahan:</strong></p>
                <p style='background: #f9f9f9; padding: 15px; border-left: 4px solid #C0C0C0;'>$pesan</p>
            </div>
            <p style='font-size: 10px; color: #999; text-align: center; margin-top: 20px;'>Sent via EventEase Website</p>
        </body>
        </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: system@eventease.com" . "\r\n";
        $headers .= "Reply-To: $email" . "\r\n";

        // Eksekusi pengiriman email
        @mail($to, $subject, $emailContent, $headers);

        if ($saveToDb) {
            $statusMsg = "TERIMA KASIH! PENGAJUAN ANDA TELAH KAMI TERIMA.";
            $statusType = "success";
        } else {
            // Menampilkan error jika query gagal (sangat membantu saat debugging)
            $statusMsg = "KESALAHAN DATABASE: " . mysqli_error($conn);
            $statusType = "error";
        }
    }
}
?>

<section style="padding: 180px 0 100px; background: linear-gradient(rgba(0,0,0,0.85), rgba(0,0,0,0.9)), url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?q=80&w=2070') center/cover; background-attachment: fixed;">
    <div class="container" style="text-align: center;" data-aos="fade-down">
        <h1 style="font-size: clamp(2rem, 5vw, 3.5rem); letter-spacing: 12px; margin-bottom: 20px;">CONNECT WITH <span>US</span></h1>
        <p style="color: #888; letter-spacing: 4px; font-size: 13px; text-transform: uppercase;">Wujudkan Perhelatan Ikonik Anda Bersama EventEase</p>
        <div style="width: 40px; height: 1px; background: var(--silver-primary); margin: 30px auto;"></div>
    </div>
</section>

<section style="padding: 100px 0; background: var(--primary-black);">
    <div class="container">
        
        <?php if($statusMsg != ""): ?>
            <div style="padding: 20px; margin-bottom: 50px; text-align: center; border: 1px solid <?= ($statusType == 'success') ? 'var(--silver-primary)' : '#ff4d4d' ?>; background: rgba(0,0,0,0.5); color: #fff; letter-spacing: 2px; font-size: 11px; backdrop-filter: blur(10px);" data-aos="zoom-in">
                <i class="fas <?= ($statusType == 'success') ? 'fa-check-circle' : 'fa-exclamation-triangle' ?>" style="margin-right: 10px; color: var(--silver-primary);"></i>
                <?= $statusMsg ?>
            </div>
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 100px; align-items: start;">
            
            <div data-aos="fade-right">
                <h2 style="font-size: 1.5rem; letter-spacing: 4px; margin-bottom: 30px;">THE <span>STUDIO</span></h2>
                <div style="margin-bottom: 40px;">
                    <p style="color: #666; font-size: 14px; line-height: 2.2; margin-bottom: 40px;">
                        Kunjungi studio kreatif kami untuk mendiskusikan visi acara Anda secara mendalam. Kami melayani janji temu khusus untuk konsultasi konsep yang dipersonalisasi.
                    </p>
                    
                    <div style="margin-bottom: 35px; border-left: 1px solid var(--silver-primary); padding-left: 25px;">
                        <span style="display: block; color: var(--silver-primary); font-size: 9px; letter-spacing: 3px; font-weight: 800; margin-bottom: 12px; text-transform: uppercase;">LOKASI KANTOR</span>
                        <p style="font-size: 14px; color: #fff; line-height: 1.8;">Jl. Erba, Lembah Damai,<br>Rumbai Pesisir, Pekanbaru, Riau</p>
                    </div>

                    <div style="margin-bottom: 45px; border-left: 1px solid var(--silver-primary); padding-left: 25px;">
                        <span style="display: block; color: var(--silver-primary); font-size: 9px; letter-spacing: 3px; font-weight: 800; margin-bottom: 12px; text-transform: uppercase;">WHATSAPP HOTLINE</span>
                        <p style="font-size: 14px; color: #fff;">+62 812-3456-7890</p>
                    </div>
                </div>

                <a href="https://wa.me/6281234567890" target="_blank" class="btn" style="width: 100%; text-align: center; background: transparent; border: 1px solid rgba(37, 211, 102, 0.5); color: #25D366; letter-spacing: 3px;">
                    <i class="fab fa-whatsapp" style="margin-right: 12px;"></i> KONSULTASI INSTAN
                </a>
            </div>

            <div data-aos="fade-left" style="background: var(--secondary-black); padding: 60px 50px; border: 1px solid var(--glass-border); position: relative; box-shadow: 0 30px 60px rgba(0,0,0,0.5);">
                <h3 style="font-size: 12px; letter-spacing: 5px; margin-bottom: 40px; color: var(--silver-primary); text-align: center;">INQUIRY FORM</h3>
                
                <form action="" method="POST" class="luxury-form">
                    <div class="input-group">
                        <input type="text" name="nama" placeholder="NAMA LENGKAP" required>
                    </div>
                    
                    <div class="input-group">
                        <input type="email" name="email" placeholder="EMAIL BISNIS / PRIBADI" required>
                    </div>
                    
                    <div class="input-group">
                        <select name="kategori" required>
                            <option value="" disabled selected>KATEGORI ACARA</option>
                            <option value="Royal Wedding">ROYAL WEDDING</option>
                            <option value="Corporate Gala">CORPORATE GALA</option>
                            <option value="Private Celebration">PRIVATE CELEBRATION</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <select name="jumlah_tamu" required>
                            <option value="" disabled selected>ESTIMASI JUMLAH TAMU</option>
                            <option value="Intimate (<100)">INTIMATE (< 100 TAMU)</option>
                            <option value="Medium (100-500)">MEDIUM (100 - 500 TAMU)</option>
                            <option value="Grand (500-1000)">GRAND (500 - 1000 TAMU)</option>
                            <option value="Royal (>1000)">ROYAL (> 1000 TAMU)</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <select name="lokasi" required>
                            <option value="" disabled selected>RENCANA LOKASI</option>
                            <option value="Hotel/Ballroom">INDOOR (HOTEL / BALLROOM)</option>
                            <option value="Outdoor/Garden">OUTDOOR / GARDEN</option>
                            <option value="Private Residence">PRIVATE RESIDENCE</option>
                            <option value="Lainnya">LAINNYA / LUAR KOTA</option>
                        </select>
                    </div>
                    
                    <div class="input-group">
                        <textarea name="pesan" placeholder="CATATAN TAMBAHAN (TANGGAL ACARA ATAU VISI KHUSUS)" rows="3" required></textarea>
                    </div>
                    
                    <button type="submit" name="kirim" class="btn" style="width: 100%; margin-top: 20px;">
                        SUBMIT INQUIRY
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<section style="height: 500px; width: 100%; filter: grayscale(1) invert(0.92) contrast(1.2); border-top: 1px solid var(--glass-border);">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127669.04301389279!2d101.3725832709192!3d0.5104443657758254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ac2f2d9e846b%3A0x4039d80b220d0e0!2sPekanbaru%2C%20Riau!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
    </iframe>
</section>

<style>
.luxury-form .input-group { margin-bottom: 25px; }
.luxury-form input, .luxury-form select, .luxury-form textarea {
    width: 100%; background: transparent; border: none; border-bottom: 1px solid rgba(255,255,255,0.1);
    padding: 12px 0; color: #fff; font-size: 11px; letter-spacing: 2px; outline: none; transition: 0.4s;
}
.luxury-form select option { background: #111; color: #fff; }
.luxury-form input:focus, .luxury-form select:focus, .luxury-form textarea:focus { border-bottom: 1px solid var(--silver-primary); }
::placeholder { color: #444; }
</style>

<?php include 'components/footer.php'; ?>
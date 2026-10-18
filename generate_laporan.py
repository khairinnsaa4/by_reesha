import docx
from docx import Document
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.shared import Pt, Inches, RGBColor

doc = Document()

# Cover Slot
doc.add_heading('[SLOT COVER LAPORAN]', 0).alignment = WD_ALIGN_PARAGRAPH.CENTER
p = doc.add_paragraph('Judul: Laporan Narasi Alur dan Output Operasional\nBisnis BY.REESHA Bakery')
p.alignment = WD_ALIGN_PARAGRAPH.CENTER
doc.add_page_break()

# Kata Pengantar
doc.add_heading('KATA PENGANTAR', level=1)
doc.add_paragraph(
    "Puji syukur kami panjatkan atas selesainya penyusunan 'Laporan Narasi Alur dan Output Divisi Operasional' "
    "untuk bisnis By.Reesha Bakery. Laporan ini disusun untuk memberikan gambaran komprehensif, naratif, "
    "dan terstruktur mengenai alur kerja dari masing-masing divisi yang ada di dalam sistem.\n\n"
    "Melalui laporan ini, diharapkan seluruh pemangku kepentingan (stakeholders) dapat memahami "
    "tugas pokok, aliran data, dan hasil fisik maupun digital yang dikeluarkan oleh setiap divisi. "
    "Semoga dokumen ini bermanfaat sebagai panduan operasional (SOP) dan dasar pengembangan sistem ke depannya."
)
doc.add_page_break()

# Daftar Isi 
doc.add_heading('DAFTAR ISI', level=1)
doc.add_paragraph("1. KATA PENGANTAR\n2. PENDAHULUAN\n3. NARASI ALUR DAN OUTPUT DIVISI\n   A. Divisi Administrasi & Laporan\n   B. Divisi Dapur & Produksi\n   C. Divisi Pelayanan & Kasir\n   D. Divisi Operasional & Logistik\n4. KESIMPULAN")
doc.add_page_break()

# Pendahuluan
doc.add_heading('PENDAHULUAN', level=1)
doc.add_paragraph(
    "Bisnis bakery By.Reesha telah berkembang dari sebuah usaha konvensional menjadi sebuah bisnis "
    "yang terstruktur dengan manajemen sistem berbasis digital. Dalam menjalankan kegiatan operasionalnya "
    "sehari-hari, By.Reesha mengandalkan kolaborasi antar divisi yang memiliki tanggung jawab spesifik, "
    "alur kerja yang terdefinisi dengan jelas, serta output (keluaran) yang nyata baik berupa data digital "
    "maupun dokumen cetak.\n\n"
    "Pendekatan sistematis ini dirancang untuk meminimalisir kesalahan pesanan (human error), "
    "mengendalikan ketersediaan stok bahan baku, dan memastikan kepuasan pelanggan tetap pada tingkat tertinggi. "
    "Laporan ini menjabarkan secara naratif bagaimana setiap divisi—mulai dari Administrasi, Dapur, Pelayanan, "
    "hingga Operasional/Logistik—menerima input, memprosesnya, dan menghasilkan output akhir berupa produk "
    "atau dokumen fisik (print out) yang krusial bagi kelancaran bisnis."
)
doc.add_page_break()

# Narasi Divisi
doc.add_heading('NARASI ALUR DAN OUTPUT DIVISI', level=1)

# Divisi Administrasi & Laporan
doc.add_heading('A. Divisi Administrasi dan Keuangan', level=2)
doc.add_paragraph(
    "Alur Kerja:\n"
    "Divisi Administrasi memiliki peran penting sebagai pusat pengendali data (center of data control). "
    "Setiap harinya, divisi ini menerima rekapitulasi data pesanan yang telah diselesaikan oleh divisi pelayanan "
    "dan pengeluaran bahan baku dari divisi logistik. Alur kerja dimulai dengan memantau dashboard sistem untuk "
    "memverifikasi semua transaksi pembayaran yang masuk melalui transfer bank, QRIS, maupun Cash on Delivery (COD). "
    "Setelah semua pesanan harian ditutup (closing), divisi ini bertugas melakukan pembukuan, menghitung total "
    "pendapatan kotor, menganalisis margin keuntungan, dan mencatat pengeluaran operasional (seperti pembelian "
    "bahan ke supplier).\n\n"
    "Output yang Dihasilkan:\n"
    "Output utama dari divisi ini adalah dokumen pelaporan kinerja bisnis yang sangat dibutuhkan oleh Owner. "
    "Dokumen ini berupa Laporan Penjualan Harian/Bulanan dan Laporan Laba Rugi yang dicetak untuk diarsipkan "
    "atau dipresentasikan dalam rapat evaluasi."
)
p = doc.add_paragraph("[taruh hasil print divisi Administrasi / Laporan Keuangan di sini]")
p.runs[0].font.color.rgb = RGBColor(255, 0, 0)
p.runs[0].font.bold = True

# Divisi Dapur & Produksi
doc.add_heading('B. Divisi Dapur dan Produksi (Baker & Dekorasi)', level=2)
doc.add_paragraph(
    "Alur Kerja:\n"
    "Divisi Dapur merupakan jantung dari operasional By.Reesha. Alur kerja di divisi ini dipicu oleh notifikasi "
    "pesanan baru yang berstatus 'Sedang Diproses' di dalam sistem. Saat pesanan masuk, kepala baker akan melihat "
    "rincian pesanan yang mencakup: jenis kue (misalnya Bento Cake atau Premium Cake), ukuran, varian rasa, serta "
    "catatan khusus dari pelanggan (seperti tulisan 'Happy Birthday' atau permintaan custom desain). "
    "Tim baker kemudian menyiapkan bahan baku sesuai resep standar, melakukan proses pemanggangan (baking), "
    "dan menyerahkannya kepada tim dekorasi. Seluruh proses ini membutuhkan tingkat ketelitian yang tinggi agar "
    "visual dan rasa kue sesuai dengan standar kualitas By.Reesha. Setelah kue selesai diproduksi, kue dilabeli "
    "dan diserahkan kepada divisi packaging.\n\n"
    "Output yang Dihasilkan:\n"
    "Selain produk kue fisik, divisi ini bergantung pada 'Kertas Tiket Pesanan (Order Ticket)' yang dicetak "
    "sebagai panduan kerja di dapur agar tidak ada detail custom pelanggan yang terlewat."
)
p = doc.add_paragraph("[taruh hasil print divisi Dapur / Tiket Pesanan / Custom Design di sini]")
p.runs[0].font.color.rgb = RGBColor(255, 0, 0)
p.runs[0].font.bold = True


# Divisi Pelayanan
doc.add_heading('C. Divisi Pelayanan (Kasir & Customer Service)', level=2)
doc.add_paragraph(
    "Alur Kerja:\n"
    "Divisi Pelayanan bertindak sebagai garda terdepan (frontliner) yang berinteraksi langsung dengan pelanggan. "
    "Alurnya dimulai ketika ada pelanggan yang datang ke toko (walk-in) atau melakukan pemesanan via web. "
    "Staf pelayanan bertugas menjawab pertanyaan terkait produk, membantu proses checkout jika pelanggan mengalami "
    "kesulitan, dan memverifikasi pembayaran. Setelah kue selesai dari divisi dapur dan dipacking, divisi pelayanan "
    "akan memastikan serah-terima kue kepada pelanggan atau kurir berjalan lancar. Mereka juga bertanggung jawab "
    "untuk mengubah status pesanan di sistem menjadi 'Selesai', yang menandakan bahwa transaksi telah sukses ditutup.\n\n"
    "Output yang Dihasilkan:\n"
    "Output dari divisi ini sangat berorientasi pada pelanggan, yakni berupa Nota Pembelian (Struk/Invoice) "
    "sebagai bukti sah transaksi dan tanda terima."
)
p = doc.add_paragraph("[taruh hasil print divisi Pelayanan / Struk Nota Kasir di sini]")
p.runs[0].font.color.rgb = RGBColor(255, 0, 0)
p.runs[0].font.bold = True

# Divisi Operasional & Logistik
doc.add_heading('D. Divisi Operasional (Logistik, Gudang & Packaging)', level=2)
doc.add_paragraph(
    "Alur Kerja:\n"
    "Divisi Operasional memegang kendali atas arus barang, mulai dari bahan mentah hingga barang siap kirim. "
    "Dalam hal logistik, staf gudang bertugas memantau ketersediaan bahan baku (tepung, telur, mentega, dll). "
    "Sistem cerdas By.Reesha akan memberikan peringatan (Aman/Menipis/Kritis), dan divisi ini bertugas menindaklanjuti "
    "peringatan tersebut dengan melakukan pemesanan ulang (restock) kepada Supplier di area Lhokseumawe. "
    "Di sisi lain, sub-divisi packaging bertugas menerima kue jadi dari dapur, memasukkannya ke dalam boks eksklusif, "
    "menambahkan ice gel jika diperlukan, dan menempelkan label pengiriman untuk pesanan online.\n\n"
    "Output yang Dihasilkan:\n"
    "Output administratif dari divisi ini mencakup Label Pengiriman (Shipping Label) yang akan ditempel "
    "di kotak kemasan kue untuk diserahkan kepada kurir."
)
p = doc.add_paragraph("[taruh hasil print divisi Operasional / Label Pengiriman atau Surat Jalan di sini]")
p.runs[0].font.color.rgb = RGBColor(255, 0, 0)
p.runs[0].font.bold = True

# Kesimpulan
doc.add_page_break()
doc.add_heading('KESIMPULAN', level=1)
doc.add_paragraph(
    "Sinergi yang terbangun antara Divisi Administrasi, Dapur, Pelayanan, dan Operasional merupakan kunci utama "
    "keberhasilan By.Reesha. Dengan alur kerja yang tertata dan sistem yang memadai, setiap anggota tim dapat "
    "menjalankan tugasnya dengan fokus dan efisien. Output dokumen fisik yang dicetak oleh setiap divisi, mulai dari "
    "Laporan Keuangan, Tiket Pesanan, Struk Transaksi, hingga Label Pengiriman, berfungsi sebagai instrumen "
    "pengendalian mutu (Quality Control) dan validasi proses bisnis, memastikan bahwa apa yang tercatat di sistem "
    "digital benar-benar direalisasikan di lapangan."
)

doc.save('c:/xampp2/htdocs/by_reesha_laravel/Laporan_Narasi_Alur_Divisi.docx')

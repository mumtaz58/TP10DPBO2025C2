Janji

Saya Armelia Zahrah Mumtaz dengan NIM 2300801 berjanji mengerjakan TP10 DPBO dengan keberkahan-Nya, maka saya tidak akan melakukan kecurangan sesuai yang telah di spesifikasikan, Aamiin

## Desain Program dan Alur Database College


Database "college" ini dirancang untuk mengelola informasi akademik di sebuah perguruan tinggi dengan tiga tabel utama yang saling terhubung:

1. Tabel Departments (Jurusan)

Menyimpan data tentang jurusan akademik
Setiap jurusan memiliki ID unik, nama, lokasi kantor, dan deskripsi


2. Tabel Professors (Dosen)

Menyimpan data tentang dosen pengajar
Setiap dosen memiliki ID unik, terkait dengan jurusan tertentu, nama, email, dan spesialisasi
Terhubung ke tabel Departments melalui department_id


3. Tabel Courses (Mata Kuliah)

Menyimpan data tentang mata kuliah yang ditawarkan
Setiap mata kuliah memiliki ID unik, terkait dengan jurusan dan dosen tertentu, judul, kode mata kuliah, jumlah kredit, dan deskripsi
Terhubung ke tabel Departments dan Professors melalui department_id dan professor_id



## Relasi Antar Tabel

Satu jurusan dapat memiliki banyak dosen (relasi one-to-many dari Departments ke Professors)
Satu jurusan dapat menawarkan banyak mata kuliah (relasi one-to-many dari Departments ke Courses)
Satu dosen dapat mengajar beberapa mata kuliah (relasi one-to-many dari Professors ke Courses)
Setiap mata kuliah terhubung dengan tepat satu jurusan dan satu dosen pengajar

## Alur Kerja Database

1. Pendaftaran Jurusan

Jurusan didaftarkan terlebih dahulu dalam database dengan informasi nama, lokasi, dan deskripsi
Setiap jurusan mendapatkan ID unik secara otomatis


2. Penambahan Dosen

Dosen ditambahkan ke database dengan mengaitkannya ke jurusan tempat mereka bekerja
Informasi seperti nama, email, dan spesialisasi disimpan untuk setiap dosen
Setiap dosen hanya dapat terdaftar di satu jurusan


3. Pengaturan Mata Kuliah

Mata kuliah dibuat dengan mengaitkannya ke jurusan yang menawarkan dan dosen yang mengajar
Setiap mata kuliah memiliki kode unik, judul, jumlah kredit, dan deskripsi
Mata kuliah harus memiliki tepat satu jurusan dan satu dosen pengajar



<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Aturan;
use App\Models\Gejala;
use App\Models\Kasus;
use App\Models\Pasien;
use App\Models\Penyakit;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // data user
        User::create([
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin1234'),
            'nama' => 'admin',
            'nip' => '19691124 199503 2 001',
            'phone' => '085765890234',
            'role' => 'admin',
        ]);
        User::create([
            'email' => 'dokter@mail.com',
            'password' => bcrypt('dokter1234'),
            'nama' => 'dokter',
            'nip' => '19800427 200502 1 001',
            'phone' => '085765812345',
            'role' => 'dokter',
        ]);
        User::create([
            'email' => 'perawat@mail.com',
            'password' => bcrypt('perawat1234'),
            'nama' => 'perawat',
            'nip' => '19860111 200912 1 001',
            'phone' => '085765812657',
            'role' => 'perawat',
        ]);

        // data gejala
        Gejala::create(['kode' => 'J0001', 'nama' => 'Apakah anda sering menderita sakit kepala?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0002', 'nama' => 'Apakah anda kehilangan nafsu makan?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0003', 'nama' => 'Apakah tidur anda tidak lelap?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0004', 'nama' => 'Apakah anda mudah menjadi takut?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0005', 'nama' => 'Apakah anda merasa cemas, tegang dan khawatir?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0006', 'nama' => 'Apakah tangan anda gemetar?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0007', 'nama' => 'Apakah anda mengalami gangguan pencernaan?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0008', 'nama' => 'Apakah anda mersa sulit berpikir jernih?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0009', 'nama' => 'Apakah anda merasa tidak bahagia?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0010', 'nama' => 'Apakah anda sering menangis?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0011', 'nama' => 'Apakah anda sulit untuk menikmati aktivitas sehari-hari?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0012', 'nama' => 'Apakah anda mengalami kesulitan untuk mengambil keputusan?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0013', 'nama' => 'Apakah pekerjaan sehari-hari terganggu?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0014', 'nama' => 'Apakah anda merasa tidak mampu berperan dalam kehidupan ini?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0015', 'nama' => 'Apakah anda kehilangan minat terhadap banyak hal?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0016', 'nama' => 'Apakah anda merasa tidak berharga?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0017', 'nama' => 'Apakah anda mempunyai pikiran untuk mengakhiri hidup anda?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0018', 'nama' => 'Apakah anda merasa Lelah sepanjang waktu?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0019', 'nama' => 'Apakah anda mersasa tidak enak perut?', 'keterangan' => '']);
        Gejala::create(['kode' => 'J0020', 'nama' => 'Apakah anda mudah Lelah?', 'keterangan' => '']);

        // data penyakit
        Penyakit::create(['kode' => 'K0001', 'nama' => 'Gangguan Depresi', 'definisi' => 'Penjelasan Penyakit', 'solusi' => 'Solusi Penyakit',]);
        Penyakit::create(['kode' => 'K0002', 'nama' => 'Gangguan Kecemasan', 'definisi' => 'Penjelasan Penyakit', 'solusi' => 'Solusi Penyakit',]);
        Penyakit::create(['kode' => 'K0003', 'nama' => 'Gangguan Somatoform', 'definisi' => 'Penjelasan Penyakit', 'solusi' => 'Solusi Penyakit',]);
        Penyakit::create(['kode' => 'K0004', 'nama' => 'Gangguan Neurotik', 'definisi' => 'Penjelasan Penyakit', 'solusi' => 'Solusi Penyakit',]);

        // data pasien
        Pasien::create([
            'card_id' => '3514107798000001',
            'nama' => 'pasien 1',
            'umur' => 34,
            'phone' => '085901287123',
        ]);
        Pasien::create([
            'card_id' => '3514107798000002',
            'nama' => 'pasien 2',
            'umur' => 45,
            'phone' => '085901287453',
        ]);
        Pasien::create([
            'card_id' => '3514107798000003',
            'nama' => 'pasien 3',
            'umur' => 23,
            'phone' => '085901287876',
        ]);
        Pasien::create([
            'card_id' => '3514107798000004',
            'nama' => 'pasien 4',
            'umur' => 21,
            'phone' => '085901287097',
        ]);

        // data kasus
        Kasus::create(['user_id' => 3, 'penyakit_id' => 1, 'bobot' => 1.0, 'type' => 'aturan']);
        Kasus::create(['user_id' => 3, 'penyakit_id' => 2, 'bobot' => 1.0, 'type' => 'aturan']);
        Kasus::create(['user_id' => 3, 'penyakit_id' => 3, 'bobot' => 1.0, 'type' => 'aturan']);
        Kasus::create(['user_id' => 3, 'penyakit_id' => 4, 'bobot' => 1.0, 'type' => 'aturan']);

        // data aturan
        Aturan::create(['kasus_id' => 1, 'gejala_id' => 2]);
        Aturan::create(['kasus_id' => 1, 'gejala_id' => 3]);
        Aturan::create(['kasus_id' => 1, 'gejala_id' => 8]);
        Aturan::create(['kasus_id' => 1, 'gejala_id' => 9]);
        Aturan::create(['kasus_id' => 1, 'gejala_id' => 10]);
        Aturan::create(['kasus_id' => 1, 'gejala_id' => 11]);
        Aturan::create(['kasus_id' => 1, 'gejala_id' => 12]);
        Aturan::create(['kasus_id' => 1, 'gejala_id' => 14]);
        Aturan::create(['kasus_id' => 1, 'gejala_id' => 15]);
        Aturan::create(['kasus_id' => 1, 'gejala_id' => 16]);
        Aturan::create(['kasus_id' => 1, 'gejala_id' => 17]);
        Aturan::create(['kasus_id' => 1, 'gejala_id' => 18]);
        Aturan::create(['kasus_id' => 1, 'gejala_id' => 20]);
        Aturan::create(['kasus_id' => 2, 'gejala_id' => 4]);
        Aturan::create(['kasus_id' => 2, 'gejala_id' => 5]);
        Aturan::create(['kasus_id' => 2, 'gejala_id' => 6]);
        Aturan::create(['kasus_id' => 2, 'gejala_id' => 16]);
        Aturan::create(['kasus_id' => 3, 'gejala_id' => 1]);
        Aturan::create(['kasus_id' => 3, 'gejala_id' => 7]);
        Aturan::create(['kasus_id' => 3, 'gejala_id' => 19]);
        Aturan::create(['kasus_id' => 4, 'gejala_id' => 3]);
        Aturan::create(['kasus_id' => 4, 'gejala_id' => 8]);
        Aturan::create(['kasus_id' => 4, 'gejala_id' => 13]);
        Aturan::create(['kasus_id' => 4, 'gejala_id' => 18]);
        Aturan::create(['kasus_id' => 4, 'gejala_id' => 20]);
    }
}

<?php
// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;


class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function sejarah()
    {
        return view('sejarah');
    }

    public function visiMisi()
    {
        return view('visi-misi');
    }

    public function peta()
    {
        return view('peta');
    }

    public function struktur()
    {
        return view('struktur');
    }

    public function potensi()
    {
        return view('potensi');
    }

    public function surat()
    {
        $configPath = public_path('assets/js/surat-config.json');
        $configJson = "{}";
        if (File::exists($configPath)) {
            $configJson = File::get($configPath);
        }
        return view('surat', ['suratConfigJson' => $configJson]);
    }

    public function kontak()
    {
        // Simpan semua info kontak di sini agar mudah diubah
        $contactDetails = [
            'alamat' => 'Jl. Poros Desa, Desa Ulukalo, Kec. Iwoimendaa, Kab. Kolaka, Sulawesi Tenggara Kode Pos 93552',
            'telepon' => '+6281234567890',
            'link_wa' => 'https://wa.me/6281234567890',
            'email' => 'info.ulukalo@gmail.com',
            'jam_layanan' => 'Senin–Jumat: 08.00–15.00 WITA<br>Sabtu–Minggu: Libur',
            'link_gmaps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15920.35332616658!2d121.36983055!3d-4.0118508499999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d948fe5731fc69b%3A0x6b189de85c8466d3!2sUlukalo%2C%20Kec.%20Iwoimendaa%2C%20Kabupaten%20Kolaka%2C%20Sulawesi%20Tenggara!5e0!3m2!1sid!2sid!4v1724497531405!5m2!1sid!2sid',
            'link_gmaps' => 'https://maps.app.goo.gl/bM5j2hGgHkUv5r2y5'
        ];

        return view('kontak', ['kontak' => $contactDetails]);
    }

    public function pemerintahan()
    {
        return view('pemerintahan');
    }

    public function apbdes()
    {
        return view('apbdes');
    }
}

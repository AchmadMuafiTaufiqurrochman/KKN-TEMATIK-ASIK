<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProductController extends Controller
{
    public function index()
    {
        $potentials = collect([
            (object)[
                'title' => 'Pertanian Padi Organik',
                'description' => 'Pertanian padi organik di Desa Wonokarang menggunakan sistem irigasi tetes dan pupuk ramah lingkungan.',
                'image' => 'https://source.unsplash.com/640x480/?rice,field',
                'category' => 'pertanian',
                'products' => collect([
                    (object)[
                        'name' => 'Beras Organik Premium 5kg',
                        'description' => 'Beras tanpa pestisida, diolah secara alami dan dikemas higienis.',
                        'image' => 'https://source.unsplash.com/160x160/?rice,organic',
                        'whatsapp_number' => '6281234567890',
                    ],
                    (object)[
                        'name' => 'Paket Bibit Padi Unggul',
                        'description' => 'Bibit unggul lokal yang tahan hama dan cuaca ekstrem.',
                        'image' => 'https://source.unsplash.com/160x160/?rice,seeds',
                        'whatsapp_number' => '6281298765432',
                    ],
                ]),
            ],
            (object)[
                'title' => 'Budidaya Tanaman Hias',
                'description' => 'Sentra tanaman hias eksotis dan bunga potong kualitas ekspor.',
                'image' => 'https://source.unsplash.com/640x480/?flower,plant',
                'category' => 'budidaya-bunga',
                'products' => collect([
                    (object)[
                        'name' => 'Anggrek Bulan Ungu',
                        'description' => 'Anggrek lokal yang tahan lama dan cocok untuk dekorasi indoor.',
                        'image' => 'https://source.unsplash.com/160x160/?orchid,purple',
                        'whatsapp_number' => '6281122334455',
                    ],
                    (object)[
                        'name' => 'Paket Bonsai Mini',
                        'description' => 'Bonsai mini dengan pot estetik, cocok untuk meja kerja atau hadiah.',
                        'image' => 'https://source.unsplash.com/160x160/?bonsai,plant',
                        'whatsapp_number' => '6285566778899',
                    ],
                ]),
            ],
        ]);

        return view('potential', compact('potentials'));

    }
}


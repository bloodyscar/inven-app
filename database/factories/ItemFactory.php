<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                                'Laptop Lenovo',
                                'Kabel HDMI',
                                'Proyektor Epson',
                                'Meja Belajar',
                                'Kursi Kantor',
                                'Lemari Arsip',
                                'Whiteboard Magnetik',
                                'Printer Canon',
                                'Scanner Epson',
                                'Stabilizer Listrik',
                                'UPS APC',
                                'Speaker Logitech',
                                'Mouse Wireless',
                                'Keyboard Mechanical',
                                'Monitor LED 24 Inch',
                                'Mousepad XXL',
                                'Pulpen Gel',
                                'Pensil Mekanik',
                                'Stapler Besar',
                                'Kertas A4 80gsm',
                                'Kertas HVS F4',
                                'Amplop Coklat',
                                'Map Folder Plastik',
                                'Rak Buku',
                                'Rak Besi Gudang',
                                'Kabel LAN',
                                'Switch 8 Port',
                                'Router TP-Link',
                                'Access Point',
                                'Kamera CCTV',
                                'Gembok Stainless',
                                'Obeng Set',
                                'Tang Kombinasi',
                                'Mesin Bor',
                                'Senter LED',
                                'Lampu Meja',
                                'Stop Kontak',
                                'Kabel Roll',
                                'Tempat Sampah',
                                'Vacuum Cleaner',
                                'Mesin Fotokopi',
                                'AC Split Panasonic',
                                'Remote AC',
                                'Tisu Kantor',
                                'Dispenser Air',
                                'Galon Aqua',
                                'Lem Kertas',
                                'Kalkulator',
                                'Jam Dinding',
                                'Alat Tulis Lengkap'
                            ]),
            'category_id' => 1,
            'lokasi' => 'Gedung A',
            'quantity' => 1,
            'satuan' => 'pcs',
            'penerima' => 'Adit',
        ];
    }
}

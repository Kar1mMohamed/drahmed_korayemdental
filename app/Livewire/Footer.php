<?php

namespace App\Livewire;

use Livewire\Component;

class Footer extends Component
{
    public $clinics = [];

    public $contacts = [];

    public $currentYear;

    public function mount()
    {
        $this->currentYear = date('Y');

        $this->clinics = [
            [
                'name' => 'Alexandria Clinic',
                'clinic_name' => 'Korayem Dental clinic',
                'address' => '90 Fawzy Moaz Street, Sama El-Horreya Tower 1 First Floor. Smouha (Alexandria)',
                'map_url' => 'https://maps.app.goo.gl/2H5vXi2dorhDCjhq6',
                'whatsapp' => '201000081871',
                'note' => 'There is free parking for the center next to the American Mattress Center',
            ],
            [
                'name' => 'Cairo Clinic',
                'clinic_name' => 'Ultra Dental Care',
                'address' => 'Sheikh Zayed Branch – 5th Floor, Arkan Medical Tower, Gate 7, Arkan , Sheikh Zayed',
                'map_url' => 'https://maps.app.goo.gl/rfpcVxR8rGWa7xne9',
                'whatsapp' => '201116111135',
            ],
        ];

        $this->contacts = [
            [
                'type' => 'phone',
                'value' => '+201000081871',
                'display' => '+201000081871',
            ],
            [
                'type' => 'phone',
                'value' => '+201116111135',
                'display' => '+201116111135',
            ],
            [
                'type' => 'email',
                'value' => 'drkorayem@wellmarkeg.com',
                'display' => 'drkorayem@wellmarkeg.com',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.footer');
    }
}

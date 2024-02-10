function showStreets(selectedPurok) {
    const streets = {
        '1A': [
            'Santolan Street',
            'Santolan Extension',
            'Chico Street',
            'Mabolo Street',
            'Ariola Bridge',
            'Filtration Road (Left Side from Sta. Rita Bridge to Alfa Mart)'
        ],
        '1B': [
            'Avocado Street',
            'Avocado Extension',
            'Manggahan Street',
            'Manggahan Extension',
            'Filtration Road (Left Side after Alfa Mart to Corner of Manggahan Street)'
        ],
        '2': [
            'Cabling Street',
            'Rosa Gonzales Street',
            'Interior',
            'Corpus Compound',
            'Cabling Compound',
            'Filtration Road (Right Side from Sta. Rita Bridge to Winnies Bake Shop Sampaguita Road)',
            'Sta. Rita Road (One Way)'
        ],
        '3A': [
            'Begonia Street (Right Side from Dizon Junk Shop to Baptist Church)',
            'Camia Street (Right Side from Rodriguez Ice Plant to Delrosario Compound)',
            'Camia Street (Left Side from Baustista Compound to Gatchalian Store)'
        ],
        '3B': [
            'Filtration Road (Left Side going to Mabayuan)',
            'Amapola Street',
            'Camia Street',
            'Rosal Street',
            'Begonia Street'
        ],
        '3C': [
            'Horseshoe Drive',
            'Marikit Street',
            'Roselane',
            'Marilag Street',
            'Marilag Extension',
            'Adelfa 1',
            'Adelfa 2',
            'Filtration Road (Right Side from Corner of Horseshoe Drive to Corner of Mayumi)'
        ],
        '3E': [
            'Sampaguita Road (Left Side from Back of Sta Rita Parish to Corner of Azucena Street)',
            'Mahinhin Street',
            'Maganda Street',
            'Jasmin Street',
            'Azucena Street'
        ],
        '3F': [
            'Aries Street',
            'Jasmin Street',
            'Leo Street',
            'Leo Extension',
            'Libra Street',
            'Pisces Street',
            'Taurus Street',
            'Gemini Street',
            'Virgo Street',
            'Capricorn Street',
            'Aquarius Street',
            'Saguitarius Street'
        ],
        '4A': [
            'Whole of Sampaloc Compound',
            'Sta. Rita Road (Fronting Sampaguita Compound)'
        ],
        '4B': [
            'Sta. Rita Road (Right Side from 1087-1111)',
            'Clark Street',
            'Aglipay Church'
        ],
        '4C': [
            'Mercury Lane',
            'Mercury A & B Extension',
            'Mars Lane',
            'Venus Lane',
            'Sta. Rita Road (Left Side)',
            'Sampaguita Extension',
            'Alejo Street'
        ],
        '4D': [
            'Baltazar Street',
            'Soriano Street',
            'Cayabyab Street',
            'Back of Iglesia Ni Cristo',
            'Sta. Rita Road (Right Side from 1113-1158)'
        ],
        '5A': [
            'Balic-Balic Road (Right Side from Corner Tabacuhan to Corner Laban Street)',
            'Lunduyan Street',
            'Payapa Street'
        ],
        '5A-1': [
            'Whole of Sta. Rita Village (Block 1- Block 9)'
        ],
        '5B': [
            'Laban Street',
            'Dominguez Street (From 1683 to 1687)',
            'Waterdam Road (1672) Balic-Balic Road (From Corner Laban Street to Corner Dominguez Street)'
        ],
        '5C': [
            'Block 4',
            'Half of Dominguez Street',
            'Block 8 (Slaughter House)',
            'Block 12',
            'Block 13'
        ],
        '5D': [
            'From Block 14 to Block 23'
        ],
        '5E': [
            'From Block 24-Block 27'
        ],
        '5F': [
            'Block 27 Extension'
        ],
        '6A': [
            'Cristobal Street',
            'Trance Street',
            'Balimpuyo',
            'Part of Tabacuhan Road'
        ],
        '6AEXT': [
            'Tulio Street',
            'Delrosario Street',
            'Part of Tabacuhan Road'
        ],
        '6B1': [
            'Part of Tabacuhan Road',
            'Millionare Street',
            'Bigtime Street',
            'Calapati Compound (Beside Tabacuhan Elementary School)'
        ],
        '6B2': [
            'Part of Tabacuhan Road',
            'Tabacuhan Elementary School',
            'Magiting Street',
            'Del Rosario Street (Left Side)'
        ],
        '6C1': [
            'From 1466 Julo Tabacuhan to 1480 Julo Tabacuhan'
        ],
        '6C2': [
            'From 1482 Upper Julo to 1483 Upper Julo'
        ],
        '6D': [
            'Tabacuhan Extension',
            'Quiet Place',
            'Tinapahan Extension'
        ],
        '6E': [
            'Whole of Holy Spirit',
            'San Isidro Street',
            'San Pedro Street',
            'San Roque Street',
            'Holy Spirit Drive'
        ],
        '7': [
            'Upper Julo Tabacuhan'
        ]
    };

    const streetsDropdown = document.getElementById('streetsDropdown');

    // Disable the streets dropdown if no Purok is selected
    streetsDropdown.disabled = !selectedPurok;

    if (selectedPurok) {
        const selectedStreets = streets[selectedPurok];

        streetsDropdown.innerHTML = '';
        
        selectedStreets.forEach(street => {
            const option = document.createElement('option');
            option.value = street;
            option.text = street;
            streetsDropdown.appendChild(option);
        });
    } else {
        streetsDropdown.innerHTML = '<option value="" disabled selected>Select Street</option>';
    }
}

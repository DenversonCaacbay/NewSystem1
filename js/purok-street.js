
        function showStreets(selectedPurok) {
            const streets = {
                '1A': [
                    'SANTOLAN STREET',
                    'SANTOLAN EXTENSION',
                    'CHICO STREET',
                    'MABOLO STREET',
                    'ARIOLA BRIDGE',
                    'FILTRATION ROAD (LEFT SIDE FROM STA. RITA BRIDGE TO ALFA MART)'
                ],
                '1B': [
                    'AVOCADO STREET',
                    'AVOCADO EXTENSION',
                    'MANGGAHAN STREET',
                    'MANGGAHAN EXTENSION',
                    'FILTRATION ROAD (LEFT SIDE AFTER ALFA MART TO CORNER OF MANGGAHAN STREET)'
                ],
                '2': [
                    'CABLING STREET',
                    'ROSA GONZALES STREET',
                    'INTERIOR',
                    'CORPUZ COMPOUND',
                    'CABLING COMPOUND',
                    'FILTRATION ROAD (RIGHT SIDE FROM STA. RITA BRIDGE TO WINNIES BAKE SHOP SAMPAGUITA ROAD)',
                    'STA. RITA ROAD (ONE WAY)'
                ],
                '3A': [
                    'BEGONIA STREET (RIGHT SIDE FROM DIZON JUNK SHOP TO BAPTIST CHURCH)',
                    'CAMIA STREET (RIGHT SIDE FROM RODRIGUEZ ICE PLANT TO DELROSARIO COMPOUND)',
                    'CAMIA STREET (LEFT SIDE FROM BAUSTISTA COMPOUND TO GATCHALIAN STORE)'
                ],
                '3B': [
                    'FILTRATION ROAD (LEFT SIDE GOING TO MABAYUAN)',
                    'AMAPOLA STREET',
                    'CAMIA STREET',
                    'ROSAL STREET',
                    'BEGONIA STREET'
                ],
                '3C': [
                    'HORSESHOE DRIVE',
                    'MARIKIT STREET',
                    'ROSELANE',
                    'MARILAG STREET',
                    'MARILAG EXTENSION',
                    'ADELFA 1',
                    'ADELFA 2',
                    'FILTRATION ROAD (RIGHT SIDE FROM CORNER OF HORSESHOE DRIVE TO CORNENER OF MAYUMI)'
                ],
                '3E': [
                    'SAMPAGUITA ROAD (LEFT SIDE FROM BACK OF STA RITA PARISH TO CORNER OF AZUCENA STREET)',
                    'MAHINHIN STREET',
                    'MAGANDA STREET',
                    'JASMIN STREET',
                    'AZUCENA STREET'
                ],
                '3F': [
                    'ARIES STREET',
                    'JASMIN STREET',
                    'LEO STREET',
                    'LEO EXTENSION',
                    'LIBRA STREET',
                    'PISCES STREET',
                    'TAURUS STREET',
                    'GEMINI STREET',
                    'VIRGO STREET',
                    'CAPRICORN STREET',
                    'AQUARIUS STREET',
                    'SAGUITARIUS STREET'
                ],
                '4A': [
                    'WHOLE OF SAMPALOC COMPOUND',
                    'STA. RITA ROAD (FRONTING SAMPAGUITA COMPOUND)'
                ],
                '4B': [
                    'STA. RITA ROAD (RIGHT SIDE FROM 1087-1111)',
                    'CLARK STREET',
                    'AGLIPAY CHURCH'
                ],
                '4C': [
                    'MERCURY LANE',
                    'MERCURY A &B EXTENSION',
                    'MARS LANE',
                    'VENUS LANE',
                    'STA. RITA ROAD (LEFT SIDE)',
                    'SAMPAGUITA EXTENSION',
                    'ALEJO STREET'
                ],
                '4D': [
                    'BALTAZAR STREET',
                    'SORIANO STREET',
                    'CAYABYAB STREET',
                    'BACK OF IGLESIA NI CRISTO',
                    'STA. RITA ROAD (RIGHT SIDE FROM 1113-1158)'
                ],
                '5A': [
                    'BALIC-BALIC ROAD (RIGHT SIDE FROM CORNER TABACUHAN TO CORNER LABAN STREET)',
                    'LUNDUYAN STREET',
                    'PAYAPA STREET'
                ],
                '5A-1': [
                    'WHOLE OF STA. RITA VILLAGE (BLOCK 1- BLOCK 9)'
                ],
                '5B': [
                    'LABAN STREET',
                    'DOMINGUEZ STREET (FROM 1683 TO 1687)',
                    'WATERDAM ROAD (1672) BALIC-BALIC ROAD (FROM CORNER LABAN STREET TO CORNER DOMINGUEZ STREET'
                ],
                '5C': [
                    'BLOCK 4',
                    'HALF OF DOMINGUEZ STREET',
                    'BLOCK 8 (SLAUGHTER HOUSE)',
                    'BLOCK 12',
                    'BLOCK 13'
                ],
                '5D': [
                    'FROM BLOCK 14 TO BLOCK 23'
                ],
                '5E': [
                    'FROM BLOCK 24-BLOCK 27'
                ],
                '5F': [
                    'BLOCK 27 EXTENSION'
                ],
                '6A': [
                    'CRISTOBAL STREET',
                    'TRANCE STREET',
                    'BALIMPUYO',
                    'PART OF TABACUHAN ROAD'
                ],
                '6AEXT': [
                    'TULIO STREET',
                    'DELROSARIO STREET',
                    'PART OF TABACUHAN ROAD'
                ],
                '6B1': [
                    'PART OF TABACUHAN ROAD',
                    'MILLIONARE STREET',
                    'BIGTIME STREET',
                    'CALAPATI COMPOUND (BESIDE TABACUHAN ELEMENTARY SCHOOL)'
                ],
                '6B2': [
                    'PART OF TABACUHAN ROAD',
                    'TABACUHAN ELEMENTARY SCHOOL',
                    'MAGITING STREET',
                    'DEL ROSARIO STREET (LEFT SIDE)'
                ],
                '6C1': [
                    'FROM 1466 JULO TABACUHAN TO 1480 JULO TABACUHAN'
                ],
                '6C2': [
                    'FROM 1482 UPPER JULO TO 1483 UPPER JULO'
                ],
                '6D': [
                    'TABACUHAN EXTENSION',
                    'QUIET PLACE',
                    'TINAPAHAN EXTENSION'
                ],
                '6E': [
                    'WHOLE OF HOLY SPIRIT',
                    'SAN ISIDRO STREET',
                    'SAN PEDRO STREET',
                    'SAN ROQUE STREET',
                    'HOLY SPIRIT DRIVE'
                ],
                '7': [
                    'UPPER JULO TABACUHAN'
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

<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;

class SyncRegionCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daala:regions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Countries And Cities in Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $countriesWithCities = $this->getCountriesWithCitiesArray();
        foreach ($countriesWithCities as $countriesWithCity) {
            $citiesBuilder = Country::query()->firstOrCreate([
                'title' => $countriesWithCity->first()
            ])->cities();
            foreach ($countriesWithCity->last() as $city)
                $citiesBuilder->firstOrCreate($city);
        }
        $this->info('Done!');
        return 1;
    }

    protected function getCountriesWithCitiesArray()
    {
        return collect([
            collect([
                'Pakistan',
                'cities' => [
                    ['title' => 'Abbottabad'],
                    ['title' => 'Adezai'],
                    ['title' => 'Ali Bandar'],
                    ['title' => 'Amir Chah'],
                    ['title' => 'Attock'],
                    ['title' => 'Ayubia'],
                    ['title' => 'Bahawalpur'],
                    ['title' => 'Baden'],
                    ['title' => 'Bagh'],
                    ['title' => 'Bahawalnagar'],
                    ['title' => 'Burewala'],
                    ['title' => 'Banda Daud Shah'],
                    ['title' => 'Bannu district|Bannu'],
                    ['title' => 'Batagram'],
                    ['title' => 'Bazdar'],
                    ['title' => 'Bela'],
                    ['title' => 'Bellpat'],
                    ['title' => 'Bhag'],
                    ['title' => 'Bhakkar'],
                    ['title' => 'Bhalwal'],
                    ['title' => 'Bhimber'],
                    ['title' => 'Birote'],
                    ['title' => 'Buner'],
                    ['title' => 'Burj'],
                    ['title' => 'Chiniot'],
                    ['title' => 'Chachro'],
                    ['title' => 'Chagai'],
                    ['title' => 'Chah Sandan'],
                    ['title' => 'Chailianwala'],
                    ['title' => 'Chakdara'],
                    ['title' => 'Chakku'],
                    ['title' => 'Chakwal'],
                    ['title' => 'Chaman'],
                    ['title' => 'Charsadda'],
                    ['title' => 'Chhatr'],
                    ['title' => 'Chichawatni'],
                    ['title' => 'Chitral'],
                    ['title' => 'Dadu'],
                    ['title' => 'Dera Ghazi Khan'],
                    ['title' => 'Dera Ismail Khan'],
                    ['title' => 'Dalbandin'],
                    ['title' => 'Dargai'],
                    ['title' => 'Darya Khan'],
                    ['title' => 'Daska'],
                    ['title' => 'Dera Bugti'],
                    ['title' => 'Dhana Sar'],
                    ['title' => 'Digri'],
                    ['title' => 'Dina'],
                    ['title' => 'Dinga'],
                    ['title' => 'Diplo'],
                    ['title' => 'Diwana'],
                    ['title' => 'Dokri'],
                    ['title' => 'Drosh'],
                    ['title' => 'Duki'],
                    ['title' => 'Dushi'],
                    ['title' => 'Duzab'],
                    ['title' => 'Faisalabad'],
                    ['title' => 'Fateh Jang'],
                    ['title' => 'Ghotki'],
                    ['title' => 'Gwadar'],
                    ['title' => 'Gujranwala'],
                    ['title' => 'Gujrat'],
                    ['title' => 'Gadra'],
                    ['title' => 'Gajar'],
                    ['title' => 'Gandava'],
                    ['title' => 'Garhi Khairo'],
                    ['title' => 'Garruck'],
                    ['title' => 'Ghakhar Mandi'],
                    ['title' => 'Ghanian'],
                    ['title' => 'Ghauspur'],
                    ['title' => 'Ghazluna'],
                    ['title' => 'Girdan'],
                    ['title' => 'Gulistan'],
                    ['title' => 'Gwash'],
                    ['title' => 'Hyderabad'],
                    ['title' => 'Hala'],
                    ['title' => 'Haripur'],
                    ['title' => 'Hab Chauki'],
                    ['title' => 'Hafizabad'],
                    ['title' => 'Hameedabad'],
                    ['title' => 'Hangu'],
                    ['title' => 'Harnai'],
                    ['title' => 'Hasilpur'],
                    ['title' => 'Haveli Lakha'],
                    ['title' => 'Hinglaj'],
                    ['title' => 'Hoshab'],
                    ['title' => 'Islamabad'],
                    ['title' => 'Islamkot'],
                    ['title' => 'Ispikan'],
                    ['title' => 'Jacobabad'],
                    ['title' => 'Jamshoro'],
                    ['title' => 'Jhang'],
                    ['title' => 'Jhelum'],
                    ['title' => 'Jamesabad'],
                    ['title' => 'Jampur'],
                    ['title' => 'Janghar'],
                    ['title' => 'Jati(Mughalbhin)'],
                    ['title' => 'Jauharabad'],
                    ['title' => 'Jhal'],
                    ['title' => 'Jhal Jhao'],
                    ['title' => 'Jhatpat'],
                    ['title' => 'Jhudo'],
                    ['title' => 'Jiwani'],
                    ['title' => 'Jungshahi'],
                    ['title' => 'Karachi'],
                    ['title' => 'Kotri'],
                    ['title' => 'Kalam'],
                    ['title' => 'Kalandi'],
                    ['title' => 'Kalat'],
                    ['title' => 'Kamalia'],
                    ['title' => 'Kamararod'],
                    ['title' => 'Kamber'],
                    ['title' => 'Kamokey'],
                    ['title' => 'Kanak'],
                    ['title' => 'Kandi'],
                    ['title' => 'Kandiaro'],
                    ['title' => 'Kanpur'],
                    ['title' => 'Kapip'],
                    ['title' => 'Kappar'],
                    ['title' => 'Karak City'],
                    ['title' => 'Karodi'],
                    ['title' => 'Kashmor'],
                    ['title' => 'Kasur'],
                    ['title' => 'Katuri'],
                    ['title' => 'Keti Bandar'],
                    ['title' => 'Khairpur'],
                    ['title' => 'Khanaspur'],
                    ['title' => 'Khanewal'],
                    ['title' => 'Kharan'],
                    ['title' => 'kharian'],
                    ['title' => 'Khokhropur'],
                    ['title' => 'Khora'],
                    ['title' => 'Khushab'],
                    ['title' => 'Khuzdar'],
                    ['title' => 'Kikki'],
                    ['title' => 'Klupro'],
                    ['title' => 'Kohan'],
                    ['title' => 'Kohat'],
                    ['title' => 'Kohistan'],
                    ['title' => 'Kohlu'],
                    ['title' => 'Korak'],
                    ['title' => 'Korangi'],
                    ['title' => 'Kot Sarae'],
                    ['title' => 'Kotli'],
                    ['title' => 'Lahore'],
                    ['title' => 'Larkana'],
                    ['title' => 'Lahri'],
                    ['title' => 'Lakki Marwat'],
                    ['title' => 'Lasbela'],
                    ['title' => 'Latamber'],
                    ['title' => 'Layyah'],
                    ['title' => 'Leiah'],
                    ['title' => 'Liari'],
                    ['title' => 'Lodhran'],
                    ['title' => 'Loralai'],
                    ['title' => 'Lower Dir'],
                    ['title' => 'Shadan Lund'],
                    ['title' => 'Multan'],
                    ['title' => 'Mandi Bahauddin'],
                    ['title' => 'Mansehra'],
                    ['title' => 'Mian Chanu'],
                    ['title' => 'Mirpur'],
                    ['title' => 'Moro'],
                    ['title' => 'Mardan'],
                    ['title' => 'Mach'],
                    ['title' => 'Madyan'],
                    ['title' => 'Malakand'],
                    ['title' => 'Mand'],
                    ['title' => 'Manguchar'],
                    ['title' => 'Mashki Chah'],
                    ['title' => 'Maslti'],
                    ['title' => 'Mastuj'],
                    ['title' => 'Mastung'],
                    ['title' => 'Mathi'],
                    ['title' => 'Matiari'],
                    ['title' => 'Mehar'],
                    ['title' => 'Mekhtar'],
                    ['title' => 'Merui'],
                    ['title' => 'Mianwali'],
                    ['title' => 'Mianez'],
                    ['title' => 'Mirpur Batoro'],
                    ['title' => 'Mirpur Khas'],
                    ['title' => 'Mirpur Sakro'],
                    ['title' => 'Mithi'],
                    ['title' => 'Mongora'],
                    ['title' => 'Murgha Kibzai'],
                    ['title' => 'Muridke'],
                    ['title' => 'Musa Khel Bazar'],
                    ['title' => 'Muzaffar Garh'],
                    ['title' => 'Muzaffarabad'],
                    ['title' => 'Nawabshah'],
                    ['title' => 'Nazimabad'],
                    ['title' => 'Nowshera'],
                    ['title' => 'Nagar Parkar'],
                    ['title' => 'Nagha Kalat'],
                    ['title' => 'Nal'],
                    ['title' => 'Naokot'],
                    ['title' => 'Nasirabad'],
                    ['title' => 'Nauroz Kalat'],
                    ['title' => 'Naushara'],
                    ['title' => 'Nur Gamma'],
                    ['title' => 'Nushki'],
                    ['title' => 'Nuttal'],
                    ['title' => 'Okara'],
                    ['title' => 'Ormara'],
                    ['title' => 'Peshawar'],
                    ['title' => 'Panjgur'],
                    ['title' => 'Pasni City'],
                    ['title' => 'Paharpur'],
                    ['title' => 'Palantuk'],
                    ['title' => 'Pendoo'],
                    ['title' => 'Piharak'],
                    ['title' => 'Pirmahal'],
                    ['title' => 'Pishin'],
                    ['title' => 'Plandri'],
                    ['title' => 'Pokran'],
                    ['title' => 'Pounch'],
                    ['title' => 'Quetta'],
                    ['title' => 'Qambar'],
                    ['title' => 'Qamruddin Karez'],
                    ['title' => 'Qazi Ahmad'],
                    ['title' => 'Qila Abdullah'],
                    ['title' => 'Qila Ladgasht'],
                    ['title' => 'Qila Safed'],
                    ['title' => 'Qila Saifullah'],
                    ['title' => 'Rawalpindi'],
                    ['title' => 'Rabwah'],
                    ['title' => 'Rahim Yar Khan'],
                    ['title' => 'Rajan Pur'],
                    ['title' => 'Rakhni'],
                    ['title' => 'Ranipur'],
                    ['title' => 'Ratodero'],
                    ['title' => 'Rawalakot'],
                    ['title' => 'Renala Khurd'],
                    ['title' => 'Robat Thana'],
                    ['title' => 'Rodkhan'],
                    ['title' => 'Rohri'],
                    ['title' => 'Sialkot'],
                    ['title' => 'Sadiqabad'],
                    ['title' => 'Safdar Abad- (Dhaban Singh)'],
                    ['title' => 'Sahiwal'],
                    ['title' => 'Saidu Sharif'],
                    ['title' => 'Saindak'],
                    ['title' => 'Sakrand'],
                    ['title' => 'Sanjawi'],
                    ['title' => 'Sargodha'],
                    ['title' => 'Saruna'],
                    ['title' => 'Shabaz Kalat'],
                    ['title' => 'Shadadkhot'],
                    ['title' => 'Shahbandar'],
                    ['title' => 'Shahpur'],
                    ['title' => 'Shahpur Chakar'],
                    ['title' => 'Shakargarh'],
                    ['title' => 'Shangla'],
                    ['title' => 'Sharam Jogizai'],
                    ['title' => 'Sheikhupura'],
                    ['title' => 'Shikarpur'],
                    ['title' => 'Shingar'],
                    ['title' => 'Shorap'],
                    ['title' => 'Sibi'],
                    ['title' => 'Sohawa'],
                    ['title' => 'Sonmiani'],
                    ['title' => 'Sooianwala'],
                    ['title' => 'Spezand'],
                    ['title' => 'Spintangi'],
                    ['title' => 'Sui'],
                    ['title' => 'Sujawal'],
                    ['title' => 'Sukkur'],
                    ['title' => 'Suntsar'],
                    ['title' => 'Surab'],
                    ['title' => 'Swabi'],
                    ['title' => 'Swat'],
                    ['title' => 'Tando Adam'],
                    ['title' => 'Tando Bago'],
                    ['title' => 'Tangi'],
                    ['title' => 'Tank City'],
                    ['title' => 'Tar Ahamd Rind'],
                    ['title' => 'Thalo'],
                    ['title' => 'Thatta'],
                    ['title' => 'Toba Tek Singh'],
                    ['title' => 'Tordher'],
                    ['title' => 'Tujal'],
                    ['title' => 'Tump'],
                    ['title' => 'Turbat'],
                    ['title' => 'Umarao'],
                    ['title' => 'Umarkot'],
                    ['title' => 'Upper Dir'],
                    ['title' => 'Uthal'],
                    ['title' => 'Vehari'],
                    ['title' => 'Veirwaro'],
                    ['title' => 'Vitakri'],
                    ['title' => 'Wadh'],
                    ['title' => 'Wah Cantt'],
                    ['title' => 'Warah'],
                    ['title' => 'Washap'],
                    ['title' => 'Wasjuk'],
                    ['title' => 'Wazirabad'],
                    ['title' => 'Yakmach'],
                    ['title' => 'Zhob'],
                ]
            ])
        ]);
    }

}
<?php

namespace Database\Factories;

use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Passenger>
 */
class PassengerFactory extends Factory
{
    protected $model = \App\Models\Passenger::class;

    // Predefined list of labels
    protected static $labels = [
        'hsalihee', 'miourjdi', 'mmoulabbi', 'richouan', 'sakacmi', 'aelhadda',
        'ahssaini', 'anasbai', 'aotchoun', 'aouchcha', 'asadik', 'blakraid',
        'hmaach', 'hboutale', 'helazzou', 'hhouda', 'hkhlifi', 'hkouki',
        'hlamrani', 'houhamou', 'houtaib', 'iafriad', 'iatlassi', 'ibentour',
        'ielharra', 'ifoukahi', 'iichi', 'ilazaar', 'arabya', 'asaadane',
        'asaaoud', 'asadiqui', 'asebbar', 'asoudri', 'azerrouk', 'babdelil',
        'bbenskou', 'bdaanoun', 'belmaayo', 'ekerzazi', 'fennadaf', 'hadaoud',
        'aelabsi', 'aelidris', 'aelmalki', 'aesslima', 'afethi', 'ahabchi',
        'ahiti', 'ajabbour', 'ajebbari', 'alahmami', 'alaidi', 'alouhab',
        'amahfoud', 'amalki', 'amargoum', 'amazighi', 'zsalhi', 'aachbaro',
        'aaitbihi', 'aammar', 'abelbach', 'abenramd', 'aberhili', 'abouachani',
        'abouchik', 'aboutamgh', 'abouziani', 'adraoui', 'ikazbat', 'kelamrani',
        'mbakhcha', 'mbakhouc', 'mlbahja', 'mmihit', 'mouchkhi', 'ndieye',
        'saljaoui', 'yakhaldy', 'yaouzddou', 'yhajjaou', 'ykharkha', 'ynaitedd',
        'zabdelal', 'izahid', 'jbajady', 'kelali', 'kidbouho', 'ktrichin',
        'maadou', 'matmani', 'maynaou', 'mboutaba', 'mcheddad', 'mdinani',
        'melalj', 'melbachi', 'melfihrty', 'meljanat', 'mfadil', 'mfakiri',
        'mfir', 'mghdaigu', 'mkissi', 'mojebbari', 'mrhioui', 'msalmi',
        'mtawil', 'mtouzani', 'oaitbenh', 'oamyay', 'oanass', 'oatmani',
        'obenali', 'ochouari', 'oelhaouc', 'omrharbl', 'oqritel', 'oyoussef',
        'rachnit', 'rgourmat', 'rmohamme', 'rserraf', 'saayady', 'sbeytour',
        'selasly', 'soelwalid', 'sohachimi', 'timadmar', 'wjeglaou', 'wzouguag',
        'ybahbib', 'ybasta', 'ybouhadi', 'yelmach', 'yfaris', 'yhamdoun',
        'yhayyani', 'yhoussal', 'yhrouk', 'yjaouhar', 'yolaidi', 'yomari',
        'yassinerahhaoui', 'zack9097', 'zakaria0239', 'ziadchoukri', 'z4ydz',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Pick a random label from the list and ensure it's unique
        $label = Arr::random(self::$labels);
        
        // Return the array with the route_id and label
        return [
            'route_id' => Route::factory(), // Create a related Route model
            'label' => $label,
        ];
    }
}

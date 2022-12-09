<?php
// Подключение Faker (загружен через composer)
require "./composer/vendor/autoload.php";


use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;


$faker = Faker\Factory::create('en_EN');
$users = [];
for ($j = 0; $j < 25; $j++)
{
    $users[] = [
        'firstName' => $faker->firstName,
        'login' => $faker->userName,
        'email' => $faker->email,
        'password' => $faker->password,
        'country' => $faker->country,
        'title' => $faker->title

    ];
}

$users_json = json_encode($users, JSON_PRETTY_PRINT);
file_put_contents('./practic6_data/fake_users.json', $users_json);


function Statistic($array, $arg1, $arg2): Int{
    $count = 0;
    foreach ($array as $key=>$value) {
        if ($value [$arg1] == $arg2) {
            $count++;
        }
    }
    return $count;
}

function BarGraph($array):string{
    $path = './practic6_data/bar_graph.png';
    //We need some data
    $datay = [
        Statistic($array, 'title', 'Mr.'),
        Statistic($array, 'title', 'Mrs.'),
        Statistic($array, 'title', 'Prof.'),
        Statistic($array, 'title', 'Dr.'),
        Statistic($array, 'title', 'Miss')
    ];

    $datax = ['Mr.', 'Mrs', 'Prof.', 'Dr.', 'Miss.'];

// Set up the graph.
    $__width  = 800;
    $__height = 340;
    $graph    = new Graph\Graph($__width, $__height);
    $graph->img->SetMargin(60, 20, 35, 75);
    $graph->SetScale('textlin');
    $graph->SetMarginColor('lightblue:1.1');
    $graph->SetShadow();

// Set up the title for the graph
    $graph->title->Set('Popularity of abbreviations');
    $graph->title->SetMargin(14);
    $graph->title->SetFont(FF_VERDANA, FS_NORMAL, 14);

// Setup font for axis
    $graph->xaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);
    $graph->yaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);

// Show 0 label on Y-axis (default is not to show)
    $graph->yscale->ticks->SupressZeroLabel(false);

// Setup X-axis labels
    $graph->xaxis->SetTickLabels($datax);
    $graph->xaxis->SetLabelAngle(50);

// Create the bar pot
    $bplot = new Plot\BarPlot($datay);
    $bplot->SetWidth(0.6);



// Set color for the frame of each bar
    $bplot->SetColor('white');
    $graph->Add($bplot);
// Finally send the graph

    $graph->Stroke($path);
    return $path;
}

function PieGraph($array):string{
    $path = './practic6_data/pie_graph.png';
    $data = [
        Statistic($array, 'title', 'Mr.'),
        Statistic($array, 'title', 'Mrs.'),
        Statistic($array, 'title', 'Prof.'),
        Statistic($array, 'title', 'Dr.'),
        Statistic($array, 'title', 'Miss')
    ];

    // Create the Pie Graph.
    $__width  = 650;
    $__height = 400;
    $graph    = new Graph\PieGraph($__width, $__height);
    $graph->SetShadow();

// Set A title for the plot
    $graph->title->Set('Example 4 3D Pie plot');
    $graph->title->SetFont(FF_VERDANA, FS_BOLD, 18);
    $graph->title->SetColor('darkblue');
    $graph->legend->Pos(0.1, 0.2);

// Create 3D pie plot
    $p1 = new Plot\PiePlot3D($data);
    $p1->SetTheme('sand');
    $p1->SetCenter(0.4);
    $p1->SetSize(250);

// Adjust projection angle
    $p1->SetAngle(45);

// Adjsut angle for first slice
    $p1->SetStartAngle(45);

// As a shortcut you can easily explode one numbered slice with
    $p1->ExplodeSlice(3);

// Setup slice values
    $p1->value->SetFont(FF_ARIAL, FS_BOLD, 11);
    $p1->value->SetColor('navy');

    $p1->SetLegends(['Mr.', 'Mrs.', 'Prof.', 'Dr.', 'Miss']);

    $graph->Add($p1);

    $graph->Stroke($path);
    return $path;
}

function LineGraph($array):string{
    $path = './practic6_data/line_graph.png';
    $datay1 = [
        Statistic($array, 'title', 'Mr.'),
        Statistic($array, 'title', 'Mrs.'),
        Statistic($array, 'title', 'Prof.'),
        Statistic($array, 'title', 'Dr.'),
        Statistic($array, 'title', 'Miss')
    ];

    $datay2 = [
        Statistic($array, 'country', 'Mexico'),
        Statistic($array, 'country', 'Argentina'),
        Statistic($array, 'country', 'Botswana'),
        Statistic($array, 'country', 'Dominica'),
        Statistic($array, 'country', 'Netherlands')
    ];



// Setup the graph
    $__width  = 650;
    $__height = 400;
    $graph    = new Graph\Graph($__width, $__height);
    $graph->SetMargin(30, 20, 60, 100);
    $graph->SetMarginColor('white');
    $graph->SetScale('linlin');

// Hide the frame around the graph
    $graph->SetFrame(false);

// Setup title
    $graph->title->Set('Using Builtin PlotMarks');
    $graph->title->SetFont(FF_VERDANA, FS_BOLD, 14);

// Note: requires jpgraph 1.12p or higher
// $graph->SetBackgroundGradient('blue','navy:0.5',GRAD_HOR,BGRAD_PLOT);
    $graph->tabtitle->Set('Region 1');
    $graph->tabtitle->SetWidth(TABTITLE_WIDTHFULL);
    $graph->tabtitle->SetColor('white', 'black');

// Enable X and Y Grid
    $graph->xgrid->Show();
    $graph->xgrid->SetColor('gray@0.5');
    $graph->ygrid->SetColor('gray@0.5');

// Format the legend box
    $graph->legend->SetColor('black');
    $graph->legend->SetLineWeight(1);
    $graph->legend->SetFont(FF_ARIAL, FS_BOLD, 8);
    $graph->legend->SetShadow('gray@0.4', 3);
    $graph->legend->SetAbsPos(15, 120, 'right', 'bottom');

// Create the line plots

    $p1 = new Plot\LinePlot($datay1);
    $p1->SetColor('red');
    $p1->SetFillColor('black@0.5');
    $p1->SetWeight(1);
    $p1->mark->SetType(MARK_IMG_DIAMOND, 5, 0.6);
    $p1->SetLegend('Title');
    $graph->Add($p1);

    $p2 = new Plot\LinePlot($datay2);
    $p2->SetWeight(2);
    $p2->SetLegend('Country');
    $p2->mark->SetType(MARK_IMG_MBALL, 'red');
    $graph->Add($p2);

// Add a vertical line at the end scale position '7'
    $l1 = new Plot\PlotLine(VERTICAL, 7);
    $graph->Add($l1);

// Output the graph
    $graph->Stroke($path);
    return $path;
}

function BgGraph($array):string{

    $path = './practic6_data/bg_graph.png';
    $ydata = [
        Statistic($array, 'title', 'Mr.'),
        Statistic($array, 'title', 'Mrs.'),
        Statistic($array, 'title', 'Prof.'),
        Statistic($array, 'title', 'Dr.'),
        Statistic($array, 'title', 'Miss')
    ];

// Create the graph. These two calls are always required
    $__width  = 750;
    $__height = 650;
    $graph    = new Graph\Graph($__width, $__height);
    $graph->SetScale('textlin');

    $graph->ygrid->SetFill(false); // Прозрачнось
    $graph->SetBox(true);

// Steup graph titles
    $graph->title->SetFont(FF_ARIAL, FS_BOLD, 12);
    $graph->title->Set('Using background image');
    $graph->subtitle->SetFont(FF_COURIER, FS_BOLD, 11);
    $graph->subtitle->SetColor('darkred');


    $flag = mt_rand(0,1);
// Add background with 25% mix
    if ($flag == 0){
        $graph->SetBackgroundImage(__DIR__ . '/practic6_data/1.jpeg', BGIMG_FILLPLOT);
    }
    else{
        $graph->SetBackgroundImage(__DIR__ . '/practic6_data/2.jpeg', BGIMG_FILLPLOT);
    }
    $graph->SetBackgroundImageMix(25);

// Create the linear plot
    $lineplot = new Plot\LinePlot($ydata);
    $lineplot->SetColor('blue');

// Add the plot to the graph
    $graph->Add($lineplot);

// Display the graph
    $graph->Stroke($path);
    return $path;
}

function Watermark($src, $name):void{
    $watermark_src = './practic6_data/watermark.png';
    $opacity = 15;

    $image = imagecreatefrompng($src);
    $watermark = imagecreatefrompng($watermark_src);
    $watermark = imagescale($watermark , 100, 100);

    list($image_width, $image_height) = getimagesize($src);
    list($watermark_width, $watermark_height) = getimagesize($watermark_src);

    imagecopymerge($image, $watermark, 0, 0, 0, 0, $watermark_width, $watermark_height, $opacity);

    imagejpeg($image, './practic6_data/'.$name.'.png', 100);
    imagedestroy($image);
    imagedestroy($watermark);
}

//BarGraph($users);
//PieGraph($users);
//LineGraph($users);
//BgGraph($users);

Watermark(BarGraph($users), 'bar_graph');
Watermark(PieGraph($users), 'pie_graph');
Watermark(LineGraph($users), 'line_graph');
Watermark(BgGraph($users), 'bg_graph');
?>


<pre>
<?php print_r(json_decode(json_encode($users), true));
?>
</pre>



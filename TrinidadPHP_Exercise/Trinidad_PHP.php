<?php
$selected_exercise = $_GET['exercise'] ?? 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Exercises</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        nav { background: #f0f0f0; padding: 10px; margin-bottom: 20px; }
        nav a { margin-right: 10px; text-decoration: none; color: blue; }
        nav a.active { font-weight: bold; color: red; }
        form { margin-bottom: 20px; }
        label { display: block; margin: 5px 0; }
        input, select, button { margin: 5px; padding: 5px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .error { color: red; }
        .results { background: #e8f5e8; padding: 10px; border: 1px solid #ccc; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>PHP Exercises</h1>
    <nav>
        <?php for ($i = 1; $i <= 12; $i++): ?>
            <a href="?exercise=<?php echo $i; ?>" <?php echo ($selected_exercise == $i) ? 'class="active"' : ''; ?>>
                activity <?php echo $i; ?>
            </a>
        <?php endfor; ?>
    </nav>
    <?php    
//activity 1
    if ($selected_exercise == 1) {
        $results = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name'] ?? '');
            $birth_year = (int)($_POST['birth_year'] ?? 0);
            $favorite_color = trim($_POST['favorite_color'] ?? '');
            $hobbies_input = trim($_POST['hobbies'] ?? '');
            if (empty($name) || empty($favorite_color) || $birth_year <= 1900 || $birth_year > (int)date('Y')) {
                $results = '<p class="error">Please fill all fields correctly (birth year between 1900 and current year).</p>';
            } else {
                $age = date('Y') - $birth_year;
                $hobbies = array_map('trim', explode(',', $hobbies_input));
                $hobby_list = implode(", ", $hobbies);
                $results = '<div class="results"><p>Hi, I’m ' . htmlspecialchars($name) . '. I am ' . $age . ' years old (born in ' . $birth_year . '), and my favorite color is ' . htmlspecialchars($favorite_color) . '. In my free time, I enjoy ' . $hobby_list . '.</p></div>';
            }
        }
        echo '<h2>1. Introduce Yourself</h2>';
        echo '<form method="POST">';
        echo '<label>Name: <input type="text" name="name" value="' . ($_POST['name'] ?? '') . '" required></label>';
        echo '<label>Birth Year: <input type="number" name="birth_year" min="1900" max="' . date('Y') . '" value="' . ($_POST['birth_year'] ?? '') . '" required></label>';
        echo '<label>Favorite Color: <input type="text" name="favorite_color" value="' . ($_POST['favorite_color'] ?? '') . '" required></label>';
        echo '<label>Hobbies (comma-separated): <input type="text" name="hobbies" placeholder="e.g., reading, hiking" value="' . ($_POST['hobbies'] ?? '') . '" required></label>';
        echo '<button type="submit">Introduce!</button>';
        echo '</form>';
        echo $results;
    }
// activity 2
    elseif ($selected_exercise == 2) {
        $results = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $a = (float)($_POST['a'] ?? 0);
            $b = (float)($_POST['b'] ?? 0);
            
            if (!is_numeric($a) || !is_numeric($b)) {
                $results = '<p class="error">please enter valid numbers.</p>';
            } elseif ($b == 0) {
                $results = '<p class="error">cannot divide by zero.</p>';
            } else {
                $sum = $a + $b;
                $difference = $a - $b;
                $product = $a * $b;
                $quotient = $a / $b;                
                $results = '<div class="results"><h3>Math Operations for a=' . $a . ' and b=' . $b . ':</h3>
                            <table>
                                <tr><th>Operation</th><th>Result</th></tr>
                                <tr><td>Sum</td><td>' . $sum . '</td></tr>
                                <tr><td>Difference</td><td>' . $difference . '</td></tr>
                                <tr><td>Product</td><td>' . $product . '</td></tr>
                                <tr><td>Quotient</td><td>' . $quotient . '</td></tr>
                            </table></div>';
            }
        }
        echo '<h2>2. simple math</h2>';
        echo '<form method="POST">';
        echo '<label>Number A: <input type="number" step="0.01" name="a" value="' . ($_POST['a'] ?? '') . '" required></label>';
        echo '<label>Number B: <input type="number" step="0.01" name="b" value="' . ($_POST['b'] ?? '') . '" required></label>';
        echo '<button type="submit">Calculate</button>';
        echo '</form>';
        echo $results;
    }
//activity 3
    elseif ($selected_exercise == 3) {
        $results = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $length = (float)($_POST['length'] ?? 0);
            $width = (float)($_POST['width'] ?? 0);
            $shape_type = trim($_POST['shape_type'] ?? 'Rectangle');
            
            if ($length <= 0 || $width <= 0) {
                $results = '<p class="error">length and width must be positive.</p>';
            } else {
                $area = $length * $width;
                $perimeter = 2 * ($length + $width);
                $diagonal = sqrt($length**2 + $width**2);
                $results = '<div class="results"><h3>Rectangle Details for "' . htmlspecialchars($shape_type) . '":</h3>
                            <p>length: ' . $length . 'm, Width: ' . $width . 'm</p>
                            <p>area: ' . $area . ' square meters</p>
                            <p>perimeter: ' . $perimeter . ' meters</p>
                            <p>diagonal: ' . round($diagonal, 2) . ' meters</p></div>';
            }
        }
        echo '<h2>3. Area and Perimeter of a Rectangle</h2>';
        echo '<form method="POST">';
        echo '<label>Length (m): <input type="number" step="0.01" name="length" value="' . ($_POST['length'] ?? '') . '" required></label>';
        echo '<label>Width (m): <input type="number" step="0.01" name="width" value="' . ($_POST['width'] ?? '') . '" required></label>';
        echo '<label>Shape Type: <input type="text" name="shape_type" placeholder="e.g., Living Room" value="' . ($_POST['shape_type'] ?? '') . '" required></label>';
        echo '<button type="submit">Calculate</button>';
        echo '</form>';
        echo $results;
    }
//activity 4
    elseif ($selected_exercise == 4) {
        $results = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input_temp = (float)($_POST['temp'] ?? 0);
            $input_scale = $_POST['scale'] ?? 'C';
            
            if (!is_numeric($input_temp)) {
                $results = '<p class="error">please enter a valid temperature.</p>';
            } else {
                if ($input_scale == "C") {
                    $fahrenheit = ($input_temp * 9 / 5) + 32;
                    $desc = ($input_temp < 0) ? "Freezing" : (($input_temp < 20) ? "Cool" : (($input_temp < 30) ? "its an ayt" : "hot"));
                    $results = '<div class="results"><p>' . $input_temp . '°C = ' . round($fahrenheit, 2) . '°F (' . $desc . ' day!)</p></div>';
                } else {
                    $celsius = ($input_temp - 32) * 5 / 9;
                    $desc = ($input_temp < 32) ? "Freezing" : (($input_temp < 68) ? "Cool" : (($input_temp < 86) ? "its an ayt" : "hot"));
                    $results = '<div class="results"><p>' . $input_temp . '°F = ' . round($celsius, 2) . '°C (' . $desc . ' day)</p></div>';
                }
            }
        }
        echo '<h2>4. temp converter</h2>';
        echo '<form method="POST">';
        echo '<label>Temperature: <input type="number" step="0.01" name="temp" value="' . ($_POST['temp'] ?? '') . '" required></label>';
        echo '<label>Scale: <select name="scale" required><option value="C" ' . (($_POST['scale'] ?? '') == 'C' ? 'selected' : '') . '>Celsius</option><option value="F" ' . (($_POST['scale'] ?? '') == 'F' ? 'selected' : '') . '>Fahrenheit</option></select></label>';
        echo '<button type="submit">Convert</button>';
        echo '</form>';
        echo $results;
    }
//activity 5
    elseif ($selected_exercise == 5) {
        $x = 10;
        $y = 20;
        echo "Before swap: x = $x, y = $y\n";
        $temp = $x;
        $x = $y;
        $y = $temp;
        echo "After swap: x = $x, y = $y\n";
    }
//activity 6
    elseif ($selected_exercise == 6) {
        $basic_salary = 50000;
        $allowance = 10000;
        $deduction = 5000;
        $net_salary = $basic_salary + $allowance - $deduction;
echo "Net Salary: $$net_salary\n";
    }
//activity 7
    elseif ($selected_exercise == 7) {
        $results = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $weight = floatval($_POST['weight'] ?? 0);
            $height = floatval($_POST['height'] ?? 0);
            
            if ($weight <= 0 || $height <= 0) {
                $results = '<p class="error">Error: Weight and height must be positive.</p>';
            } else {
                $bmi = $weight / ($height * $height);
                $rounded_bmi = round($bmi, 2);
                if ($rounded_bmi < 18.5) $category = "Underweight";
                elseif ($rounded_bmi < 25) $category = "Normal";
                elseif ($rounded_bmi < 30) $category = "Overweight";
                else $category = "Obese";
                
                $results = '<div class="results"><p>BMI: ' . $rounded_bmi . ' (' . $category . ')</p>
                <p>Weight: ' . $weight . ' kg, Height: ' . $height . ' m</p></div>';
            }
        }
        echo '<h2>7. BMI Calculator</h2>';
        echo '<form method="POST">';
        echo '<label>Weight (kg): <input type="number" step="0.01" name="weight" value="' . ($_POST['weight'] ?? '70') . '" required></label>';
        echo '<label>Height (m): <input type="number" step="0.01" name="height" value="' . ($_POST['height'] ?? '1.75') . '" required></label>';
        echo '<button type="submit">Calculate BMI</button>';
        echo '</form>';
        echo $results;
    }
//activity 8
elseif ($selected_exercise == 8) {
        $results = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sentence = trim($_POST['sentence'] ?? '');
            if (empty($sentence)) {
                $results = '<p class="error">Please enter a sentence.</p>';
            } else {
                $char_count = strlen($sentence);
                $word_count = str_word_count($sentence);
                $upper = strtoupper($sentence);
                $lower = strtolower($sentence);
                $reversed = strrev($sentence);
                $results = '<div class="results"><table>
                    <tr><th>Property</th><th>Value</th></tr>
                    <tr><td>Original</td><td>' . htmlspecialchars($sentence) . '</td></tr>
                    <tr><td>Characters</td><td>' . $char_count . '</td></tr>
                    <tr><td>Words</td><td>' . $word_count . '</td></tr>
                    <tr><td>Uppercase</td><td>' . htmlspecialchars($upper) . '</td></tr>
                    <tr><td>Lowercase</td><td>' . htmlspecialchars($lower) . '</td></tr>
                    <tr><td>Reversed</td><td>' . htmlspecialchars($reversed) . '</td></tr>
                </table></div>';
            }
        }
        echo '<h2>8. String Manipulation</h2>';
        echo '<form method="POST">';
        echo '<label>Sentence: <input type="text" name="sentence" style="width: 300px;" value="' . ($_POST['sentence'] ?? 'Hello World') . '" required></label>';
        echo '<button type="submit">Analyze</button>';
        echo '</form>';
        echo $results;
    }
//activity 9
elseif ($selected_exercise == 9) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $bal = $_POST['balance']; $dep = $_POST['deposit']; $with = $_POST['withdraw'];
        if ($bal < 0 || $dep < 0 || $with < 0) $res = '<p class="error">No negatives please.</p>';
        elseif ($with > $bal + $dep) $res = '<p class="error">Insufficient funds.</p>';
        else $res = '<div class="results"><p>New Balance: ₱' . number_format($bal + $dep - $with, 2) . '</p></div>';
    }
    echo '<h2>9. Bank Account Simulation</h2>
    <form method="POST">
    <input type="number" name="balance" placeholder="Balance" value="' . ($_POST['balance'] ?? 1000) . '" required>
    <input type="number" name="deposit" placeholder="Deposit" value="' . ($_POST['deposit'] ?? 0) . '" required>
    <input type="number" name="withdraw" placeholder="Withdraw" value="' . ($_POST['withdraw'] ?? 0) . '" required>
    <button>Update</button></form>' . ($res ?? '');
}
//activity 10
elseif ($selected_exercise == 10) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $m=$_POST['math']; $e=$_POST['english']; $s=$_POST['science'];
        if (min($m,$e,$s)<0 || max($m,$e,$s)>100) $res='<p class="error">0–100 only.</p>';
        else {
            $avg=($m+$e+$s)/3;
            $grade = $avg>=90?'A':($avg>=80?'B':($avg>=70?'C':($avg>=60?'D':'F')));
            $res='<div class="results"><p>Average: '.round($avg,2).' — Grade '.$grade.'</p></div>';
        }
    }
    echo '<h2>10. Simple Grading System</h2>
    <form method="POST">
    <input type="number" name="math" placeholder="Math" required>
    <input type="number" name="english" placeholder="English" required>
    <input type="number" name="science" placeholder="Science" required>
    <button>Compute</button></form>' . ($res ?? '');
}
//activity 11
elseif ($selected_exercise == 11) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $amt=$_POST['amount']; $cur=$_POST['currency'];
        $rates=['USD'=>0.018,'EUR'=>0.017,'JPY'=>2.65];
        if ($amt<=0) $res='<p class="error">Enter a positive amount.</p>';
        else $res='<div class="results"><p>₱'.number_format($amt,2).' = '.($cur=='JPY'?'¥':($cur=='EUR'?'€':'$')).number_format($amt*$rates[$cur],2).' '.$cur.'</p></div>';
    }
    echo '<h2>11. Currency Converter</h2>
    <form method="POST">
    <input type="number" name="amount" placeholder="PHP Amount" value="' . ($_POST['amount'] ?? 1000) . '" required>
    <select name="currency">
        <option>USD</option><option>EUR</option><option>JPY</option>
    </select>
    <button>Convert</button></form>' . ($res ?? '');
}

//activity 12
elseif ($selected_exercise == 12) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $d=$_POST['distance']; $c=$_POST['fuel_consumption']; $p=$_POST['fuel_price'];
        if ($d<=0||$c<=0||$p<=0) $res='<p class="error">All values must be positive.</p>';
        else $res='<div class="results"><p>Total Cost: ₱'.number_format(($d/$c)*$p,2).'</p></div>';
    }
    echo '<h2>12. Travel Cost Estimator</h2>
    <form method="POST">
    <input type="number" name="distance" placeholder="Distance (km)" value="' . ($_POST['distance'] ?? 100) . '" required>
    <input type="number" name="fuel_consumption" placeholder="Km per Liter" value="' . ($_POST['fuel_consumption'] ?? 12) . '" required>
    <input type="number" name="fuel_price" placeholder="₱ per Liter" value="' . ($_POST['fuel_price'] ?? 65) . '" required>
    <button>Estimate</button></form>' . ($res ?? '');
}
?>    

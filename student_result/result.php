<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #780206, #061161);
            margin: 0;
            color: white;
        }

        .form-container {
            background-color: rgba(20, 30, 48, 0.4);
            padding: 40px; /* Padding */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 800px; /* Width */
            max-width: 100%; /* Maximum Width */
            box-sizing: border-box; /* Box Sizing */
        }
        h2 {
            text-align: center;
            margin-bottom: 30px; /* Space below title */
        }
        .form-group {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }

        .form-group label {
            width: 140px; /* Label Width */
            margin-right: 10px; /* Space between label and input */
        }

        .form-group input {
            flex: 1; /* Input Field Width */
            padding: 10px;
            border: 1px solid #ddd;
            background-color: rgba(5, 12, 24, 0.4);
            color: white;
            border-radius: 4px;
            width: 180px;
        }

        .row {
            display: flex; /* Flexbox for two input fields */
            justify-content: space-between; /* Space distribution */
        }

        .gender {
    display: flex;
    justify-content: space-between;
    margin: 15px 0;
}

.gender .form-group {
    display: flex;
    align-items: center;
}

.gender label {
    margin-left: 5px;
}

        button {
            background: linear-gradient(to right, #780206, #061161);
            color: white;
            border: none;
            padding: 12px; /* Button Padding */
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px; /* Margin for button */
        }
        button:hover{
            background: linear-gradient(to right, #061161, #780206);
        }
        hr{
            border: none; /* Remove default border */
            border-top: 0.1px solid #ffffff22; /* Set the top border to 0.1px solid */
           margin-bottom: 40px;
            
        }



        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: rgba(20, 30, 48, 0.5);
            border-radius: 8px;
        }

        .result p {
            margin: 5px 0;
            font-size: 16px;
        }

        .error {
            color: red;
            text-align:center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Result Calculation</h2> 
        <hr>
        <form method="post" action="">
            <div class="row">
                <div class="form-group">
                    <label for="input1">Subject one</label>
                    <input type="number" id="input1"  name="input1"  placeholder="Enter Subject one Mark" min="0" max="100" required>
                </div>
                <div class="form-group">
                    <label for="input2">Subject Two</label>
                    <input type="number" id="input2"  name="input2"  placeholder="Enter Subject Two Mark" min="0" max="100" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="input3">Subject Three</label>
                    <input type="number" id="input3"   name="input3" placeholder="Enter Subject Three Mark" min="0" max="100" required>
                </div>
                <div class="form-group">
                    <label for="input4">Subject Four</label>
                    <input type="number" id="input4"  name="input4" placeholder="Enter Subject Four Markr" min="0" max="100" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="input5">Subject Five</label>
                    <input type="number" id="input5"  name="input5"  placeholder="Enter Subject Five Mark" min="0" max="100" required>
                </div>
                
            </div>

            <button type="submit" name="submit">Calculate Result</button>
        </form>
        <?php
    if (isset($_POST['submit'])) {
        $marks = [
            $_POST['input1'],
            $_POST['input2'],
            $_POST['input3'],
            $_POST['input4'],
            $_POST['input5']
        ];

        // Function to calculate result
        function calculateResult($marks) {
            // Validate mark range for each subject
            foreach ($marks as $mark) {
                if ($mark < 0 || $mark > 100) {
                    return "<p class='error'>Mark range is invalid. Please enter marks between 0 and 100.</p>";
                }
            }

            // Check for failure condition
            foreach ($marks as $mark) {
                if ($mark < 33) {
                    return "<p class='error'>Student has failed because a subject mark is less than 33.</p>";
                }
            }

            // Calculate total marks and average
            $totalMarks = array_sum($marks);
            $averageMarks = $totalMarks / count($marks);

            // Determine grade using switch-case
            $grade = '';
            switch (true) {
                case ($averageMarks >= 80 && $averageMarks <= 100):
                    $grade = 'A+';
                    break;
                case ($averageMarks >= 70 && $averageMarks < 80):
                    $grade = 'A';
                    break;
                case ($averageMarks >= 60 && $averageMarks < 70):
                    $grade = 'A-';
                    break;
                case ($averageMarks >= 50 && $averageMarks < 60):
                    $grade = 'B';
                    break;
                case ($averageMarks >= 40 && $averageMarks < 50):
                    $grade = 'C';
                    break;
                case ($averageMarks >= 33 && $averageMarks < 40):
                    $grade = 'D';
                    break;
                default:
                    $grade = 'F';
            }

            // Return result summary
            return "
            <div class='result'>
                <p><strong>Total Marks:</strong> $totalMarks</p>
                <p><strong>Average Marks:</strong> $averageMarks</p>
                <p><strong>Grade:</strong> $grade</p>
            </div>";
        }

        // Display the result
        echo calculateResult($marks);
    }
    ?>
    </div>
</body>
</html>

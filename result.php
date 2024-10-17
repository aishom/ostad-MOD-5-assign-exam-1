<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 350px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #f1f1f1;
            border-radius: 8px;
        }

        .result p {
            margin: 5px 0;
            font-size: 16px;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Result Calculator</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="subject1">Subject 1 Marks:</label>
            <input type="number" id="subject1" name="subject1" min="0" max="100" required>
        </div>
        <div class="form-group">
            <label for="subject2">Subject 2 Marks:</label>
            <input type="number" id="subject2" name="subject2" min="0" max="100" required>
        </div>
        <div class="form-group">
            <label for="subject3">Subject 3 Marks:</label>
            <input type="number" id="subject3" name="subject3" min="0" max="100" required>
        </div>
        <div class="form-group">
            <label for="subject4">Subject 4 Marks:</label>
            <input type="number" id="subject4" name="subject4" min="0" max="100" required>
        </div>
        <div class="form-group">
            <label for="subject5">Subject 5 Marks:</label>
            <input type="number" id="subject5" name="subject5" min="0" max="100" required>
        </div>
        <button type="submit" name="submit">Calculate Result</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $marks = [
            $_POST['subject1'],
            $_POST['subject2'],
            $_POST['subject3'],
            $_POST['subject4'],
            $_POST['subject5']
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

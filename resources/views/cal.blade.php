<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <form id="bmiForm">
      <div class="form-group">
        <label for="heightInput">Height (meters)</label>
        <input type="number" class="form-control col-md-6" id="heightInput" aria-describedby="heightHelp" step="0.01" required>
      </div>
      <div class="form-group">
        <label for="weightInput">Weight (kg)</label>
        <input type="number" class="form-control col-md-6" id="weightInput" step="0.1" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div id="result"></div>
  </div>
  
  <script>
    document.getElementById('bmiForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent default form submission
  
      // Get input values
      var height = parseFloat(document.getElementById('heightInput').value);
      var weight = parseFloat(document.getElementById('weightInput').value);
  
      // Validate input values
      if (height <= 0 || weight <= 0) {
        document.getElementById('result').innerHTML = 'Please enter valid positive numbers for height and weight.';
        return;
      }
  
      // Calculate BMI
      var bmi = calculateBMI(height, weight);
  
      // Display result
      document.getElementById('result').innerHTML = 'Your BMI is: ' + bmi;
    });
  
    function calculateBMI(height, weight) {
      // Calculate BMI formula: weight (kg) / [height (m)]^2
      var bmi = weight / Math.pow(height, 2);
      return bmi.toFixed(2); // Round to 2 decimal places
    }
  </script>
  
  
</body>
</html>
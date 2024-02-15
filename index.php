<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Number Table with Questions</title>
  <style>
   table {
  border-collapse: collapse;
  width: 300px;
  height: 300px;
  margin-left: 196px;
  margin-top: 160px;
}

table,
th,
td {
  border: 1px solid black;
  cursor: pointer;
}

th,
td {
  padding: 10px;
  text-align: center;
  background-color: #e1e1e1;
}

.clicked {
  background-color: #0f717e;
  color: white;
}

#container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  max-width: 400px;
  margin-top: 20px;
  margin-left: 40px;
  position: absolute;
  top: 188px;
  left: 36%;
}

.question-container {
  width: 100%;
  margin-bottom: 15px;
  background-color: #d6e5d6;
    border: 1px solid #969792;
  padding: 10px;
  display: none;
}

div#questionDivchild {
  display: flex;
  justify-content: space-evenly;
  width: 94%; 
}

.option {
  width: 128px;
  background-color: #c9d7c9;
  padding: 5px;
}

.options {
  display: flex;
  gap: 10px;
  padding-top: 4px;
}

.options input[type="radio"] {
  display: none; 
}

/* radio button style */
.radio-container {
  position: relative;
  cursor: pointer;
  margin-left: 40px;
}

.radio-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

.checkmark {
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: 25px;
  width: 25px;
  background-color: #ccc;
  border-radius: 50%;
}

.radio-container:hover input ~ .checkmark {
  background-color: #ddd;
}

.radio-container input:checked ~ .checkmark {
  background-color: #0F717E; 
  border: solid #045864 1px;
}

.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

.radio-container input:checked ~ .checkmark:after {
  display: block;
}

.radio-container .checkmark:after {
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: white;
}

/* Style for checked text */
.radio-container input:checked ~ .radio-label {
  background-color: #0F717E;
}

.radio-label {
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 2px 6px;
  border-radius: 20px; 
  color: black;
}

#selectedInfo {
  margin-top: 20px;
}

.bar_divmain {
  position: absolute;
  width: 90%;
  top: 0px;
  left: 10%;
}

.infoscore {
  height: 35px;
  width: 160px;
  padding-top: 15px;
  padding-left: 30px;
  color: #383681;
  font-size: 17px;
  border: solid black 1px;
  font-weight: 900;
  border-radius: 5px;
}

.infoprogress {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  gap: 10px;
}

.barbar {
  width: 50%;
  height: 50px;
  background-color: lightgray;
  border-radius: 5px;
  display: flex;
  overflow: hidden;
  border: solid #0a0a09 1px;
}

#progressBardiv {
  width: 100%;
  top: 0px;
  position: absolute;
  display: flex;
  justify-content: space-evenly;
}

.progress {
  height: 100%;
  transition: width 0.5s;
}

.progress-A {
  background-color: #3CBB88;
}

.progress-B {
  background-color: #8CE1BF;

}

.progress-C {
  background-color: #FFE179;
}

.progress-D {
  background-color: #FFB978;
}

.progress-E {
  background-color: #ECEAE5;
}

.barOption {
  margin-top: 10px;
}

  </style>
</head>

<body>

<table id="numberTable">
  <?php
  $count = 1;
  for ($i = 1; $i <= 7; $i++) {
    echo "<tr>";
    for ($j = 1; $j <= 7; $j++) {
      echo "<th onclick='cellClick(this, $i, $j)'>" . $count . "</th>";
      $count++;
    }
    echo "</tr>";
  }
  ?>
</table>

<div id="container">
  <?php
  $defaultOptions = ['A', 'B', 'C', 'D', 'E'];

  for ($i = 1; $i <= 49; $i++) {
    $defaultSelection = $defaultOptions[($i - 1) % count($defaultOptions)];
    echo "<div class='question-container' id='questionDiv{$i}'>";
    echo "<div class='question-container_child' id='questionDivchild'>";
    echo "<div class='option'>Question {$i}:<span> $defaultSelection </span></div>";
    echo "<div class='options'>";

    // Integrate round radio button code here
    for ($k = 0; $k < 5; $k++) {
      $optionId = "q{$i}{$k}";
      $optionValue = chr(65 + $k);
      echo "<label class='radio-container'>";
      echo "<input type='radio' id='{$optionId}' name='q{$i}' value='{$optionValue}'";
      if ($optionValue === $defaultSelection) {
        echo " checked";
      }
      echo ">";
      echo "<span class='checkmark'></span>";
      echo "<span class='radio-label'>{$optionValue}</span>";
      echo "</label>";
    }

    echo "</div>";
    echo "</div>";
    echo "</div>";
  }
  ?>
</div>



  <div id="selectedInfo"></div>
<div class="bar_divmain">
  

  <div id="defaultprogressInfo" class="infoprogress">
    <div id="defaultScoreInfo" class="infoscore"></div>
    <div id="defaultprogressBar" class="barbar">
      <div id="defaultprogressA" class="progress progress-A"><div id="defaultbarOptionA"></div><div id="defaultbarOptioncountA" class="barOption" ></div></div>
      <div id="defaultprogressB" class="progress progress-B"><div id="defaultbarOptionB"></div><div id="defaultbarOptioncountB" class="barOption" ></div></div>
      <div id="defaultprogressC" class="progress progress-C"><div id="defaultbarOptionC"></div><div id="defaultbarOptioncountC" class="barOption" ></div></div>
      <div id="defaultprogressD" class="progress progress-D"><div id="defaultbarOptionD"></div><div id="defaultbarOptioncountD" class="barOption" ></div></div>
      <div id="defaultprogressE" class="progress progress-E"><div id="defaultbarOptionE"></div><div id="defaultbarOptioncountE" class="barOption" ></div></div>
    </div>
  </div>
  <div id="progressInfo" class="infoprogress">
    <div id="scoreInfo" class="infoscore"></div>
    <div id="progressBar" class="barbar">
      <div id="progressA" class="progress progress-A"><div id="barOptionA"></div><div id="barOptioncountA" class="barOption" ></div></div>
      <div id="progressB" class="progress progress-B"><div id="barOptionB"></div><div id="barOptioncountB" class="barOption" ></div></div>
      <div id="progressC" class="progress progress-C"><div id="barOptionC"></div><div id="barOptioncountC" class="barOption" ></div></div>
      <div id="progressD" class="progress progress-D"><div id="barOptionD"></div><div id="barOptioncountD" class="barOption" ></div></div>
      <div id="progressE" class="progress progress-E"><div id="barOptionE"></div><div id="barOptioncountE" class="barOption" ></div></div>
    </div>
  </div>
</div>
  <script>
    function cellClick(cell, row, col) {
      cell.classList.toggle('clicked');
      var questionNumber = (row - 1) * 7 + col;
      var questionDiv = document.getElementById(`questionDiv${questionNumber}`);

      if (cell.classList.contains('clicked')) {
        showSelectedInfo(row, col);
        highlightQuestionDiv(questionDiv);
        updateScore();
        updateProgressBar();
        updateDefaultProgressBar();
      } else {
        clearSelectedInfo();
        unhighlightQuestionDiv(questionDiv);
        updateScore();
        updateProgressBar();
        updateDefaultProgressBar();
      }
    }

    function showSelectedInfo(row, col) {
      var questionNumber = (row - 1) * 7 + col;
      var questionInfo = document.getElementById(`q${questionNumber}0`).parentElement.parentElement.previousElementSibling.innerText;

    }

    function clearSelectedInfo() {
      document.getElementById('selectedInfo').innerHTML = '';
    }

    function highlightQuestionDiv(questionDiv) {
      questionDiv.style.display = 'block';
    }

    function unhighlightQuestionDiv(questionDiv) {
      questionDiv.style.display = 'none';
    }


    function updateScore() {
      var visibleDivs = document.querySelectorAll('.question-container[style="display: block;"]');
      var totalScore = 0;
      var numVisibleDivs = visibleDivs.length;

      visibleDivs.forEach(function(div) {
        var selectedOption = div.querySelector('input[type="radio"]:checked');
        if (selectedOption) {
          var optionValue = selectedOption.value;
          totalScore += getOptionScore(optionValue);
        }
      });

      var averageScore = numVisibleDivs > 0 ? totalScore / numVisibleDivs : 0;

      document.getElementById('scoreInfo').innerHTML = `Score 2023: ${Math.round(averageScore)}`;
    }

    function updateProgressBar() {
      var visibleDivs = document.querySelectorAll('.question-container[style="display: block;"]');
      var optionCounts = {
        'A': 0,
        'B': 0,
        'C': 0,
        'D': 0,
        'E': 0
      };

      visibleDivs.forEach(function(div) {
        var selectedOption = div.querySelector('input[type="radio"]:checked');
        if (selectedOption) {
          var optionValue = selectedOption.value;
          optionCounts[optionValue]++;
        }
      });

      
      var totalOptions = visibleDivs.length * 1;

      var progressA = (optionCounts['A'] / totalOptions) * 100;
      var progressB = (optionCounts['B'] / totalOptions) * 100;
      var progressC = (optionCounts['C'] / totalOptions) * 100;
      var progressD = (optionCounts['D'] / totalOptions) * 100;
      var progressE = (optionCounts['E'] / totalOptions) * 100;

      document.getElementById('progressA').style.width = progressA + '%';
      document.getElementById('progressB').style.width = progressB + '%';
      document.getElementById('progressC').style.width = progressC + '%';
      document.getElementById('progressD').style.width = progressD + '%';
      document.getElementById('progressE').style.width = progressE + '%';

      // Update progress information
      document.getElementById('barOptionA').innerHTML = `A`;
      document.getElementById('barOptioncountA').innerHTML = `${optionCounts['A']}`;
      document.getElementById('barOptionB').innerHTML = `B`;
      document.getElementById('barOptioncountB').innerHTML = `${optionCounts['B']}`;
      document.getElementById('barOptionC').innerHTML = `C`;
      document.getElementById('barOptioncountC').innerHTML = `${optionCounts['C']}`;
      document.getElementById('barOptionD').innerHTML = `D`;
      document.getElementById('barOptioncountD').innerHTML = `${optionCounts['D']}`;
      document.getElementById('barOptionE').innerHTML = `E`;
      document.getElementById('barOptioncountE').innerHTML = `${optionCounts['E']}`;
    }

    function updateDefaultProgressBar() {
      var visibleDivs = document.querySelectorAll('.question-container[style="display: block;"]');
      var defaultOptionCounts = {
        'A': 0,
        'B': 0,
        'C': 0,
        'D': 0,
        'E': 0
      };

      visibleDivs.forEach(function(div) {
        var selectedOption = div.querySelector('input[type="radio"][checked]');
        if (selectedOption) {
          var optionValue = selectedOption.value;
          defaultOptionCounts[optionValue]++;
        }
      });

      var totalOptions = visibleDivs.length * 1;

      var progressA = (defaultOptionCounts['A'] / totalOptions) * 100;
      var progressB = (defaultOptionCounts['B'] / totalOptions) * 100;
      var progressC = (defaultOptionCounts['C'] / totalOptions) * 100;
      var progressD = (defaultOptionCounts['D'] / totalOptions) * 100;
      var progressE = (defaultOptionCounts['E'] / totalOptions) * 100;

      document.getElementById('defaultprogressA').style.width = progressA + '%';
      document.getElementById('defaultprogressB').style.width = progressB + '%';
      document.getElementById('defaultprogressC').style.width = progressC + '%';
      document.getElementById('defaultprogressD').style.width = progressD + '%';
      document.getElementById('defaultprogressE').style.width = progressE + '%';

      // Update progress information

      document.getElementById('defaultbarOptionA').innerHTML = `A`;
      document.getElementById('defaultbarOptioncountA').innerHTML = `${defaultOptionCounts['A']}`;
      document.getElementById('defaultbarOptionB').innerHTML = `B`;
      document.getElementById('defaultbarOptioncountB').innerHTML = `${defaultOptionCounts['B']}`;
      document.getElementById('defaultbarOptionC').innerHTML = `C`;
      document.getElementById('defaultbarOptioncountC').innerHTML = `${defaultOptionCounts['C']}`;
      document.getElementById('defaultbarOptionD').innerHTML = `D`;
      document.getElementById('defaultbarOptioncountD').innerHTML = `${defaultOptionCounts['D']}`;
      document.getElementById('defaultbarOptionE').innerHTML = `E`;
      document.getElementById('defaultbarOptioncountE').innerHTML = `${defaultOptionCounts['E']}`;
  
      // Calculate and display default score
        var totalDefaultScore = 0;
      for (var option in defaultOptionCounts) {
        totalDefaultScore += getOptionScore(option) * defaultOptionCounts[option];
      }
      var defaultAverageScore = totalOptions > 0 ? totalDefaultScore / totalOptions : 0;
      document.getElementById('defaultScoreInfo').innerHTML = `Score 2021: ${Math.round(defaultAverageScore)}`;
    }
  
    function getOptionScore(optionValue) {
      switch (optionValue) {
        case 'A':
          return 100;
        case 'B':
          return 67;
        case 'C':
          return 33;
        case 'D':
          return 0;
        case 'E':
          return -1;
        default:
          return 0;
      }
    }

    // Add event listeners to radio buttons
    var radioButtons = document.querySelectorAll('input[type="radio"]');
    radioButtons.forEach(function(radioButton) {
      radioButton.addEventListener('change', function() {
        updateScore();
        updateProgressBar();
        updateDefaultProgressBar();
      });
    });
  </script>

</body>

</html>

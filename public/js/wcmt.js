var wcmtBoxes = document.getElementById('wcmt-boxes');
var wcmtClock;
var wcmtClockContainer = document.getElementById('wcmt-timer-container');
var wcmtColumnHeaders = document.getElementById('wcmt-column-headers');
var wcmtRowHeaders = document.getElementById('wcmt-row-headers');
var wcmtInstructions = document.getElementById('wcmt-instructions');
var wcmtQuizBtn = document.getElementById('wcmt-quiz-button');
var wcmtResetBtn = document.getElementById('wcmt-reset-button');
var wcmtReview = document.getElementById('wcmt-review');
var wcmtScoreElement = document.getElementById('wcmt-score');
var wcmtSubmitBtn = document.getElementById('wcmt-submit-button');
var wcmtScore = 0;
var wcmtTime = 0;
var wcmtTimer = document.getElementById('wcmt-timer');


function createBoxes(min, max) {
	createColumnHeaders(min, max);
	createRowHeaders(min, max);

	for (let i = min; i <= max; i++) {

		for (let j = min; j <= max; j++) {
			var box = document.createElement('INPUT');
			box.setAttribute('type', 'number');
			var boxId = i + 'x' + j;
			box.setAttribute('id', boxId);
			var boxValue = i * j;
			box.setAttribute('value', boxValue);
			box.setAttribute('data-value', boxValue);
			box.className = `wcmt-box row-${i} col-${j}`;
			box.addEventListener('focus', handleFocus);
			box.addEventListener('blur', handleBlur);
			wcmtBoxes.append(box);
		}

	}
}// createBoxes


function createColumnHeaders(min, max) {
	for (let i = min; i <= max; i++) {
		var columnHeader = document.createElement('div');
		columnHeader.id = 'wcmt-col-header-' + i;
		columnHeader.classList.add('wcmt-header');
		columnHeader.innerText = i;
		wcmtColumnHeaders.append(columnHeader);
	}
}


function createRowHeaders(min, max) {
	for (let i = min; i <= max; i++) {
		var rowHeader = document.createElement('div');
		rowHeader.id = 'wcmt-row-header-' + i;
		rowHeader.classList.add('wcmt-header');
		rowHeader.innerText = i;
		wcmtRowHeaders.append(rowHeader);
	}
}


function handleBlur(e) {
	var row = e.target.id.split('x')[0];
	var col = e.target.id.split('x')[1];

	var rowHeader = document.getElementById('wcmt-row-header-' + row);
	rowHeader.classList.remove('wcmt-highlight');

	var colHeader = document.getElementById('wcmt-col-header-' + col);
	colHeader.classList.remove('wcmt-highlight');
}


function handleFocus(e) {
	var row = e.target.id.split('x')[0];
	var col = e.target.id.split('x')[1];

	var rowHeader = document.getElementById('wcmt-row-header-' + row);
	rowHeader.classList.add('wcmt-highlight');

	var colHeader = document.getElementById('wcmt-col-header-' + col);
	colHeader.classList.add('wcmt-highlight');
}


function startQuiz() {
	var emptyBoxes = document.querySelectorAll('input');

	for (var h = 0; h < emptyBoxes.length; h++) {
		emptyBoxes[h].value = "";
	}

	wcmtReview.classList.add('hidden');
	wcmtInstructions.classList.remove('hidden');
	wcmtQuizBtn.classList.add('hidden');
	wcmtSubmitBtn.classList.remove('hidden');

	document.querySelector('.wcmt-box').focus();

	startClock();
}


function submit() {
	stopClock();
	wcmtClockContainer.style.display = 'block';
	
	var answerElements = document.querySelectorAll('.wcmt-box');
	
	for (var k = 0; k < answerElements.length; k++) {
		var correctAnswer = answerElements[k].getAttribute('data-value');

		if (answerElements[k].value == correctAnswer) {
			wcmtScore++;
			answerElements[k].classList.add('green');
		}
		else {
			answerElements[k].classList.add('red');
		}
	}

	wcmtSubmitBtn.classList.add('hidden');
	wcmtResetBtn.classList.remove('hidden');
	wcmtInstructions.classList.add('hidden');
	wcmtScoreElement.innerHTML = wcmtScore + '%';

}


function reset() {
	window.location.reload();
}


function startClock() {
	wcmtClock = setInterval(function() {
		wcmtTime++;
		var minutes = parseInt(wcmtTime / 60);

		if (minutes === 0) {
			minutes = '';
		}

		else if (minutes === 1) {
			minutes = minutes + ' minute ';
		}

		else {
			minutes = minutes + ' minutes ';
		}

		var seconds = wcmtTime % 60;

		if (seconds === 1) {
			seconds = seconds + ' second';
		}

		else {
			seconds = seconds + ' seconds';
		}

		wcmtTimer.innerText = minutes + seconds;
	}, 1000);
}


function stopClock() {
	clearInterval(wcmtClock);
}


createBoxes(1,10);
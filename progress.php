<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cafe Progress</title>
    <style>
        body {
            background: #5b3a1a;
            font-family: 'Press Start 2P', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #4b2e15;
        }

        .progress-container {
            background: #f4ecde;
            border-radius: 20px;
            padding: 40px 60px;
            width: 80%;
            max-width: 900px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .progress-bar {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }

        .line {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 10px;
            background: #7a5431;
            transform: translateY(-50%);
            z-index: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        .line::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 0;
            background: #3a220f;
            transition: width 1s ease-in-out;
        }

        .step {
            position: relative;
            z-index: 1;
            background: #7a5431;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s;
        }

        .step img {
            width: 50%;
            display: none;
        }

        .step.completed img {
            display: block;
        }

        .step::after {
            content: attr(data-label);
            position: absolute;
            bottom: -40px;
            font-size: 14px;
            width: 100%;
            left: 50%;
            transform: translateX(-50%);
            color: #7a5431;
        }

        .step.completed {
            border: 8px solid #7a5431;
            background: #f4ecde;
            transform: scale(1.1);
        }

        #next {
            margin-top: 40px;
            padding: 12px 30px;
            background: #3a220f;
            color: #f4ecde;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="progress-container">
        <h2>Progress</h2>
        <div class="progress-bar">
            <div class="line"></div>
            <div class="step completed" data-label="10 cafes visited">
                <img src="coffee-bean.png" alt="bean" />
            </div>
            <div class="step completed" data-label="20 cafes visited">
                <img src="coffee-bean.png" alt="bean" />
            </div>
            <div class="step completed" data-label="30 cafes visited">
                <img src="coffee-bean.png" alt="bean" />
            </div>
            <div class="step" data-label="40 cafes visited"></div>
            <div class="step" data-label="50 cafes visited"></div>
        </div>
    </div>

    <button id="next">Visit Next Cafe</button>

    <script>
        const steps = document.querySelectorAll('.step');
        const line = document.querySelector('.line::after');
        const lineEl = document.querySelector('.line');
        const nextBtn = document.getElementById('next');

        let currentStep = 3; // start at 30 cafes visited

        function updateProgress() {
            const completedSteps = document.querySelectorAll('.step.completed').length;
            const totalSteps = steps.length;
            const percent = ((completedSteps - 1) / (totalSteps - 1)) * 100;
            lineEl.style.setProperty('--progress', `${percent}%`);
            lineEl.querySelector('::after');
        }

        function animateLine() {
            const completed = document.querySelectorAll('.step.completed').length;
            const progressLine = document.querySelector('.line::after');
        }

        nextBtn.addEventListener('click', () => {
            if (currentStep < steps.length) {
                steps[currentStep].classList.add('completed');
                const progressLine = document.querySelector('.line::after');
                const fill = document.querySelector('.line');
                fill.style.setProperty('--fill', `${(currentStep / (steps.length - 1)) * 100}%`);
                currentStep++;
                document.querySelector('.line').style.setProperty('--progress', `${(currentStep - 1) / (steps.length - 1) * 100}%`);
                document.querySelector('.line').style.setProperty('--progress', `${(currentStep - 1) / (steps.length - 1) * 100}%`);
            }
        });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Крутите Колесо</title>
    <style>
        /* Добавьте ваши стили здесь */
    </style>
</head>
<body>
    <div id="overlay"></div>
    <div id="notification">
        <div id="notificationMessage"></div>
        <button id="closeNotification">Закрыть</button>
    </div>

    <div class="deal-wheel">
        <div class="spinner"></div>
        <div class="ticker"></div>
        <button id="trigger" class="btn-spin">Крутить</button>
        <button id="getSecondPrize">Получить 2 приз</button>
		 <button id="getThirdPrize">Получить карту</button>
    </div>

    <audio id="spinSound" src="path/to/spinSound.mp3"></audio>
    <audio id="rewardSound" src="path/to/rewardSound.mp3"></audio>

    <script>
        function showNotification(message) {
            var notification = document.getElementById('notification');
            var notificationMessage = document.getElementById('notificationMessage');
            var overlay = document.getElementById('overlay');

            notificationMessage.innerHTML = message;
            overlay.style.display = 'block';
            notification.style.display = 'block';

            setTimeout(function() {
                hideNotification();
            }, 1000);
        }

        function hideNotification() {
            var notification = document.getElementById('notification');
            var overlay = document.getElementById('overlay');

            notification.style.opacity = '0';
            overlay.style.display = 'none';

            setTimeout(function() {
                notification.style.opacity = '1';
                notification.style.display = 'none';
                document.getElementById('notificationMessage').innerHTML = '';

                location.reload();
            }, 100);
        }

        document.getElementById('closeNotification').addEventListener('click', function() {
            hideNotification();
            location.reload();
        });

        const prize_Amount = 100;

 const prizes = [
    { text: "Пусто", color: "#00cde9" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/ruby.png'> <span>100</span></div>", color: "#152442" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/Diamonds.png'> <span>10</span></div>", color: "#00cde9" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/colections/22.png'> <span>10</span></div>", color: "#152442" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/emerald.png'> <span>1</span></div>", color: "#00cde9" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/chests/chests/1.png'> <span>1шт.</span></div>", color: "#152442" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/mnogit.png'> <span>х5</span></div>", color: "#00cde9" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/mine/kirka1.png'> <span>3ч.</span></div>", color: "#152442" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/ruby.png'> <span>1k</span></div>", color: "#00cde9" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/Diamonds.png'> <span>100</span></div>", color: "#152442" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/colections/22.png'> <span>100</span></div>", color: "#00cde9" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/emerald.png'> <span>10</span></div>", color: "#152442" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/chests/chests/1.png'> <span>1шт.</span></div>", color: "#00cde9" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/mnogit.png'> <span>х10</span></div>", color: "#152442" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/mine/kirka1.png'> <span>3ч.</span></div>", color: "#00cde9" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/chests/chests/2.png'> <span>1шт.</span></div>", color: "#152442" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/ruby.png'> <span>10k</span></div>", color: "#00cde9" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/Diamonds.png'> <span>1k</span></div>", color: "#152442" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/colections/22.png'> <span>1k</span></div>", color: "#00cde9" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/emerald.png'> <span>100</span></div>", color: "#152442" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/emerald.png'> <span>1k</span></div>", color: "#00cde9" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/chests/chests/1.png'> <span>1шт.</span></div>", color: "#152442" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/mine/kirka1.png'> <span>3ч.</span></div>", color: "#00cde9" },
    { text: "<div class='prize-content'><img width='24' height='24' src='/images/card_.png'> <span>1шт.</span></div>", color: "#152442" },
];



        const wheel = document.querySelector(".deal-wheel");
        const spinner = wheel.querySelector(".spinner");
        const trigger = wheel.querySelector(".btn-spin");
        const getSecondPrizeBtn = document.getElementById("getSecondPrize");
        const getThirdPrizeBtn = document.getElementById("getThirdPrize"); // Элемент для 3 приза

        const ticker = wheel.querySelector(".ticker");

        const prizeSlice = 360 / prizes.length;
        const prizeOffset = Math.floor(180 / prizes.length);
        const spinClass = "is-spinning";
        const selectedClass = "selected";
        const spinnerStyles = window.getComputedStyle(spinner);

        let tickerAnim;
        let rotation = 0;
        let currentSlice = 0;
        let prizeNodes;

        const createPrizeNodes = () => {
            prizes.forEach(({ text, color }, i) => {
                const rotation = ((prizeSlice * i) * -1) - prizeOffset;
                const textColor = color === "#152442" ? "white" : "#152442";
                spinner.insertAdjacentHTML(
                    "beforeend",
                    `<li class="prize" data-reaction style="--rotate: ${rotation}deg">
                        <div class="prize-content">
                           <span class="text" style="color: ${textColor}">${text}</span>
                        </div>
                    </li>`
                );
            });
        };

        const createConicGradient = () => {
            spinner.setAttribute(
                "style",
                `background: conic-gradient(
                    from -90deg,
                    ${prizes
                        .map(({ color }, i) => `${color} 0 ${(100 / prizes.length) * (prizes.length - i)}%`)
                        .reverse()
                    }
                );`
            );
        };

        const setupWheel = () => {
            createConicGradient();
            createPrizeNodes();
            prizeNodes = wheel.querySelectorAll(".prize");
        };

        const spinertia = (min, max) => {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min + 1)) + min;
        };

        const runTickerAnimation = () => {
            const values = spinnerStyles.transform.split("(")[1].split(")")[0].split(",");
            const a = values[0];
            const b = values[1];
            let rad = Math.atan2(b, a);

            if (rad < 0) rad += (2 * Math.PI);
            const angle = Math.round(rad * (180 / Math.PI));
            const slice = Math.floor(angle / prizeSlice);

            if (currentSlice !== slice) {
                ticker.style.animation = "none";
                setTimeout(() => ticker.style.animation = null, 10);
                currentSlice = slice;
            }
            tickerAnim = requestAnimationFrame(runTickerAnimation);
        };

        const userId = "1";

        function sendPrizeToServer(prizeNumber, prizeHtml) {
            const xhr = new XMLHttpRequest();
            const url = 'https://vipmars.life/update_prize.php';
            const params = `prize=${encodeURIComponent(prizeNumber)}&userId=${encodeURIComponent(userId)}`;
            
            console.log('Sending request with parameters:', params);

            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            console.log('Server response:', response);
                            if (response.status === 'success') {
                                showNotification(prizeHtml);
                            } else {
                                console.error('Error:', response.message);
                            }
                        } catch (e) {
                            console.error('Parsing error:', e);
                        }
                    } else {
                        console.error('HTTP error:', xhr.status);
                    }
                }
            };

            xhr.send(params);
        }

        const selectPrize = () => {
            const selected = Math.floor(rotation / prizeSlice);
            prizeNodes[selected].classList.add(selectedClass);
            const prizeHtml = prizes[selected].text;
            console.log('Selected prize:', prizeHtml);
            sendPrizeToServer(selected + 1, prizeHtml);
        };

        const spinSound = document.getElementById('spinSound');
        const rewardSound = document.getElementById('rewardSound');

        spinSound.volume = 0.25;
        rewardSound.volume = 0.25;

        function playSpinSound() {
            spinSound.play();
        }

        function playRewardSound() {
            rewardSound.play();
        }

        document.addEventListener("DOMContentLoaded", function() {
            const spinSound = document.getElementById('spinSound');
            const rewardSound = document.getElementById('rewardSound');

            if (!spinSound || !rewardSound) {
                console.error("Audio elements not found");
                return;
            }

            spinSound.volume = 0.25;
            rewardSound.volume = 0.25;

            spinSound.addEventListener('error', function(e) {
                console.error("Error playing spin sound:", e);
            });

            rewardSound.addEventListener('error', function(e) {
                console.error("Error playing reward sound:", e);
            });
        });

        trigger.addEventListener("click", () => {
            if (spin >= 1 || (spin <= 0 && rubin >= 25000)) {
                trigger.disabled = true;
                rotation = Math.floor(Math.random() * 360 + spinertia(2000, 5000));
                prizeNodes.forEach((prize_Amount) => prize_Amount.classList.remove(selectedClass));
                wheel.classList.add(spinClass);
                spinner.style.setProperty("--rotate", rotation);
                ticker.style.animation = "none";
                runTickerAnimation();

                playSpinSound();

                setTimeout(() => {
                    cancelAnimationFrame(tickerAnim);
                    rotation %= 360;
                    selectPrize();
                    wheel.classList.remove(spinClass);
                    spinner.style.setProperty("--rotate", rotation);
                    trigger.disabled = false;

                    spinSound.pause();
                    spinSound.currentTime = 0;

                    playRewardSound();
                }, 8000);
            } else {
                showNotification("Недостаточно ресурсов для вращения колеса.");
            }
        });

        getSecondPrizeBtn.addEventListener("click", () => {
            const secondPrizeIndex = 1; // индекс второго приза
            const prizeHtml = prizes[secondPrizeIndex].text;
            console.log('Получен второй приз:', prizeHtml);
            sendPrizeToServer(secondPrizeIndex + 1, prizeHtml);
        });
		
		
		        // Обработчик для получения третьего приза
        getThirdPrizeBtn.addEventListener("click", () => {
            const thirdPrizeIndex = 23; // индекс третьего приза
            const prizeHtml = prizes[thirdPrizeIndex].text;
            console.log('Получен третий приз:', prizeHtml);
            sendPrizeToServer(thirdPrizeIndex + 1, prizeHtml);
        });

        setupWheel();
    </script>
</body>
</html>

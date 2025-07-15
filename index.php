<?php
include 'functions.php';
// Массив вопросов (вопрос, обратный ли, подсказка для интерпретации)
$questions = [
    ["Когда кто-то спорит со мной, я сначала думаю: «А вдруг прав он, а не я?»", false, "Чем выше, тем мудрее"],
    ["Если я вижу сложный вопрос в викторине, то скорее скажу «Не знаю», чем попробую угадать.", false, "Чем выше, тем мудрее"],
    ["Мне сложно представить, что я могу серьёзно заблуждаться в чём-то важном для меня.", true, "Чем ниже, тем мудрее"],
    ["Когда я понимаю, что ошибся, мне легче признать это, чем доказывать свою правоту.", false, "Чем выше, тем мудрее"],
    ["Я часто ловлю себя на мысли: «Как же я раньше этого не понимал?»", false, "Чем выше, тем мудрее"],
    ["Если человек мне не нравится, но он говорит разумные вещи, я всё равно прислушаюсь.", false, "Чем выше, тем мудрее"],
    ["Я уверен, что в спорах чаще прав, чем мои собеседники.", true, "Чем ниже, тем мудрее"],
    ["Мне нравится, когда меня поправляют, если я в чём-то ошибся — так я узнаю новое.", false, "Чем выше, тем мудрее"],
    ["Если я не разбираюсь в теме, но мнение у меня уже есть, я всё равно его выскажу.", true, "Чем ниже, тем мудрее"],
    ["Когда я был(а) моложе, я думал(а), что знаю ответы почти на всё. Сейчас так не кажется.", false, "Чем выше, тем мудрее"],
    ["Если друг говорит мне, что я веду себя глупо, я сначала задумаюсь, а не обижусь.", false, "Чем выше, тем мудрее"],
    ["Мне кажется, что большинство людей не способны понять то, что понимаю я.", true, "Чем ниже, тем мудрее"],
    ["Я часто вспоминаю свои прошлые ошибки и учусь на них, а не стараюсь забыть.", false, "Чем выше, тем мудрее"],
    ["Даже если я уверен(а) в своей правоте, я проверяю, нет ли новых фактов против.", false, "Чем выше, тем мудрее"],
    ["Когда я слышу мнение, противоположное моему, мне интересно разобраться, а не переубедить.", false, "Чем выше, тем мудрее"]
];

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $totalScore = 0;
    
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест на мудрость</title>
    <style>
        :root {
            --primary: #6c5ce7;
            --secondary: #a29bfe;
            --text: #2d3436;
            --light: #f5f6fa;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--text);
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary);
            font-size: 2.2rem;
        }
        
        .intro {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }
        
        .question {
            background: var(--light);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        
        .question:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        
        .question-text {
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        
        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .option-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 20px;
            transition: all 0.2s ease;
        }
        
        .option-label:hover {
            background: var(--secondary);
            color: white;
        }
        
        input[type="radio"] {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid var(--primary);
            border-radius: 50%;
            margin-right: 8px;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
        }
        
        input[type="radio"]:checked {
            background: var(--primary);
        }
        
        input[type="radio"]:checked::after {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            top: 3px;
            left: 3px;
        }
        
        .scale-labels {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 5px;
            font-size: 0.9rem;
            color: #666;
        }
        
        .hint {
            font-size: 0.8rem;
            color: #666;
            margin-top: 10px;
            font-style: italic;
        }
        
        button {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 1rem;
            border-radius: 30px;
            cursor: pointer;
            display: block;
            margin: 30px auto 0;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(108, 92, 231, 0.3);
        }
        
        .result {
            background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
            padding: 25px;
            border-radius: 10px;
            margin-top: 30px;
            border-left: 5px solid var(--primary);
            animation: fadeIn 0.5s ease;
        }
        
        .result h2 {
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }
            
            .options {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .option-label {
                width: 100%;
            }
        }
		
		.scale {
			width: 100%;
		}
    </style>
</head>
<body>
    <div class="container">
        <h1>Тест Дайнинга-Крюгера</h1>
        <p class="intro">Оцените, насколько каждое утверждение относится к вам (1 — совсем нет, 5 — точно про меня):</p>
        <?php
            $res = getDetailedInterpretationInco($totalScore);

             $totalScore = 0;
    
            foreach ($questions as $i => $question) {
                $answer = (int)$_POST['q' . $i];
                if ($question[1]) {
                    $answer = 6 - $answer;
                }
                $totalScore += $answer;
            }

            // Получаем ключ (число) и текст отдельно
            $scoreKey = floor(min($totalScore, 100) / 5) * 5; // Числовой балл (ключ)
            $resultText = getDetailedInterpretationInco($totalScore); // Текст интерпретации

            // Для default-значения (если score < 30)
            if ($scoreKey < 30) $scoreKey = 0;

        ?>
        
        <?php if (!empty($_POST)): ?>
            <div class="result">
                <h2>Результат: <?= $scoreKey ?> баллов</h2>
                <img src="dktest.jpg" class="scale" alt="">
                <div class="dk-scale">
                    <div class="scale-line" style="--pos: <?= ($scoreKey/75)*100 ?>%">
                        <span class="marker"></span>
                    </div>
                </div>
                <p><?= $resultText['text'] ?></p>
            </div>
<?php endif; ?>
        
        <form method="POST">
            <?php foreach ($questions as $i => $question): ?>
                <div class="question">
                    <div class="question-text"><?= $i + 1 ?>. <?= $question[0] ?></div>
                    <div class="options">
                        <?php for ($j = 1; $j <= 5; $j++): ?>
                            <label class="option-label">
                                <input type="radio" name="q<?= $i ?>" value="<?= $j ?>" required> 
                                <?= $j ?>
                            </label>
                        <?php endfor; ?>
                    </div>
                    <div class="scale-labels">
                        <span>Совсем нет</span>
                        <span>Точно про меня</span>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <button type="submit">Узнать результат</button>
        </form>
    </div>
</body>
</html>
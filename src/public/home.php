<?php
session_start();
require_once '../classes/UserLogic.php';
require_once '../functions.php';

//　ログインしているか判定し、していなかったら新規登録画面へ返す
/*$result = UserLogic::checkLogin();

if (!$result) {
  $_SESSION['login_err'] = 'ユーザを登録してログインしてください！';
  header('Location: signup_form.php');
  return;
}

$login_user = $_SESSION['login_gomi']; */

//こっから
$err = [];

// バリデーション
if(!$email = filter_input(INPUT_POST, 'email')) {
  $err['email'] = '管理者IDを記入してください。';
}
if(!$password = filter_input(INPUT_POST, 'password')) {
  $err['password'] = 'パスワードを記入してください。';
}

if (count($err) > 0) {
  // エラーがあった場合は戻す
  $_SESSION = $err;
  header('Location: loginpage.php');
  return;
}
// ログイン成功時の処理
$result = UserLogic::login($email, $password);
// ログイン失敗時の処理
if (!$result) {
  header('Location: loginpage.php');
  return;
}

//こっから
$no_login_required_pages = ['homepage.php'];




  

?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smash</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="styles.css"> <!-- SCSSをコンパイルしたCSSファイル -->
</head>
<body>
    <div class="container">
        <header>
          <img src="https://i.pinimg.com/736x/08/7e/3e/087e3e1b7ca50b89160a6b5262c04e7f.jpg" alt="Smashロゴ" class="logo">
            <h1>Smash</h1>
        </header>

        <div class="tabs-container">
            <nav class="tabs" role="tablist">
                <button class="tab active" data-target="status" role="tab" aria-selected="false">ゴミステータス</button>
                <button class="tab" data-target="analysis" role="tab" aria-selected="false">情報分析</button>
                <button class="tab" data-target="history" role="tab" aria-selected="false">過去のデータ</button>
                <form action="logout.php" method="post"><button class="tab" data-target="logout" role="tab" aria-selected="false" type="submit" name="logout" value="ログアウト">ログアウト</button></form>
                
                <button class="tab otoi" data-target="question" role="tab" aria-selected="false">お問い合わせ</button>
                <a href="homepage.php"><button class="tab" data-target="question" role="tab" aria-selected="false">Webページ</button></a>
            </nav>

            <!-- タブコンテンツ -->
            <section class="tab-content active" id="status" role="tabpanel" aria-labelledby="status-tab">
                <div class="card-container">
                    <!-- カードのテンプレート -->
                    <div class="card" data-title="AIアプリケーション" data-fill="65%" data-branding="缶" data-packaging="瓶">
                        <div class="card-inner">
                            <div class="box">
                                <div class="imgBox">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIYsMms2uGaF3sM1bH1AC0Zv2TMvpU6THeJQ&s" alt="AIアプリケーションのゴミ箱">
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <h3>AIアプリケーション</h3>
                            <div class="fill-rate">
                                <span class="percentage">65%</span>
                                <div class="battery">
                                    <div class="battery-fill" style="width: 65%;"></div>
                                </div>
                            </div>
                            <ul>
                                <li class="branding">缶</li>
                                <li class="packaging">瓶</li>
                            </ul>
                        </div>
                    </div>

                    </div> 
                    <!-- 他のカードをデータから生成 -->
                    <script>
                        //ゴミステータス
                        const cardData = [
                            {
                                title: "AIテクノロジー",
                                fill: "25%",
                                branding: "缶",
                                packaging: "ペットボトル",
                                image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIYsMms2uGaF3sM1bH1AC0Zv2TMvpU6THeJQ&s"
                            },
                            {
                                title: "管理棟1階",
                                fill: "85%",
                                branding: "瓶",
                                packaging: "ペットボトル",
                                image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIYsMms2uGaF3sM1bH1AC0Zv2TMvpU6THeJQ&s"
                            },
                            {
                                title: "北野館",
                                fill: "59%",
                                branding: "缶",
                                packaging: "ペットボトル",
                                image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIYsMms2uGaF3sM1bH1AC0Zv2TMvpU6THeJQ&s"
                            },
                            {
                                title: "管理棟3階",
                                fill: "92%",
                                branding: "瓶",
                                packaging: "ペットボトル",
                                image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIYsMms2uGaF3sM1bH1AC0Zv2TMvpU6THeJQ&s"
                            },
                            {
                                title: "学生会館4F",
                                fill: "68%",
                                branding: "缶",
                                packaging: "瓶",
                                image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIYsMms2uGaF3sM1bH1AC0Zv2TMvpU6THeJQ&s"
                            }
                        ];

                        const cardContainer = document.querySelector('.card-container');

                        cardData.forEach(data => {
                            const card = document.createElement('div');
                            card.classList.add('card');
                            card.innerHTML = `
                                <div class="card-inner">
                                    <div class="box">
                                        <div class="imgBox">
                                            <img src="${data.image}" alt="${data.title}のゴミ箱">
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h3>${data.title}</h3>
                                        <div class="fill-rate">
                                            <span class="percentage">${data.fill}</span>
                                            <div class="battery">
                                                <div class="battery-fill" style="width: ${data.fill};"></div>
                                            </div>
                                        </div>
                                        <ul>
                                            <li class="branding">${data.branding}</li>
                                            <li class="packaging">${data.packaging}</li>
                                        </ul>
                                    </div>
                                </div>
                            `;
                            cardContainer.appendChild(card);
                        });



                        const tabs = document.querySelectorAll('.tab');
const contents = document.querySelectorAll('.tab-content');

// 各タブにクリックイベントを設定
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        // アクティブタブのリセット
        tabs.forEach(t => t.classList.remove('active'));
        contents.forEach(c => c.classList.remove('active'));

        // 新しいアクティブタブの設定
        tab.classList.add('active');
        const targetId = tab.getAttribute('data-target');
        document.getElementById(targetId).classList.add('active');
    });
});

// 各バッテリーの充填率を設定する関数
function setBatteryLevels() {
    const cards = document.querySelectorAll('.card');

    cards.forEach(card => {
        const percentage = parseInt(card.querySelector('.percentage').textContent, 10);
        const battery = card.querySelector('.battery');
        const batteryFill = card.querySelector('.battery-fill');

        // 充填率に応じてバッテリーの色を変更
        if (percentage <= 59) {
            battery.classList.add('low');
        } else if (percentage >= 60 && percentage <= 79) {
            battery.classList.add('medium');
        } else {
            battery.classList.add('high');
        }

        // 充填率に応じてバッテリーの幅を設定
        batteryFill.style.width = percentage + '%';
    });
}

// ページ読み込み時にバッテリーのレベルを設定
document.addEventListener('DOMContentLoaded', setBatteryLevels);

document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // 全てのタブとコンテンツを非アクティブにする
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(tc => tc.classList.remove('active'));

        // クリックされたタブをアクティブにし、関連するコンテンツを表示する
        this.classList.add('active');
        const targetId = this.getAttribute('data-target');
        document.getElementById(targetId).classList.add('active');
    });
});

// グラフを保持するためのオブジェクト
const chartInstances = {};

// グラフを初期化する関数
function createChart(chartType, chartId, chartData) {
    const ctx = document.getElementById(chartId).getContext('2d');

    // 既存のグラフがあれば削除
    if (chartInstances[chartId]) {
        chartInstances[chartId].destroy();
    }

    // 新しいグラフを生成して保存
    chartInstances[chartId] = new Chart(ctx, {
        type: chartType,  // タブで指定されたタイプ ('bar' か 'line')
        data: {
            labels: ['缶', '瓶', 'ペットボトル', 'その他'],
            datasets: [{
                label: chartData.label,
                data: chartData.data,
                backgroundColor: chartType === 'bar' ? ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0'] : 'rgba(54, 162, 235, 0.2)',
                borderColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0'],
                borderWidth: 1,
                fill: chartType === 'line' // 折れ線グラフは塗りつぶさない
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true // Y軸を0から始める
                }
            },
            plugins: {
                legend: {
                    display: false // 凡例を非表示
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.formattedValue + ' 個'; // 数値の後に単位を追加
                        }
                    }
                }
            }
        }
    });
}


//情報分析
// 各データセットの定義
const chartsData = [
    { id: 'trashChart1', label: 'AIアプリケーション', data: [40, 30, 20, 10] },
    { id: 'trashChart2', label: 'AIテクノロジー', data: [50, 20, 30, 20] },
    { id: 'trashChart3', label: '管理棟1階', data: [20, 40, 30, 10] },
    { id: 'trashChart4', label: '北野館', data: [50, 10, 30, 10] },
    { id: 'trashChart5', label: '管理棠3階', data: [42, 25, 37, 25] },
    { id: 'trashChart6', label: '学生会館4F', data: [53, 40, 30, 20] }
];

// 初期表示はすべて棒グラフ
chartsData.forEach(chart => {
    createChart('bar', chart.id, chart);
});

// グラフ切り替えのタブイベント
document.querySelectorAll('.chart-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        const chartType = this.getAttribute('data-chart-type'); // 'bar' か 'line'
        const chartId = this.getAttribute('data-chart-id');     // グラフのID

        // 対応するデータを探す
        const chartData = chartsData.find(c => c.id === chartId);

        // グラフの切り替え
        createChart(chartType, chartId, chartData);

        // タブの見た目を切り替える
        const switcher = this.parentElement;
        switcher.querySelectorAll('.chart-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
    });
});
                    </script>
              
                
                <?php
// AWS SDKのオートローダーを読み込み
require '../vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;
use Aws\Exception\AwsException;


// DynamoDB クライアントの作成
$dynamodb = new DynamodbClient([
    'region' => 'ap-northeast-1', // リージョンを適切に設定（例: 東京リージョン）
    'version' => 'latest',
    
]);

// 取得したいデータのキーを指定
$tableName = 'gomibako';
$key = [
    'id' => ['S' => 'device-001'] // '123' は取得したいIDの値
];



$tableName = 'gomibako'; 

$result = $client->getItem([
    'gomibako' => $tableName,
    'Key' => [
        'deviceId' => [
            'S' => 'device-001'
        ]
    ]
        ]);

if (isset($result['Item'])) {
    $item = $result['Item'];
    echo "User name: " . $item['gomibako']['S'] . "\n";
} else {
    echo "Item not found.\n";
}
?>



            </section>

            <!-- その他のタブコンテンツ -->
            <section class="tab-content active" id="analysis">
                <div class="analysis-cards">
                    <!-- 各ゴミ箱のカード -->
                    <div class="card">
                        <h3 class="center">AIアプリケーション</h3>
                        <div class="chart-switcher">
                            <button class="chart-tab active" data-chart-type="bar" data-chart-id="trashChart1">棒グラフ</button>
                            <button class="chart-tab" data-chart-type="line" data-chart-id="trashChart1">折れ線グラフ</button>
                        </div>
                        <canvas id="trashChart1"></canvas>
                        <p class="result" id="result1"></p>
                    </div>
                    <div class="card">
                        <h3 class="center">AIテクノロジー</h3>
                        <div class="chart-switcher">
                            <button class="chart-tab active" data-chart-type="bar" data-chart-id="trashChart2">棒グラフ</button>
                            <button class="chart-tab" data-chart-type="line" data-chart-id="trashChart2">折れ線グラフ</button>
                        </div>
                        <canvas id="trashChart2"></canvas>
                        <p class="result" id="result2"></p>
                    </div>
                    <div class="card">
                        <h3 class="center">管理棟1階</h3>
                        <div class="chart-switcher">
                            <button class="chart-tab active" data-chart-type="bar" data-chart-id="trashChart3">棒グラフ</button>
                            <button class="chart-tab" data-chart-type="line" data-chart-id="trashChart3">折れ線グラフ</button>
                        </div>
                        <canvas id="trashChart3"></canvas>
                        <p class="result" id="result3"></p>
                    </div>
                    <div class="card">
                        <h3 class="center">北野館</h3>
                        <div class="chart-switcher">
                            <button class="chart-tab active" data-chart-type="bar" data-chart-id="trashChart4">棒グラフ</button>
                            <button class="chart-tab" data-chart-type="line" data-chart-id="trashChart4">折れ線グラフ</button>
                        </div>
                        <canvas id="trashChart4"></canvas>
                        <p class="result" id="result4"></p>
                    </div>
                    <div class="card">
                        <h3 class="center">管理棟3階</h3>
                        <div class="chart-switcher">
                            <button class="chart-tab active" data-chart-type="bar" data-chart-id="trashChart5">棒グラフ</button>
                            <button class="chart-tab" data-chart-type="line" data-chart-id="trashChart5">折れ線グラフ</button>
                        </div>
                        <canvas id="trashChart5"></canvas>
                        <p class="result" id="result5"></p>
                    </div>
                    <div class="card">
                        <h3 class="center">学生会館4F</h3>
                        <div class="chart-switcher">
                            <button class="chart-tab active" data-chart-type="bar" data-chart-id="trashChart6">棒グラフ</button>
                            <button class="chart-tab" data-chart-type="line" data-chart-id="trashChart6">折れ線グラフ</button>
                        </div>
                        <canvas id="trashChart6"></canvas>
                        <p class="result" id="result6"></p>
                    </div>
                </div>
            </section>

            <section class="tab-content" id="history" role="tabpanel" aria-labelledby="history-tab">
                <h2>過去のデータ</h2>
                <p>ここには過去のデータが入ります。</p>
            </section>

            <section class="tab-content" id="logout" role="tabpanel" aria-labelledby="logout-tab">
                <h2>ログアウト</h2>
                <p>ここでログアウトできます。</p>
            </section>

            <section class="tab-content" id="question" role="tabpanel" aria-labelledby="question-tab">
                <h2>お問い合わせ</h2>
                <p>お問い合わせ画面。</p>

                <style>body {
    font-family: 'Arial', sans-serif;
    background-color: #ecf0f1; /* $secondary-color */
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

header {
    text-align: center;
    margin-bottom: 20px;
}

header h1 {
    font-size: 2.5rem;
    color: #2c3e50; /* $primary-color */
}

/* タブスタイル */
.tabs-container {
    display: flex;
}

.tabs {
    display: flex;
    flex-direction: column;
    margin-right: 20px;
}

.tab {
    padding: 20px 30px;
    margin: 5px 0;
    border-radius: 5px;
    background-color: #ecf0f1; /* $secondary-color */
    cursor: pointer;
    transition: background-color 0.3s;
    text-align: center;
    font-size: 1.2rem;
    border: 1px solid #2c3e50; /* $primary-color */
    width: 200px;
}

.tab.active {
    background-color: #e74c3e; /* $accent-color */
    color: white;
}

.tab:hover {
    background-color: #34495e; /* lighten($primary-color, 10%) */
}

.tab-content {
    flex-grow: 1;
    display: none;
}

.tab-content.active {
    display: block;
}

/* カードのスタイル */
.analysis-cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    row-gap: 20px; /* 行の間にスペースを追加 */
    column-gap: 10px; /* カラム間のスペースを追加 */
}

.card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    margin: 10px;
    width: calc(45% - 20px);
    padding: 15px;
    text-align: center;
}

.card h3 {
    margin: 10px 0;
    font-size: 1.5rem;
}

/* グラフのスタイルを修正 */
.card canvas {
    width: 100% !important; /* Canvasの幅を100%に設定 */
    height: auto !important; /* 高さを自動調整 */
}

.card .result {
    margin-top: 10px;
    font-size: 1.2rem;
    color: #2c3e50; /* $primary-color */
}

/* グラフの切り替え用タブ */
.chart-switcher {
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
}

.chart-tab {
    padding: 5px 15px;
    margin: 0 5px;
    border-radius: 5px;
    background-color: #ecf0f1; /* $secondary-color */
    cursor: pointer;
    border: 1px solid #2c3e50; /* $primary-color */
}

.chart-tab.active {
    background-color: #e74c3e; /* $accent-color */
    color: white;
}
</style>


            </section>
            </div>
    </div>
          
    



</body>
</html>




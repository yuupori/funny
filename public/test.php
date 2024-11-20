<?php
require '../vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Exception\DynamoDbException; // ここで名前空間を追加

// AWS認証情報の設定（環境変数の場合）
$accessKeyId = getenv('AKIAVRUVPUS47LBUA3CF');
$secretAccessKey = getenv('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');

// DynamoDBクライアントの作成
$dynamodb = new DynamoDbClient([
    'version' => 'latest',
    'region' => 'ap-northeast-1', // 自分のリージョンに合わせる
    'credentials' => [
        'key' => $accessKeyId,
        'secret' => $secretAccessKey,
    ],
]);

// 取得したいアイテムのキー
$tableName = 'gomibako';
$key = [
    'deviceId' => ['S' => 'device-001']
];



try {
    // アイテムを取得
    $result = $dynamodb->getItem([
        'gomibako' => $tableName,
        'deviceId' => $key,
    ]);

    if (isset($result['Item'])) {
        $item = $result['Item'];
        echo "取得したデータ: " . json_encode($item, JSON_PRETTY_PRINT) . "\n";
    } else {
        echo "アイテムが見つかりません\n";
    }
} catch (DynamoDbException $e) {
    echo "エラーが発生しました: " . $e->getMessage() . "\n";
}
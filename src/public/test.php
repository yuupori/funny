<?php
require '../vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Exception\DynamoDbException;

// AWS認証情報の設定（環境変数の場合）
$accessKeyId = getenv('AKIAVRUVPUS47LBUA3CF');
$secretAccessKey = getenv('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');

$sdk = new Aws\Sdk([
    'region'   => 'ap-northeast-1',
    'DynamoDb' => [
        'region' => 'ap-northeast-1'
    ]
]);
// ここで名前空間を追加



// DynamoDBクライアントの作成
$dynamodb = $sdk->createDynamoDb();

// 取得したいアイテムのキー
$tableName = 'gomibako';
$key = [
    'deviceId' => ['S' => 'device-001']
];

try {
    // アイテムを取得
    $result = $dynamodb->getItem([
        'TableName' => $tableName,
        'Key' => $key,
    ]);

    if (isset($result['Item'])) {
        $item = $result['Item'];
        echo "取得したデータ: " . json_encode($item, JSON_PRETTY_PRINT) . "\n";
    } else {
        echo "アイテムが見つかりません\n";
    };

} catch (DynamoDbException $e) {
    echo "エラーが発生しました: " . $e->getMessage() . "\n";
}
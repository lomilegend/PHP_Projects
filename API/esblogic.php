<?php

// Service Registry
$serviceRegistry = [];

function registerService($name, $endpoint) {
    global $serviceRegistry;
    $serviceRegistry[$name] = $endpoint;
}

function getService($name) {
    global $serviceRegistry;
    return isset($serviceRegistry[$name]) ? $serviceRegistry[$name] : null;
}

// Message Broker
$messageQueue = [];

function publishMessage($message) {
    global $messageQueue;
    $messageQueue[] = $message;
}

function consumeMessage() {
    global $messageQueue;
    return array_shift($messageQueue);
}

// Adapters/Connectors
function sendRestRequest($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function sendSoapRequest($url, $data) {
    $client = new SoapClient(null, ['location' => $url, 'uri' => '']);
    $response = $client->__soapCall("operationName", [$data]);
    return $response;
}

function sendDatabaseQuery($dsn, $username, $password, $query, $params = []) {
    try {
        $pdo = new PDO($dsn, $username, $password);
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return "Database error: " . $e->getMessage();
    }
}

function readFileContent($filePath) {
    if (file_exists($filePath)) {
        return file_get_contents($filePath);
    } else {
        return "File not found";
    }
}

function writeFileContent($filePath, $content) {
    return file_put_contents($filePath, $content);
}

function sendEmail($to, $subject, $message, $headers = []) {
    $headersString = implode("\r\n", $headers);
    return mail($to, $subject, $message, $headersString);
}

function uploadFileToFtp($ftpServer, $ftpUser, $ftpPassword, $localFile, $remoteFile) {
    $ftpConn = ftp_connect($ftpServer);
    $login = ftp_login($ftpConn, $ftpUser, $ftpPassword);
    if ($ftpConn && $login) {
        $upload = ftp_put($ftpConn, $remoteFile, $localFile, FTP_BINARY);
        ftp_close($ftpConn);
        return $upload ? "Upload successful" : "Upload failed";
    } else {
        return "FTP connection failed";
    }
}

function downloadFileFromFtp($ftpServer, $ftpUser, $ftpPassword, $remoteFile, $localFile) {
    $ftpConn = ftp_connect($ftpServer);
    $login = ftp_login($ftpConn, $ftpUser, $ftpPassword);
    if ($ftpConn && $login) {
        $download = ftp_get($ftpConn, $localFile, $remoteFile, FTP_BINARY);
        ftp_close($ftpConn);
        return $download ? "Download successful" : "Download failed";
    } else {
        return "FTP connection failed";
    }
}

function publishMqttMessage($broker, $port, $topic, $message) {
    $client = new Mosquitto\Client();
    $client->connect($broker, $port, 60);
    $client->publish($topic, $message);
    $client->disconnect();
}

function sendRabbitMQMessage($host, $port, $user, $password, $queue, $message) {
    $connection = new AMQPStreamConnection($host, $port, $user, $password);
    $channel = $connection->channel();
    $channel->queue_declare($queue, false, true, false, false);
    $msg = new AMQPMessage($message);
    $channel->basic_publish($msg, '', $queue);
    $channel->close();
    $connection->close();
}

function sendGraphQLRequest($url, $query, $variables = []) {
    $data = json_encode(['query' => $query, 'variables' => $variables]);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

// Transformers
function transformData($data, $fromFormat, $toFormat) {
    if ($fromFormat == 'json' && $toFormat == 'xml') {
        $array = json_decode($data, true);
        $xml = new SimpleXMLElement('<root/>');
        array_walk_recursive($array, array ($xml, 'addChild'));
        return $xml->asXML();
    }
    // Add more transformations as needed
    return $data;
}

// Orchestrator
function handleRequest($serviceName, $request) {
    $service = getService($serviceName);
    if ($service) {
        return invokeService($service, $request);
    } else {
        throw new Exception("Service not found");
    }
}

function invokeService($service, $request) {
    $serviceType = $service['type'];
    $endpoint = $service['endpoint'];
    
    switch ($serviceType) {
        case 'rest':
            return sendRestRequest($endpoint, $request);
        case 'soap':
            return sendSoapRequest($endpoint, $request);
        case 'database':
            return sendDatabaseQuery($endpoint['dsn'], $endpoint['username'], $endpoint['password'], $request['query'], $request['params']);
        case 'file':
            if ($request['action'] === 'read') {
                return readFileContent($endpoint);
            } elseif ($request['action'] === 'write') {
                return writeFileContent($endpoint, $request['content']);
            }
            break;
        case 'email':
            return sendEmail($request['to'], $request['subject'], $request['message'], $request['headers']);
        case 'ftp':
            if ($request['action'] === 'upload') {
                return uploadFileToFtp($endpoint['server'], $endpoint['user'], $endpoint['password'], $request['localFile'], $request['remoteFile']);
            } elseif ($request['action'] === 'download') {
                return downloadFileFromFtp($endpoint['server'], $endpoint['user'], $endpoint['password'], $request['remoteFile'], $request['localFile']);
            }
            break;
        case 'mqtt':
            return publishMqttMessage($endpoint['broker'], $endpoint['port'], $request['topic'], $request['message']);
        case 'rabbitmq':
            return sendRabbitMQMessage($endpoint['host'], $endpoint['port'], $endpoint['user'], $endpoint['password'], $request['queue'], $request['message']);
        case 'graphql':
            return sendGraphQLRequest($endpoint, $request['query'], $request['variables']);
        default:
            throw new Exception("Unsupported service type");
    }
}

// Security and Logging
function logMessage($message) {
    file_put_contents('esb.log', date('Y-m-d H:i:s') . " - " . $message . PHP_EOL, FILE_APPEND);
}

function secureInvokeService($service, $request, $authToken) {
    if (authenticate($authToken)) {
        return invokeService($service, $request);
    } else {
        throw new Exception("Authentication failed");
    }
}

function authenticate($authToken) {
    // Implement your authentication logic here
    return $authToken === 'valid_token';
}

// Example Usage

// Register services with different types
registerService('OrderService', ['type' => 'rest', 'endpoint' => 'http://example.com/api/orders']);
registerService('DatabaseService', ['type' => 'database', 'endpoint' => ['dsn' => 'mysql:host=localhost;dbname=testdb', 'username' => 'root', 'password' => 'password']]);
registerService('FileService', ['type' => 'file', 'endpoint' => '/path/to/file.txt']);
registerService('EmailService', ['type' => 'email', 'endpoint' => null]);

// Example request to the OrderService
logMessage("Handling request for OrderService");
try {
    $request = ['orderId' => 12345];
    $authToken = 'valid_token';
    $response = secureInvokeService('OrderService', $request, $authToken);
    logMessage("Response: " . $response);
} catch (Exception $e) {
    logMessage("Error: " . $e->getMessage());
}

// Example request to the DatabaseService
try {
    $dbRequest = ['query' => 'SELECT * FROM users WHERE id = ?', 'params' => [1]];
    $dbResponse = handleRequest('DatabaseService', $dbRequest);
    print_r($dbResponse);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Example request to the FileService
try {
    $fileRequest = ['action' => 'read'];
    $fileResponse = handleRequest('FileService', $fileRequest);
    echo $fileResponse;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Example request to the EmailService
try {
    $emailRequest = ['to' => 'recipient@example.com', 'subject' => 'Test Email', 'message' => 'Hello, World!', 'headers' => ['From: sender@example.com']];
    $emailResponse = handleRequest('EmailService', $emailRequest);
    echo $emailResponse ? "Email sent successfully" : "Email sending failed";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Publish and consume messages
publishMessage(['type' => 'Order', 'data' => ['orderId' => 12345]]);
$message = consumeMessage();
logMessage("Consumed message: " . print_r($message, true));

?>

<?php

  //coding会以post请求发送一些认证数据，防止别人恶作剧
  //具体数据查看 https://open.coding.net/webhook.html
  //这里不能用$_POST接受，无法接收到 RAW_POST_DATA
  $json =  json_decode(file_get_contents('php://input'), true);

  //这里是一个认证的token，下面我们就会设置到
  // $token = 'wmhello';
  // if (empty($json['token']) || $json['token'] !== $token) {
  //   exit('error request');
  // }
  // $token = 'push';
  // if (isset($_SERVER['X-GitHub']) || isset($_SERVER['X-GitHub']) !== $token) {
  //   exit('error request');
  // }


  $pwd = getcwd();

  // '2>$1' 配置管道输出错误，方便调试
  // 这里已经配置了上面coding仓库的remote，并且-u 绑定了默认remote，所以直接使用'git pull'
  // 可以先输出此命令，并在cmd中运行，进行调试。
  $command = 'cd ' . str_replace('\\', '/\\', $pwd) . ' && cd .. && cd apidemo && git pull 2>&1';

  echo shell_exec($command);

  // GitHub Webhook Secret.
// Keep it the same with the 'Secret' field on your Webhooks / Manage webhook page of your respostory.
$secret = "wmhello";
// Path to your respostory on your server.
// e.g. "/var/www/respostory"
$path = "d:/www/apidemo";
// Headers deliveried from GitHub
$signature = $_SERVER['X-Hub-Signature'];
if ($signature) {
  $hash = "sha1=".hash_hmac('sha1', file_get_contents("php://input"), $secret);
  if (strcmp($signature, $hash) == 0) {
    echo shell_exec("cd \ && cd {$path} && git pull 2>&1");
    exit();
  }
}
http_response_code(404);
?>

<?php

namespace Akbv\PhpSkype;

use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;

class LiveLogin
{
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = HttpClient::create([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
                'Referer' => 'https://web.skype.com/',
            ],
        ]);
    }


    public function request(string $method, string $url, array $options = [], string &$redirectUrl = null): ?ResponseInterface
    {
        if (isset($options['authorization_session'])) {
            /* @var $session Session */
            $session = $options['authorization_session'];
            if ($session->getSkypeToken()) {
                $options['headers']['X-Skypetoken'] = $session->getSkypeToken()->getSkypeToken();
                $options['headers']['Authentication'] = 'skypetoken=' . $session->getSkypeToken()->getSkypeToken();
                $options['headers']['Cookie'] = 'skypetoken_asm=' . $session->getSkypeToken()->getSkypeToken();
            }
            if ($session->getRegistrationToken()) {
                $options['headers']['RegistrationToken'] = 'registrationToken=' . $session->getRegistrationToken()->getRegistrationToken();
            }
            if (!isset($options['timeout'])) {
                $options['timeout'] = 60;
            }
            unset($options['authorization_session']);
        }
        $options['on_progress'] = function (int $dlNow, int $dlSize, array $info) use (&$redirectUrl): void {
            if (isset($info['http_code']) && ($info['http_code'] == 301)) {
                foreach ($info['response_headers'] as $responseHeader) {
                    if ('location' === substr($responseHeader, 0, 8)) {
                        $redirectUrl = trim(substr($responseHeader, 9));
                        break;
                    }
                }
            }
        };
        $response = $this->httpClient->request($method, $url, $options);
        // Try to execute Request.
        try {
            $response->getContent();
        } catch (ClientException $exception) {
            // For testing purpose Skype can change Server Messenger URL and attempting to request should be repeated.
            if (!empty($redirectUrl)) {
                echo "follow redirect to $redirectUrl";
                $response = $this->request($method, $redirectUrl, $options, $redirectUrl);
            } else {
                throw $exception;
            }
        }
        return $response;
    }


    public function getMac256Hash(
        $challenge,
        $appId = "msmsgs@msnmsgr.com",
        $key = "Q1P7W2E4J9R8U3S5"
    ) {
        function zip($a, $b)
        {
            return array_map(null, $a, $b);
        }

        function int32ToHexString($n)
        {
            $hexChars = "0123456789abcdef";
            $hexString = "";

            for ($i = 0; $i < 4; $i++) {
                $hexString .= $hexChars[($n >> ($i * 8 + 4)) & 15];
                $hexString .= $hexChars[($n >> ($i * 8)) & 15];
            }

            return $hexString;
        }

        function int64Xor($inputarray)
        {
            $a = $inputarray[0];
            $b = $inputarray[1];
            $diff = abs(strlen(decbin($a)) - strlen(decbin($b)));
            $sA = strval(decbin($a));
            $sB = strval(decbin($b));

            $sC = str_repeat("0", $diff) . ($sA < $sB ? $sA : $sB);
            $sD = "";

            for ($i = 0; $i < strlen($sA); $i++) {
                $sC[$i] = $sA[$i] === $sB[$i] ? "0" : "1";
            }

            return bindec($sC);
        }

        function cS64($pdwData, $pInHash)
        {
            $CS64_a = $pInHash[0] & 2147483647;
            $CS64_b = $pInHash[1] & 2147483647;
            $CS64_c = $pInHash[2] & 2147483647;
            $CS64_d = $pInHash[3] & 2147483647;
            $CS64_e = 242854337;
            $pos = 0;
            $qwDatum = 0;
            $qwMAC = 0;
            $qwSum = 0;

            $iter = floor(count($pdwData) / 2);
            for ($i = 0; $i < $iter; $i++) {
                $qwDatum = $pdwData[$pos];
                $pos++;

                $qwDatum = ($qwDatum * $CS64_e) % 2147483647;
                $qwMAC += $qwDatum;
                $qwMAC *= $CS64_a;
                $qwMAC += $CS64_b;
                $qwMAC %= 2147483647;
                $qwSum += $qwMAC;

                $qwMAC += $pdwData[$pos];
                $pos++;

                $qwMAC *= $CS64_c;
                $qwMAC += $CS64_d;
                $qwMAC %= 2147483647;

                $qwSum += $qwMAC;
            }

            $qwMAC += $CS64_b;
            $qwMAC %= 2147483647;

            $qwSum += $CS64_d;
            $qwSum %= 2147483647;

            return [$qwMAC, $qwSum];
        }

        $clearText = $challenge . $appId;
        $paddingLength = 8 - (strlen($clearText) % 8);
        $clearText .= str_repeat("0", $paddingLength);

        $cchClearText = floor(strlen($clearText) / 4);
        $pClearText = [];

        for ($i = 0; $i < $cchClearText; $i++) {
            $pClearText[$i] = 0;

            for ($pos = 0; $pos < 4; $pos++) {
                $pClearText[$i] +=
                    ord($clearText[4 * $i + $pos]) * pow(256, $pos);
            }
        }

        $sha256Hash = [0, 0, 0, 0];

        $hash = strtoupper(hash("sha256", $challenge . $key));
        for ($i = 0; $i < count($sha256Hash); $i++) {
            $sha256Hash[$i] = 0;

            for ($pos = 0; $pos < 4; $pos++) {
                $dpos = 8 * $i + $pos * 2;
                $sha256Hash[$i] +=
                    hexdec(substr($hash, $dpos, 2)) * pow(256, $pos);
            }
        }

        $macHash = cS64($pClearText, $sha256Hash);
        $macParts = [$macHash[0], $macHash[1], $macHash[0], $macHash[1]];
        return implode("", array_map("int32ToHexString", array_map("int64Xor", zip($sha256Hash, $macParts))));
    }

    // Implement the regex search function
    private function search($pattern, $input)
    {
        preg_match($pattern, $input, $matches);
        return $matches[1];
    }

    private function s1()
    {
        $url = "https://login.skype.com/login/oauth/microsoft?client_id=572381&partner=999&redirect_uri=https://web.skype.com/Auth%2FPostHandler";
        $response = $this->request('GET', $url, [
            'headers' => [
                'Content-Type' => 'application/json; charset=utf-8',
                'User-Agent' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/115.0',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7'
            ],
            'verify_peer' => false,
            'verify_host' => false,
        ]);
        $body = $response->getContent();
        $headers = $response->getHeaders();
        $cookies = $headers['set-cookie'];
        echo("0%").PHP_EOL;
        // Implement the regex search function

        preg_match('/<input.*?name="PPFT".*?value="(.*?)"/', $response->getContent(), $ppft);
        preg_match('/uaid=(.*?);/', $cookies[0], $uaid);
        preg_match('/MSPRequ=(.*?);/', $cookies[2], $msprequ);
        preg_match('/MSCC=(.*?);/', $cookies[3], $mscc);
        preg_match('/MSPOK=(.*?);/', $cookies[4], $mspok);
        preg_match('/OParams=(.*?);/', $cookies[5], $oparams);

        return [
            'ppft' => $ppft[1],
            'uaid' => $uaid[1],
            'msprequ' => $msprequ[1],
            'mscc' => $mscc[1],
            'mspok' => $mspok[1],
            'oparams' => $oparams[1],
        ];
    }

    private function s2()
    {
        extract($this->s1());

        $url = "https://login.live.com/ppsecure/post.srf?wa=wsignin1.0&wp=MBI_SSL&wreply=https%3A%2F%2Flw.skype.com%2Flogin%2Foauth%2Fproxy%3Fclient_id%3D578134%26site_name%3Dlw.skype.com%26redirect_uri%3Dhttps%253A%252F%252Fweb.skype.com%252F";
        $response = $this->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Cookie' => "uaid=".$uaid."; cltm=cf:ReservedFlight33$2cReservedFligh; MSPRequ=".$msprequ."; MSCC=".$mscc."; MSPOK=".$mspok."; OParams=".$oparams."; MSPRequ=".$msprequ."; MSPOK=".$mspok."; CkTst=G".time(),
            ],
            'body' => http_build_query([
                'login' => "", // replace $login and $passwd with actual variables or values
                'passwd' => "",
                'PPFT' => $ppft,
                'loginoptions' => 3
            ]),
        ]);
        $body = $response->getContent();
        $headers = $response->getHeaders();
        $cookies = $headers['set-cookie'];
        echo("16.7%").PHP_EOL;


        preg_match('/opid=(.*?)&/', $response->getContent(), $opid);
        preg_match('/uaid=(.*?);/', $cookies[0], $uaid);
        preg_match('/, MSPOK=\$uuid(.*?);/', $cookies[1], $mspok);
        preg_match('/OParams=(.*?);/', $cookies[11], $oparams);
        preg_match('/__Host-MSAAUTH=(.*?);/', $cookies[2], $hostMsaauth);


        return [
            'opid' => $opid[1],
            'ppft' => $ppft,
            'uaid' => $uaid[1],
            'msprequ' => $msprequ,
            'mscc' => $mscc,
            'mspok' => '$uuid' . $mspok[1],
            'oparams' =>  $oparams[1],
            'host_msaauth' => $hostMsaauth[1],
        ];
    }

    private function s3()
    {
        extract($this->s2());


        // file_put_contents('cookie.txt', "uaid=".$uaid."; cltm=cf:ReservedFlight33$2cReservedFligh; MSPRequ=".$msprequ."; MSCC=".$mscc."; MSPOK=".$mspok."; OParams=".$oparams."; MSPRequ=".$msprequ."; MSPOK=".$mspok."; PPLState=1; MSPRequ=".$msprequ."; MSPOK=".$mspok."; CkTst=G".time());
        $url = "https://login.live.com/ppsecure/post.srf?wa=wsignin1.0&wp=MBI_SSL&wreply=https%3A%2F%2Flw.skype.com%2Flogin%2Foauth%2Fproxy%3Fclient_id%3D578134%26site_name%3Dlw.skype.com%26redirect_uri%3Dhttps%253A%252F%252Fweb.skype.com%252F";
        $response = $this->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Cookie' => "uaid=".$uaid."; cltm=cf:ReservedFlight33$2cReservedFligh; MSPRequ=".$msprequ."; MSCC=".$mscc."; MSPOK=".$mspok."; OParams=".$oparams."; MSPRequ=".$msprequ."; MSPOK=".$mspok."; PPLState=1; MSPRequ=".$msprequ."; MSPOK=".$mspok."; CkTst=G".time(),
            ],
            'body' => http_build_query([
                'opid' => $opid,
                'PPFT' => $ppft,
                'site_name' => 'lw.skype.com',
                'oauthPartner' => 999,
                'client_id' => 578134,
                'redirect_uri' => 'https://web.skype.com',
                'type' => 28
            ]),
        ]);
        $body = $response->getContent();

        $headers = $response->getHeaders();

        // file_put_contents('s3.html', $response->getContent());
        echo("33.3%").PHP_EOL;

        return [
            't' => $this->search('/<input.*?name="t".*?value="(.*?)"/gm', $body),
        ];
    }

    public function getSkypeToken()
    {
        $s3Result = $this->s3();
        extract($s3Result);

        $url = "https://login.skype.com/login/microsoft?client_id=572381&redirect_uri=https%3A%2F%2Fweb.skype.com%2FAuth%2FPostHandler";
        $response = $this->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'body' => http_build_query([
                't' => $t,
                'oauthPartner' => 999,
                'client_id' => 572381,
                'redirect_uri' => 'https://web.skype.com/Auth/PostHandler',
            ]),
        ]);
        $body = $response->getContent();

        echo("50%").PHP_EOL;
        return [
            'token' => $this->search('/<input.*?name="skypetoken".*?value="(.*?)"/gm', $body),
            'expiry' => $this->search('/<input.*?name="expires_in".*?value="(.*?)"/gm', $body),
        ];
    }

    public function testSkypeToken($token)
    {
        $url = "https://prod.registrar.skype.com/v2/registrations";
        $response = $this->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-skypetoken' => $token,
            ],
            'body' => '{"registrationId":"07baca20-cccf-45dd-aa45-fda5cc870035","nodeId":"","clientDescription":{"appId":"com.microsoft.skype.s4l-df.web","platform":"web","languageId":"en-US","templateKey":"com.microsoft.skype.s4l-df.web:2.9","platformUIVersion":"1418/8.98.0.208/"},"transports":{"TROUTER":[{"context":"","creationTime":"","path":"https://trouter-azsc-uswe-0-a.trouter.skype.com:3443/v4/f/nPlBszDljUOure16-KLeMw/","ttl":586304}]}}',
        ]);
        if ($response->getStatusCode() != 202) {
            echo $response->getStatusCode() . " " . $response->getInfo();
            exit("1");
        }
        echo("66.7%").PHP_EOL;
    }

    public function getRegistrationToken()
    {
        $skypeToken = $this->getSkypeToken();
        $this->testSkypeToken($skypeToken['token']);


        $timenow = time();

        $url = 'https://client-s.gateway.messenger.live.com/v1/users/ME/endpoints';
        $response = $this->request(
            "GET",
            $url,
            [
                'headers' => [
                    'LockAndKey' => 'appId=msmsgs@msnmsgr.com; time=' . $timenow . '; lockAndKeyResponse=' . $this->getMac256Hash($timenow),
                    'Authentication' => 'skypetoken=' . $skypeToken['token'],
                    'BehaviorOverride' => 'redirectAs404',
                ],
                'body' => json_encode(['endpointFeatures' => 'Agent']),
                'method' => 'POST',
            ]
        );

        echo("83.3%").PHP_EOL;

        $newLocation = $response['headers']['location'];
        if ($newLocation != $url) {
            $response = $this->request(
                "GET",
                $newLocation,
                [
                    'headers' => [
                        'LockAndKey' => 'appId=msmsgs@msnmsgr.com; time=' . $timenow . '; lockAndKeyResponse=' . $this->getMac256Hash($timenow),
                        'Authentication' => 'skypetoken=' . $skypeToken['token'],
                        'BehaviorOverride' => 'redirectAs404',
                    ],
                    'body' => json_encode(['endpointFeatures' => 'Agent']),
                    'method' => 'POST',
                ]
            );
            echo("100%").PHP_EOL;
        }

        $registrationToken = $response['headers']['set-registrationtoken'];
        $msgHost = 'https' . $this->search('/https(.*?)\.com/gm', $response['headers']['location']) . '.com';
        $regToken = $this->search('/registrationToken=(.*?);/gm', $registrationToken);
        $r_expiry = $this->search('/expires=(.*?);/gm', $registrationToken);

        return [
            'msgHost' => $msgHost,
            'regToken' => $regToken,
            'r_expiry' => $r_expiry,
            'skypeToken' => $skypeToken['token'],
            's_expiry' => $skypeToken['expiry']
        ];
    }

    public function connect()
    {
        $data = $this->getRegistrationToken();
        $msgHost = $data['msgHost'];
        $regToken = $data['regToken'];
        $r_expiry = $data['r_expiry'];
        $skypeToken = $data['skypeToken'];
        $s_expiry = $data['s_expiry'];
        echo "Login Complete".PHP_EOL;
    }

}

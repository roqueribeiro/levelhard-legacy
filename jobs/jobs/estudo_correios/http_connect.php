<?php

  ini_set('max_execution_time', 300);
  set_time_limit(0);

  //OC066469695BR
  //OC066464790BR
  //PN537331636BR
  //PN831121371BR
  $packageCode = $_POST["packageCode"];

  function http_get($url, $data)
  {
      $par_proxy = 'tcp://ipv4.200.212.136.170.hybrid-web.global.blackspider.com:8081';
      $data_url = http_build_query($data);
      $data_len = strlen($data_url);
      $content  = file_get_contents(
                    $url.$data_url,
                    false,
                    stream_context_create(
                      array(
                        'http'=>array(
                          //'proxy'=>$par_proxy,
                          'request_fulluri'=>true,
                          'method'=>'GET',
                          'header'=>"Content-Type: text/html; charset=utf-8\r\nConnection: close\r\nContent-Length: $data_len\r\n",
                          'content'=>$data_url
                        )
                      )
                    )
                  );

	  return mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
      // return array(
        // 'content'=>mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true)), 
        // 'headers'=>$http_response_header
      // );
  }

  preg_match(
    '#<table(.*?)>(.*?)</table>#is',
    http_get(
      'http://websro.correios.com.br/sro_bin/txect01$.QueryList?', 
      array(
        'P_LINGUA'=>'001',
        'P_TIPO'=>'001',
        'P_COD_UNI'=>$packageCode,
      )
    ), 
    $match
  );

  if(count($match)>0) {
    print $match[0];
  }  

?>
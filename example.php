<?php
require __DIR__ . '/vendor/autoload.php';
$chatbot = new fptai\FPTChatbot(TRUE,'123456');


$chatbot->sendText('Nội dung');
$chatbot->sendImage('https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png','XINCHAO');
$chatbot->sendImage('https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png'); //WEB
$chatbot->createQuickReply("Nội dung hiển thị trước khi có Quick Reply", 
 array(
    $chatbot->createQuickReplyButton('Lựa chọn 1','BlockName1',array("set_attributes"=>"value")),
    $chatbot->createQuickReplyButton('Lựa chọn 2','BlockName2',array("date_birthday"=>"10/03/2021","sex"=>"male")),
    $chatbot->createQuickReplyButton('Lựa chọn 3','BlockName1'),
 )
 );

 $chatbot->sendTextCard("GoodDay",
 array(
     $chatbot->createButtonToBlock("TextButton1","BlockName1",array("tên_attributes"=>"giá trị")), 
     $chatbot->createButtonToBlock("TextButton2","BlockName2")
     )
    ); 
    $chatbot->sendCarousel(array(
      $chatbot->creatCarousel("image_url","subtitle","title", $chatbot->createButtonToBlock("TextButton2","BlockName2"),"item_url"),
      $chatbot->creatCarousel("<image url>","B1 Desc","New Carousel", $chatbot->createButtonToBlock("TextButton2","BlockName2"))
    )
    );
 
?>
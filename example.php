<?php
require __DIR__ . '/vendor/autoload.php';
$chatbot = new FPTAI\FPTChatbot(TRUE,'botcode');


// GỬI 1 ĐOẠN VĂN BẢN //
$chatbot->sendText('Nội dung');

// GỬI 1 BỨC ẢNH //
$chatbot->sendImage('https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png','XINCHAO');
$chatbot->sendImage('https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png'); //WEB

// GỬI THẺ PHẢN HỒI NHANH //
$chatbot->createQuickReply("Nội dung hiển thị trước khi có Quick Reply", 
 array(
    $chatbot->createQuickReplyButton('TextButton1','BlockName1',array("set_attributes"=>"value")),
    // set_attributes GIÁ TRỊ ĐƯỢC SET KHI NHẤN VÀO NÚT NHẤN //
    $chatbot->createQuickReplyButton('TextButton3','BlockName2',array("date_birthday"=>"10/03/2021","sex"=>"male")),
    $chatbot->createQuickReplyButton('TextButton3','BlockName1'),
 )
 );

 // GỬI VĂN BẢN KÈM NÚT NHẤN //
 $chatbot->sendTextCard("Nội dung",
 array(
     $chatbot->createButtonToBlock("TextButton1","BlockName1",array("tên_attributes"=>"giá trị")), 
     $chatbot->createButtonToBlock("TextButton2","BlockName2")
     )
    ); 

// GỬI 1 SLIDE ẢNH TRƯỢT //
$chatbot->sendCarousel(array(
      $chatbot->creatCarousel("image_url","subtitle","title", $chatbot->createButtonToBlock("TextButton2","BlockName2"),"item_url"),
      $chatbot->creatCarousel("<image url>","B1 Desc","New Carousel", $chatbot->createButtonToBlock("TextButton2","BlockName2"))
    )
    );
 
?>
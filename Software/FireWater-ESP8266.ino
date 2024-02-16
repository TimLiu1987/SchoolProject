#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>

#define water 0
#define fire 2
#define OFF   HIGH
#define ON    LOW

const char* ssid     = "E225";
const char* password = "ncite";

ESP8266WebServer server(80);
int AA = 0;
int CC = 0;
int dd = 0;
void setup() {
  Serial.begin(9600);
  delay(10);
    pinMode( water, OUTPUT );
  digitalWrite( water, OFF );
      pinMode( fire, OUTPUT );
  digitalWrite( fire, OFF );
  // Connect to WiFi network
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
    }
  Serial.println("");
  Serial.println("WiFi connected");
  // Start the server
  server.begin();
  Serial.println("Server started");

  // Print the IP address
  Serial.println(WiFi.localIP());

  server.on( "/", webroot );  
  server.on( "/gpio00", [] {  
    digitalWrite( water, ON );
       delay(100);
       if(dd == 1)
       {
        webroot1();
       }
       else if(dd == 0)
       {
        webroot();
       }
  });
  server.on( "/gpio01", [] {  
    digitalWrite( water, OFF );
    delay(100);
           if(dd == 1)
       {
        webroot1();
       }
       else if(dd == 0)
       {
        webroot();
       }
  });
  server.on( "/gpio02", [] {  
    digitalWrite( fire, ON );
    delay(100);
    dd = 1;
    webroot1();
  });
  server.on( "/gpio03", [] {  
    digitalWrite( fire, OFF );
    delay(100);
    dd = 0;
    webroot();
  });  

  Serial.println( "HTTP Server Started" );
}

// Lamp ON 照片位址
const char* lampON  = "i.istockimg.com/file_thumbview_approve/31646796/3/stock-photo-31646796-on-icon.jpg";
// Lamp OFF 照片位址
const char* lampOFF = "i.istockimg.com/file_thumbview_approve/31647222/3/stock-photo-31647222-off-icon.jpg";
// 有人經過 照片位址
const char* YES  = "neticrm.tw/sites/neticrm.tw/files/contact.png?1458023370";
// Lamp OFF 照片位址
const char* NO = "images.uncyc.org/zh-tw/3/32/Nobody%E9%A0%AD%E5%83%8F.jpg";

// GPIO 按鈕字串
const char* strGpio00 = "<a href=\"/gpio00\"><BUTTON WIDTH=\"100\" style=\"WIDTH: 100px; HEIGHT: 50px\"><font size=\"5\"color=\"blue\">啟動</font></BUTTON></a>";

const char* strGpio01 = "<a href=\"/gpio01\"><BUTTON WIDTH=\"100\" style=\"WIDTH: 100px; HEIGHT: 50px\"><font size=\"5\"color=\"blue\">停止</font></BUTTON></a>";

const char* strGpio02 = "<a href=\"/gpio02\"><BUTTON WIDTH=\"100\" style=\"WIDTH: 100px; HEIGHT: 50px\"><font size=\"5\"color=\"blue\">啟動</font></BUTTON></a>";

const char* strGpio03 = "<a href=\"/gpio03\"><BUTTON WIDTH=\"100\" style=\"WIDTH: 100px; HEIGHT: 50px\"><font size=\"5\"color=\"blue\">停止</font></BUTTON></a>";

void webroot()
{
      
  // print GPIO setting page
  char temp[2048];

  snprintf( temp, 2048,
"<html>\
<head>\
<meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\">\
<meta http-equiv=\"content-type\">\
<title>ESP8266 FireWater.</title>\
</head><body>\
<h1 style=\"text-align: center;\">水位火警<br />\
<i><span style=\"font-size: x-small;\">WIFI Control</span></i></span></h1>\
<div style=\"text-align: center;\">\
<img alt=\"Switch ON\" src=\"https:%c%c%s\" style=\"height: 150px;\" /><br />\
<b><i><u><font size=\"5\"color=\"red\">水位</font></u></i></b>：&nbsp;\
%s&nbsp;&nbsp;&nbsp;%s<br />\
<img alt=\"Switch OFF\" src=\"https:%c%c%s\" style=\"height: 150px;\" /><br />\
<b><i><u><font size=\"5\"color=\"red\">火警</font></u></i></b>：&nbsp;\
%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
</div>\
<span style=\"font-size:30px;\">目前溫度: 關閉</span>\
</body></html>",
      0x2f,0x2f,
      ((digitalRead( water ))?lampOFF:lampON),  // to choice gpio00 icon
      strGpio00,strGpio01,0x2f, 0x2f,((digitalRead( fire ))?lampOFF:lampON), strGpio02,strGpio03
    );
  
  server.send( 200, "text/html;charset=UTF-8", temp );
}

void webroot1()
{
  // print GPIO setting page
  char temp[2048];

  snprintf( temp, 2048,
"<html>\
<head>\
<meta http-equiv=\"refresh\" content=\"10\">\
<meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\">\
<meta http-equiv=\"content-type\">\
<title>ESP8266 FireWater.</title>\
</head><body>\
<h1 style=\"text-align: center;\">水位火警<br />\
<i><span style=\"font-size: x-small;\">WIFI Control</span></i></span></h1>\
<div style=\"text-align: center;\">\
<img alt=\"Switch ON\" src=\"https:%c%c%s\" style=\"height: 150px;\" /><br />\
<b><i><u><font size=\"5\"color=\"red\">水位</font></u></i></b>：&nbsp;\
%s&nbsp;&nbsp;&nbsp;%s<br />\
<img alt=\"Switch OFF\" src=\"https:%c%c%s\" style=\"height: 150px;\" /><br />\
<b><i><u><font size=\"5\"color=\"red\">火警</font></u></i></b>：&nbsp;\
%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
</div>\
<span style=\"font-size:30px;\">目前攝氏溫度: %02d 度</span>\
</body></html>",
      0x2f,0x2f,
      ((digitalRead( water ))?lampOFF:lampON),  // to choice gpio00 icon
      strGpio00,strGpio01,0x2f, 0x2f,((digitalRead( fire ))?lampOFF:lampON),strGpio02,strGpio03,CC
    );
  
  server.send( 200, "text/html;charset=UTF-8", temp );
}

void loop() {
  server.handleClient();
  
    while (Serial.available() > 0) {
    AA = Serial.read();
    while(Serial.available() == 0);
    CC = Serial.read();
  }
      if(AA == 99)
    {
      Serial.println(CC);
      AA = 0;
    }
}



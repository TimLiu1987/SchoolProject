#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>

#define OPEN 2
#define CLOSE 0
#define OFF   HIGH
#define ON    LOW

const char* ssid     = "HTCButterfly";
const char* password = "12341234";

ESP8266WebServer server(80);
boolean State = false;


void setup() {
  Serial.begin(115200);
  delay(10);
  
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
    digitalWrite( CLOSE, ON );
     delay(1000);
    digitalWrite( CLOSE, OFF );
    delay(500);
    State = false;
    webroot();
  });
  server.on( "/gpio01", [] {  
    digitalWrite( CLOSE, ON );
    delay(1000);
    digitalWrite( CLOSE, OFF );
    delay(500);
    digitalWrite( OPEN, ON );
    delay(1000);
    digitalWrite( OPEN, OFF );
    State = true;
    webroot1();
  });
  server.on( "/gpio02", [] {  
    digitalWrite( CLOSE, ON );
    delay(1000);
    digitalWrite( CLOSE, OFF );
    delay(500);
    digitalWrite( OPEN, ON );
    delay(1000);
    digitalWrite( OPEN, OFF );
    delay(500);
    digitalWrite( OPEN, ON );
    delay(1000);
    digitalWrite( OPEN, OFF );
     State = true;
    webroot2();
  });
  server.on( "/gpio03", [] {  
        digitalWrite( CLOSE, ON );
    delay(1000);
    digitalWrite( CLOSE, OFF );
    delay(500);
    digitalWrite( OPEN, ON );
    delay(1000);
    digitalWrite( OPEN, OFF );
    delay(500);
    digitalWrite( OPEN, ON );
    delay(1000);
    digitalWrite( OPEN, OFF );
    delay(500);
    digitalWrite( OPEN, ON );
    delay(1000);
    digitalWrite( OPEN, OFF );
     State = true;
    webroot3();
  });  
  server.on( "/gpio04", [] {  
    digitalWrite( CLOSE, ON );
    delay(1000);
    digitalWrite( CLOSE, OFF );
    delay(500);
    digitalWrite( OPEN, ON );
    delay(1000);
    digitalWrite( OPEN, OFF );
    delay(500);
    digitalWrite( OPEN, ON );
    delay(1000);
    digitalWrite( OPEN, OFF );
    delay(500);
    digitalWrite( OPEN, ON );
    delay(1000);
    digitalWrite( OPEN, OFF );
    delay(500);
    digitalWrite( OPEN, ON );
    delay(1000);
    digitalWrite( OPEN, OFF );    
    State = true;
    webroot4();
  });

  // GPIO init
  pinMode( OPEN, OUTPUT );
  pinMode( CLOSE, OUTPUT );
  digitalWrite( OPEN, OFF );
  digitalWrite( CLOSE, OFF );

  Serial.println( "HTTP Server Started" );
}

// Lamp ON 照片位址
const char* lampON  = "i.istockimg.com/file_thumbview_approve/31646796/3/stock-photo-31646796-on-icon.jpg";
// Lamp OFF 照片位址
const char* lampOFF = "i.istockimg.com/file_thumbview_approve/31647222/3/stock-photo-31647222-off-icon.jpg";


// GPIO 按鈕字串
const char* strGpio00 = 
"<a href=\"/gpio00\"><BUTTON WIDTH=\"100\" style=\"WIDTH: 100px; HEIGHT: 100px\"><font size=\"5\"color=\"blue\">Turn OFF</font></BUTTON></a>";
const char* strGpio01 = 
"<a href=\"/gpio01\"><BUTTON WIDTH=\"100\" style=\"WIDTH: 100px; HEIGHT: 100px\"><font size=\"5\"color=\"blue\">Turn 1</font></BUTTON></a>";
const char* strGpio02 = 
"<a href=\"/gpio02\"><BUTTON WIDTH=\"100\" style=\"WIDTH: 100px; HEIGHT: 100px\"><font size=\"5\"color=\"blue\">Turn 2</font></BUTTON></a>";
const char* strGpio03 = 
"<a href=\"/gpio03\"><BUTTON WIDTH=\"100\" style=\"WIDTH: 100px; HEIGHT: 100px\"><font size=\"5\"color=\"blue\">Turn 3</font></BUTTON></a>";
const char* strGpio04 = 
"<a href=\"/gpio04\"><BUTTON WIDTH=\"100\" style=\"WIDTH: 100px; HEIGHT: 100px\"><font size=\"5\"color=\"blue\">Turn LED</font></BUTTON></a>";

void webroot()
{
  // print GPIO setting page
  char temp[2048];

  snprintf( temp, 2048,
"<html>\
<head>\
<meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\">\
<meta http-equiv=\"content-type\">\
<title>ESP8266 Fan.</title>\
</head><body>\
<h1 style=\"text-align: center;\">風扇<br />\
<i><span style=\"font-size: x-small;\">WIFI Control</span></i></span></h1><br />\
<div style=\"text-align: center;\">\
<img alt=\"Switch ON\" src=\"https:%c%c%s\" style=\"height: 200px;\" /><br />\
<b><i><u><font size=\"5\"color=\"red\">開關</font></u></i></b>：&nbsp;\
%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;\
</div>\
<span style=\"font-size:30px;\">目前狀態:OFF</span>\
</body></html>",
      0x2f,0x2f,
      (( State )?lampON:lampOFF),  // to choice gpio00 icon
      strGpio00,strGpio04,strGpio01,strGpio02,strGpio03
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
<meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\">\
<meta http-equiv=\"content-type\">\
<title>ESP8266 Fan.</title>\
</head><body>\
<h1 style=\"text-align: center;\">風扇<br />\
<i><span style=\"font-size: x-small;\">WIFI Control</span></i></span></h1><br />\
<div style=\"text-align: center;\">\
<img alt=\"Switch ON\" src=\"https:%c%c%s\" style=\"height: 200px;\" /><br />\
<b><i><u><font size=\"5\"color=\"red\">開關</font></u></i></b>：&nbsp;\
%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;\
</div>\
<span style=\"font-size:30px;\">目前風速:1</span>\
</body></html>",
      0x2f,0x2f,
      (( State )?lampON:lampOFF),  // to choice gpio00 icon
      strGpio00,strGpio04,strGpio01,strGpio02,strGpio03
    );
  
  server.send( 200, "text/html;charset=UTF-8", temp );
}
void webroot2()
{
  // print GPIO setting page
  char temp[2048];

  snprintf( temp, 2048,
"<html>\
<head>\
<meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\">\
<meta http-equiv=\"content-type\">\
<title>ESP8266 Fan.</title>\
</head><body>\
<h1 style=\"text-align: center;\">風扇<br />\
<i><span style=\"font-size: x-small;\">WIFI Control</span></i></span></h1><br />\
<div style=\"text-align: center;\">\
<img alt=\"Switch ON\" src=\"https:%c%c%s\" style=\"height: 200px;\" /><br />\
<b><i><u><font size=\"5\"color=\"red\">開關</font></u></i></b>：&nbsp;\
%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;\
</div>\
<span style=\"font-size:30px;\">目前風速:2</span>\
</body></html>",
      0x2f,0x2f,
      (( State )?lampON:lampOFF),  // to choice gpio00 icon
      strGpio00,strGpio04,strGpio01,strGpio02,strGpio03
    );
  
  server.send( 200, "text/html;charset=UTF-8", temp );
}
void webroot3()
{
  // print GPIO setting page
  char temp[2048];

  snprintf( temp, 2048,
"<html>\
<head>\
<meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\">\
<meta http-equiv=\"content-type\">\
<title>ESP8266 Fan.</title>\
</head><body>\
<h1 style=\"text-align: center;\">風扇<br />\
<i><span style=\"font-size: x-small;\">WIFI Control</span></i></span></h1><br />\
<div style=\"text-align: center;\">\
<img alt=\"Switch ON\" src=\"https:%c%c%s\" style=\"height: 200px;\" /><br />\
<b><i><u><font size=\"5\"color=\"red\">開關</font></u></i></b>：&nbsp;\
%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;\
</div>\
<span style=\"font-size:30px;\">目前風速:3</span>\
</body></html>",
      0x2f,0x2f,
      (( State )?lampON:lampOFF),  // to choice gpio00 icon
      strGpio00,strGpio04,strGpio01,strGpio02,strGpio03
    );
  
  server.send( 200, "text/html;charset=UTF-8", temp );
}
void webroot4()
{
  // print GPIO setting page
  char temp[2048];

  snprintf( temp, 2048,
"<html>\
<head>\
<meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\">\
<meta http-equiv=\"content-type\">\
<title>ESP8266 Fan.</title>\
</head><body>\
<h1 style=\"text-align: center;\">風扇<br />\
<i><span style=\"font-size: x-small;\">WIFI Control</span></i></span></h1><br />\
<div style=\"text-align: center;\">\
<img alt=\"Switch ON\" src=\"https:%c%c%s\" style=\"height: 200px;\" /><br />\
<b><i><u><font size=\"5\"color=\"red\">開關</font></u></i></b>：&nbsp;\
%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;%s&nbsp;\
</div>\
<span style=\"font-size:30px;\">目前狀態:LED</span>\
</body></html>",
      0x2f,0x2f,
      (( State )?lampON:lampOFF),  // to choice gpio00 icon
      strGpio00,strGpio04,strGpio01,strGpio02,strGpio03
    );
  
  server.send( 200, "text/html;charset=UTF-8", temp );
}

void loop() {
  server.handleClient();
}

